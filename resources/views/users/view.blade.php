@extends('admin.master')
@section('title','View User')
@section('css')
<!-- BEGIN PAGE LEVEL PLUGINS -->

<!-- END PAGE LEVEL PLUGINS -->
@endsection
@section('content')
<div class="page-wrapper">
    <div class="page-wrapper-row full-height">
        <div class="page-wrapper-middle">
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="container">
                            <ul class="page-breadcrumb breadcrumb">
                                <li>
                                    <a href="/users/manage">Manage Users</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">View User</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                            </ul>
                            <div class="col-md-12">
                                <!-- BEGIN VALIDATION STATES-->
                                <div class="portlet light ">
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <div class="form-group row">
                                                <div class="col-md-3" style="text-align: right">
                                                    <label for="name" class="control-label">Name</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <span>{!! $userInfo->name !!}</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3" style="text-align: right">
                                                    <label for="email" class="control-label">Email</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <span>{!! $userInfo->email !!}</span>
                                                </div>
                                            </div>
					    <div class="form-group row">
                                                <div class="col-md-3" style="text-align: right">
                                                    <label for="email" class="control-label">Web Address</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><a href='{!! $userInfo->url !!}'>{!! $userInfo->url !!}</a></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-3" style="text-align: right">
                                                    <label for="cover_letter" class="control-label">Cover Letter</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <span>{!! $userInfo->cover_letter !!}</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3" style="text-align: right">
                                                    <label for="ip" class="control-label">IP Address</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <span>{!! $userInfo->ip !!}</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3" style="text-align: right">
                                                    <label for="attachment" class="control-label">Attachment</label>
                                                </div>
                                                <div class="col-md-6">
                                                  <div id ="imagecorousel">
                                                      <table class="table table-bordered table-hover" style="width: 50px">
                                                          <thead>

                                                          </thead>
                                                          <tbody id="show-attachment">
                                                              <tr role="row" class="heading">
                                                                  <td>
                                                                      @if($userInfo['extention'] == 'pdf')
                                                                          <span class="imageTag"><img src="/assets/global/img/pdf.png" height="30px" width="30px" onclick="openPdf(this,'{{$userInfo['file_path']}}')"></span>
                                                                          <iframe id="myFrame" style="display:none" width="600" height="170"></iframe>
                                                                          <a href="javascript:void(0);"  class="btn btn-sm zoomOutButton" id="zoomOutButton" onclick = "closePdf(this,'{{$userInfo['file_path']}}')">Close PDF</a>
                                                                      @else
                                                                          <span class="imageTag"><img src="/assets/global/img/image.png" height="30px" width="30px" onclick="openImage(this)"></span>
                                                                          <a href="javascript:void(0);"  class="btn btn-sm zoomOutButton" id="zoomOutButton" onclick = "closeImage(this)">Close Image</a>
                                                                          <div id="imageDiv" hidden>
                                                                              <a href="{{$userInfo['file_path']}}">
                                                                                  <img id="image" src="{{$userInfo['file_path']}}" style="text-align:left;height: 170px">
                                                                              </a>
                                                                          </div>
                                                                      @endif
                                                                  </td>
                                                              </tr>
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
    </div>
</div>
@endsection
@section('javascript')
<script>
function openPdf(element,image){
    var myFrameElement = $(element).closest('tr').find('#myFrame');
    $(myFrameElement).attr('src',image);
    $(myFrameElement).show();
}
function closePdf(element){
    var myFrameElement = $(element).closest('tr').find('#myFrame');
    $(myFrameElement).hide();
}

function openImage(element){
    $(element).closest('tr').find('#imageDiv').show();
}

function closeImage(element){
    $(element).closest('tr').find('#imageDiv').hide();
}
</script>
@endsection
