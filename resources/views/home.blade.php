@extends('layouts.app')

@section('content')
<div class="container">
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
                                    <th> <input class="form-control form-filter" name="search_name" id="search_name" type="text"> </th>
                                    <th> <input class="form-control form-filter" name="search_email" id="search_email" type="text"> </th>
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
        $("input[name='search_name']").on('keyup',function(){
            var search_name = $('#search_name').val();
            $("input[name='search_name']").val(search_name);
            $(".filter-submit").trigger('click');
        });
        $("input[name='search_email']").on('keyup',function(){
            var search_email = $('#search_email').val();
            $("input[name='search_email']").val(search_email);
            $(".filter-submit").trigger('click');
        });
            var oTable3 = $('#userTable').DataTable({
                "processing": true,
                "serverSide": true,
                "searching":true,
                "ajax": {
                    "url": "/listing", // json datasource
                    type: "get",  // method  , by default get
                    error: function () {  // error handling

                        }
                    }
             });

    } );
    </script>
@endsection
