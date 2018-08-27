<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade as PDF;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function getListing(Request $request){
        try{
            $userInfoIds = Candidate::pluck('id')->toArray();
            $filterFlag = true;
            if($request->has('search_name')  && $filterFlag && !empty ( $request->search_name )) {
                $userInfoIds = Candidate::where('name','like','%'.$request['search_name'].'%')->whereIn('id',$userInfoIds)->pluck('id')->toArray();
                if(count($userInfoIds) <= 0){
                    $filterFlag = false;
                }
            }elseif($request->has('search_email') && $filterFlag && !empty ( $request->search_email )){
                $userInfoIds = Candidate::where('email','like','%'.$request['search_email'].'%')->whereIn('id',$userInfoIds)->pluck('id')->toArray();
                if(count($userInfoIds) <= 0){
                    $filterFlag = false;
                }
            }
            $userInfoData = Candidate::whereIn('id',$userInfoIds)->get();
            $iTotalRecords = count($userInfoData);
            $records = array();
            $records['data'] = array();
            for($iterator = 0,$pagination = $request->start; $iterator < $request->length && $pagination < count($userInfoData); $iterator++,$pagination++ ){
                $like_working = ($userInfoData[$pagination]['like_working'] == true) ? '<td><span class="label label-sm label-success"> Yes </span></td>' : '<td><span class="label label-sm label-success"> No </span></td>';
                $records['data'][$iterator] = [
                    ucwords($userInfoData[$pagination]['name']),
                    $userInfoData[$pagination]['email'],
                    $userInfoData[$pagination]->url,
                    $like_working,
                    date('d M Y',strtotime($userInfoData[$pagination]['created_at'])),
                    '<span class="btn btn-primary">
                        <a href=/candidate/'.$userInfoData[$pagination]->id.' style="color: white">
                            View
                        </a>
                    </span>
                    <span class="btn btn-primary">
                        <a href="/pdf/'.$userInfoData[$pagination]->id.'" style="color: white" target="_blank">
                            PDF View
                        </a>
                    </span>
                    ',
                ];
            }
            $records["draw"] = intval($request->draw);
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;
        }catch(\Exception $e){
            $records = array();
            $data = [
                'action' => 'User Info listing',
                'params' => $request->all(),
                'exception' => $e->getMessage()
            ];
            Log::critical(json_encode($data));
            abort(500);
        }
        return response()->json($records,200);
    }

    public function pdfStream(Request $request,$id){
        $userInfo = Candidate::find($id);
        $pdf = PDF::loadView('candidate.candidate-info-pdf', compact('userInfo'));
        return $pdf->stream('candidate-info-pdf.pdf');
    }
}
