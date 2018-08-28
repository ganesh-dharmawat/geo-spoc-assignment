<?php

namespace App\Http\Controllers;

use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','isVerified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('userprofile')->where('id',Auth::user()->id)->first();
        return view("users.index")->with(compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            $candidateInfo['user_id'] = Auth::user()->id;
            UserProfile::create($candidateInfo);
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
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile,$id)
    {
        $userProfile = UserProfile::where('id',$id)->first();
        $comments = $userProfile->comments()->get();
        return view('candidate.candidate-info')->with(compact('userProfile','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProfile $userProfile,$id)
    {
        request()->validate(['rate' => 'required']);
        $candidate = UserProfile::find($id);
        $user = User::find(Auth::user()->id);
        $product = UserProfile::find($id);
        $user->comment($product, $request->comments, 3);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = auth()->user()->id;
        $candidate->ratings()->save($rating);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
