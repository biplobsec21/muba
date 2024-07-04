@extends('Admin.fixed.master')

@section('left_bar')
@include('Admin.fixed.left_bar')
@endsection

@section('top_bar')
@include('Admin.fixed.top_bar')
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>
            <a class="btn btn-grey" href="{{ url('admin/adminuser/create') }}">
                <i class="fa fa-plus"></i> Add New User
            </a>
            <a class="btn btn-grey" href="{{ url('admin/adminuser') }}">
                <i class="fa fa-eye"></i> View All User
            </a>
        </h3>
    </div>
</div>

<div class="clearfix"></div>

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
                <h2>Add new user</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <form class="form-horizontal form-label-left" novalidate action="{{ route($page['storeAction']) }}" method="post">
              

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12"  name="name" placeholder="Name" required="required" type="text" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_name">User Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="user_name" class="form-control col-md-7 col-xs-12"  name="user_name"   placeholder="User Name" required="required" type="text" value="{{ old('user_name') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12"  value="{{ old('email') }}">
                        </div>
                    </div>



                    <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password" type="password" name="password" data-validate-length="3,4" class="form-control col-md-7 col-xs-12" required="required" value="{{ old('password') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required" value="{{ old('password2') }}">
                        </div>
                    </div>
                    
                    <div class="item form-group">
                        <label for="user_type" class="control-label col-md-3 col-sm-3 col-xs-12">User Type</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="user_type" required="required" value="{{ old('user_type') }}">
                                <option value="2"> Employee </option>
                                <option value="1"> Admin </option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button id="send" type="submit" class="btn btn-success">Submit</button>
                            <a type="submit" class="btn btn-cancel" href="{{ url()->previous() }}">Cancel</a>
                        </div>
                    </div>
                    
                    {{  csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('foot_css_js')
<script src="{{ asset('public/assets/validator/validator.js') }}"></script>
@endsection
