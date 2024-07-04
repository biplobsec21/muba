@extends('Admin.fixed.master')

@section('left_bar')
@include('Admin.fixed.left_bar')
@endsection

@section('top_bar')
@include('Admin.fixed.top_bar')
@endsection

@section('content')

@include('Admin.blocks.content.tool_bar')
<link href="{{ asset('public/assets/lightbox.css') }}" rel="stylesheet">


<div class="row">
    <?php
        if( Session::has('alert') ) {
            $alert = Session::get('alert');
            $alert_dismiss = view('Admin.fixed.alert', ['type' => $alert['type'], 'message' => $alert['msg']]);
            echo $alert_dismiss;
        }
?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ $page['pageNameEdit'] ? $page['pageNameEdit'] : '' }}</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <form class="form-horizontal form-label-left" novalidate method="post" action="{{ url('admin/content/'.Request::segment(3).'/update') }}" enctype="multipart/form-data">


                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_id">Category<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="cat_id" required="required">
                                @if($materialData)
                                 @foreach( $materialData as $material)
                                   <option value="{{ $material->id }}" {{ $resourceData->cat_id == $material->id ? 'selected' : '' }} > {{ $material->name }}</option>
                                 @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jgp_name">
                           Update   JPG Image  
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="jgp_name" class="form-control col-md-7 col-xs-12"  name="jgp_name"  type="file" value="{{ old('jgp_name') }}">
                            <input id="jgp_name" class="form-control col-md-7 col-xs-12"  name="jgp_name_h"  type="hidden" value="{{ $resourceData->jpg_name }}">
                            
                             @if($resourceData->jpg_name)
                            <div class="col-md-3 col-sm-12 col-xs-3">
                                 <br>
                                <img src="{{ asset('public/uploads_images/'.$resourceData->cat_id.'/jpg/'.$resourceData->jpg_name) }}" width="100" height="100" /> 
                            </div>
                        @endif
                        </div>

                    </div>

                    <div class="item form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="png_name">
                           Update   PNG Image  
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="png_name" class="form-control col-md-7 col-xs-12"  name="png_name"  type="file" value="{{ old('png_name') }}">
                            <input id="png_name" class="form-control col-md-7 col-xs-12"  name="png_name_h"  type="hidden" value="{{ $resourceData->png_name }}">
                            
                             @if($resourceData->png_name)
                            <div class="col-md-3 col-sm-12 col-xs-3">
                                 <br>
                                <img src="{{ asset('public/uploads_images/'.$resourceData->cat_id.'/png/'.$resourceData->png_name) }}" width="100" height="100" /> 
                            </div>
                        @endif
                        </div>

                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Is New 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="radio">
                                <label>
                                    <input type="radio" value='1' {{ $resourceData->is_new == 1 ? 'checked=""' : ''  }}   id="optionsRadios1" name="status"> Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" value="0" {{ $resourceData->is_new == 0 ? 'checked=""' : ''  }} id="optionsRadios2" name="status"> No
                                </label>
                            </div>
                        </div>
                    </div>

                    {{  csrf_field() }}
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button id="send" type="submit" class="btn btn-success">Submit</button>
                            <a type="submit" class="btn btn-primary" href="{{ url()->previous() }}" >Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('foot_css_js')
<script src="{{ asset('public/assets/validator/validator.js') }}"></script>
<script src="{{ asset('public/assets/lightbox.js') }}"></script>
<script type="text/javascript">
$(function () {
    $('#jpg_name').change(function () {
        var val = $(this).val().toLowerCase(),
            regex = new RegExp("(.*?)\.(jpg|jpeg)$");

        if (!(regex.test(val))) {
            $(this).val('');
            alert('Not a jpeg/jpg !!');
        }
    });
    $('#png_name').change(function () {
        var val = $(this).val().toLowerCase(),
            regex = new RegExp("(.*?)\.(png)$");

        if (!(regex.test(val))) {
            $(this).val('');
            alert('No a PNG file !! ');
        }
    });
});

</script>
@endsection
