@extends('layouts.app')

@section('content')

    <div class="container">
        @if($user->userprofile )
            <a class="btn btn-primary">Edit Profile</a>
        @else
            <a href="userprofile/create" class="btn btn-primary">Create Profile</a>

        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="userTable" style="width: 100%">
                                <thead>
                                <tr>
                                    <th style="width: 20%"> Name </th>
                                    <th> Email </th>
                                    <th> URL </th>
                                    <th style="width: 5%"> Like Working? </th>
                                    <th> Created At </th>
                                    <th> Actions </th>
                                </tr>
                                <tr>
                                    <th> <input class="form-control form-filter" name="candidate_name" id="candidate_name" type="text"> </th>
                                    <th> <input class="form-control form-filter" name="candidate_email" id="candidate_email" type="text"> </th>
                                    <th>  </th>
                                    <th>  </th>
                                    <th>  </th>
                                    <th>
                                        <button class="btn btn-xs blue filter-submit"> Search <i class="fa fa-search"></i> </button>
                                        <button class="btn btn-xs default filter-cancel"> Reset <i class="fa fa-undo"></i> </button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("input[name='candidate_email']").on('keyup',function(){
                var candidate_email = $('#candidate_email').val();
                $("input[name='candidate_email']").val(candidate_email);
                $(".filter-submit").trigger('click');
            });
            $("input[name='candidate_name']").on('keyup',function(){
                var candidate_name = $('#candidate_name').val();
                $("input[name='candidate_name']").val(candidate_name);
                $(".filter-submit").trigger('click');
            });
            var oTable3 = $('#userTable').DataTable({
                "processing": true,
                "serverSide": true,
                "searching":true,
                bFilter: true,
                "ajax": {
                    "url": "/listing",
                    "data": function ( d ) {
                        d.search_name = $('#candidate_name').val();
                        d.search_email = $('#candidate_email').val();
                    },
                    type: "get",  // method  , by default get
                    error: function () {  // error handling

                    }
                }
            });
        } );
    </script>
@endsection
