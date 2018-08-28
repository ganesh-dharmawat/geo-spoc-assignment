@extends('layouts.app')

@section('scripts')
    <script>
        $(document).ready(function () {
            $(".btn-refresh").click(function(){
                $.ajax({
                    type:'GET',
                    url:'/refresh_captcha',
                    success:function(data){
                        $(".captcha span").html(data.captcha);
                    }
                });
            });
        });
    </script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('partials.error-message')
                <div class="card card-default">
                    <div class="card-header">{{ __('Candidate Info') }}</div>
                    <div class="card-body">
                        <form role="form" class="form-horizontal" method="post" action="{{ route('userprofile.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Full Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"  value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span role="alert" class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  required autofocus>
                                    @if ($errors->has('email'))
                                        <span role="alert" class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="url" class="col-md-4 control-label">Web Address</label>

                                <div class="col-md-6">
                                    <input id="url" type="text" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" value="{{ old('url') }}" required>
                                    @if ($errors->has('url'))
                                        <span role="alert" class="invalid-feedback"><strong>{{ $errors->first('url') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cover_letter" class="col-md-4 control-label">Cover Letter</label>

                                <div class="col-md-6">
                                        <textarea id="cover_letter" class="form-control {{ $errors->has('cover_letter') ? ' is-invalid' : '' }}" name="cover_letter"  autofocus>
                                            {{ old('cover_letter') }}
                                        </textarea>
                                    @if ($errors->has('cover_letter'))
                                        <span role="alert" class="invalid-feedback"><strong>{{ $errors->first('cover_letter') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="attachment" class="col-md-4 control-label">Attachment</label>
                                <div class="col-md-6">
                                    <input id="attachment" class="form-control {{ $errors->has('attachment') ? ' is-invalid' : '' }}" type="file" name="attachment"  autofocus>
                                    @if ($errors->has('attachment'))
                                        <span role="alert" class="invalid-feedback"><strong>{{ $errors->first('attachment') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Do you like working</label>

                                <div class="col-md-6">
                                    <input type="checkbox" name="like_working" id=like_working class="form-control {{ $errors->has('like_working') ? ' is-invalid' : '' }}"  autofocus @if(old('like_working','on'))
                                    checked
                                            @endif>
                                    @if ($errors->has('like_working'))
                                        <span role="alert" class="invalid-feedback"><strong>{{ $errors->first('like_working') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Captcha</label>
                                <div class="col-md-6">
                                    <div class="captcha">
                                        <span>{!! captcha_img() !!}</span>
                                        <button type="button" class="btn btn-success btn-refresh"><i class="fa fa-refresh"></i></button>
                                    </div>
                                    <input id="captcha" type="text" class="form-control {{ $errors->has('captcha') ? ' is-invalid' : '' }}" placeholder="Enter Captcha" name="captcha">
                                    @if ($errors->has('captcha'))
                                        <span role="alert" class="invalid-feedback"><strong>{{ $errors->first('captcha') }}</strong></span>
                                    @endif
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection