@extends('admin.master')
@section('title','Manage User')
@section('css')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link rel="stylesheet"  href="/assets/global/plugins/datatables/datatables.min.css"/>
<!-- END PAGE LEVEL PLUGINS -->
@endsection
@section('content')

<!-- END HEAD -->
    <div class="page-wrapper">
          <div class="page-wrapper-row full-height">
              <div class="page-wrapper-middle">
                  <!-- BEGIN CONTAINER -->
                  <div class="page-container">
                      <!-- BEGIN CONTENT -->
                      <div class="page-content-wrapper">
                          <div class="page-content">
                              <div class="container">
                                  <div class="row">
                                      <div class="col-md-12">
                                          <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                          <div class="portlet light ">
                                              {!! csrf_field() !!}
                                              <div class="portlet-body">
                                                  <table class="table table-striped table-bordered table-hover table-checkable order-column" id="userTable">
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
                      </div>
                  </div>
              </div>
          </div>
      </div>
@endsection

@section('javascript')
<link rel="stylesheet"  href="/assets/global/plugins/datatables/datatables.min.css"/>
<script  src="/assets/global/plugins/datatables/datatables.min.js"></script>
<script src="/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="/assets/custom/user/manage-datatable.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('#userTable').DataTable();
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
    });
</script>
@endsection
