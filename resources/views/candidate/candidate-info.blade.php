@extends('layouts.app')
@section('css')
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">{{ __('Candidate Info') }}
                    <a href="/home">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-3" style="text-align: right">
                                <label for="name" class="control-label">Name</label>
                            </div>
                            <div class="col-md-6">
                                <span>{!! $userProfile['name'] !!}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3" style="text-align: right">
                                <label for="email" class="control-label">Email</label>
                            </div>
                            <div class="col-md-6">
                                <span>{!! $userProfile->email !!}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3" style="text-align: right">
                                <label for="email" class="control-label">Web Address</label>
                            </div>
                            <div class="col-md-6">
                                <span><a href='{!! $userProfile->url !!}'>{!! $userProfile->url !!}</a></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3" style="text-align: right">
                                <label for="cover_letter" class="control-label">Cover Letter</label>
                            </div>
                            <div class="col-md-6">
                                <span>{!! $userProfile->cover_letter !!}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3" style="text-align: right">
                                <label for="ip" class="control-label">IP Address</label>
                            </div>
                            <div class="col-md-6">
                                <span>{!! $userProfile->ip !!}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3" style="text-align: right">
                                <label for="attachment" class="control-label">Attachment</label>
                            </div>
                            <div class="col-md-6">
                                <span class="btn btn-primary">
                                <a href={!! $userProfile->attachment !!} style="color:white" target="_blank">
                                    View
                                </a>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3" style="text-align: right">
                                <label class="control-label">Comments</label>
                            </div>
                            <div class="col-md-6">
                                @foreach($comments as $comment)
                                    <div> {{$comment['comment']}} </div>
                                @endforeach
                            </div>
                        </div>
                        @if(Auth::user()->id != $userProfile->user_id)
                        <form role="form" class="form-horizontal" method="post" action="{!! $userProfile->id !!}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">
                            <div class="form-group row">
                                <label for="name" class="col-md-3 control-label">Average star Rating</label>
                                <div class="col-md-6">
                                    <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $userProfile->averageRating }}" data-size="xs">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comments" class="col-md-4 control-label">Add Comments</label>

                                <div class="col-md-6">
                                        <textarea id="comments" class="form-control " name="comments"  autofocus>

                                        </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#input-id").rating();
        });
    </script>
@endsection