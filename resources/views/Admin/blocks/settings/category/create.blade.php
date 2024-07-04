@extends('Admin.fixed.master')

@section('left_bar')
@include('Admin.fixed.left_bar')
@endsection

@section('top_bar')
@include('Admin.fixed.top_bar')
@endsection

@section('content')

@include('Admin.blocks.settings.category.tool_bar')

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
                <h2>{{ $page['pageName'] ? $page['pageName'] : '' }}</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <form class="form-horizontal form-label-left" novalidate method="post" action="{{ route($page['storeAction']) }}" enctype="multipart/form-data">

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12"  name="name" placeholder="Name" required="required" type="text" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="icon_name">
                            Category Icon 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="icon_name" class="form-control col-md-7 col-xs-12"  name="icon_name"  type="file" value="{{ old('icon_name') }}">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="radio">
                                <label>
                                    <input type="radio" checked="" value="1" id="optionsRadios1" name="status"> Enable
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" value="0" id="optionsRadios2" name="status"> Disable
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="priority_order">
                            Priority Order ( higher value will show first in API)
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="priority_order" class="form-control col-md-7 col-xs-12"  name="priority_order"  type="number" value="{{ old('priority_order') }}">
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
<script type="text/javascript">
$(function () {
    $('#icon_name').change(function () {
        var val = $(this).val().toLowerCase(),
            regex = new RegExp("(.*?)\.(png|jpg|jpeg)$");

        if (!(regex.test(val))) {
            $(this).val('');
            alert('Not a jpeg/jpg/png !!');
        }
    });
    
});

</script>
@endsection
