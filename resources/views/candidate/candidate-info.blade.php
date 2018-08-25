@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">{{ __('Candidate Info') }}</div>
                    <div class="card-body">
                        <form role="form" class="form-horizontal" method="post" action="/save" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Full Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" required autofocus>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="url" class="col-md-4 control-label">Web Address</label>

                                <div class="col-md-6">
                                    <input id="url" type="text" class="form-control" name="url">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cover_letter" class="col-md-4 control-label">Cover Letter</label>

                                <div class="col-md-6">
                                        <textarea id="cover_letter" class="form-control" name="cover_letter" required autofocus>
                                        </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="attachment" class="col-md-4 control-label">Attachment</label>

                                <div class="col-md-6">
                                    <input id="attachment" type="file" name="attachment" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Do you like working</label>

                                <div class="col-md-6">
                                    <input type="checkbox" name="like_working" id=like_working required autofocus>
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