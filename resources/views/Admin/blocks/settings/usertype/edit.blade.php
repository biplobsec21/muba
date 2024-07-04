@extends('Admin.fixed.master')

@section('left_bar')
@include('Admin.fixed.left_bar')
@endsection

@section('top_bar')
@include('Admin.fixed.top_bar')
@endsection

@section('content')

@include('Admin.blocks.settings.usertype.tool_bar')

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

                <form class="form-horizontal form-label-left" novalidate method="post" action="{{ url('admin/settings/usertype/'.Request::segment(4).'/update') }}">


                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12"  name="name" placeholder="Name" required="required" type="text" value="{{ old('name',$resourceData->name ? $resourceData->name:'') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="radio">
                                <label>
                                    <input type="radio" value='1' {{ $resourceData->status == 1 ? 'checked=""' : ''  }}   id="optionsRadios1" name="status"> Enable
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" value="0" {{ $resourceData->status == 0 ? 'checked=""' : ''  }} id="optionsRadios2" name="status"> Disable
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
@endsection
