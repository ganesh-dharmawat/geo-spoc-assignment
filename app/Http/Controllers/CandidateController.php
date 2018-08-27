<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Http\Requests\Candidate\StoreCandidateInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            return redirect('/home');
        }
        return view("candidate.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCandidateInfo $request)
    {
        try{
            $file = $request->attachment;
            $path = $file->hashName('attachment');
            $disk = Storage::disk('public');
            $disk->put($path, file_get_contents($file));
            $candidateInfo = $request->only('name','email','url','cover_letter');
            $candidateInfo['like_working'] = ($request['like_working'] == 'on') ? true : false;
            $candidateInfo['attachment'] = $disk->url($path);
            $candidateInfo['ip'] = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
            Candidate::create($candidateInfo);
            $request->session()->flash('alert-success', 'Candidate Info successfully added!');
            return redirect('/');
        }catch(\Exception $e){
            $data = [
            'action' => 'Save Candidate Info',
            'params' => $request->all(),
            'exception' => $e->getMessage()
            ];
            Log::critical(json_encode($data));
            abort(500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        return view('candidate.candidate-info')->with(compact('candidate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        request()->validate(['rate' => 'required']);
        $candidate = Candidate::find($candidate->id);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = auth()->user()->id;
        $candidate->ratings()->save($rating);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
