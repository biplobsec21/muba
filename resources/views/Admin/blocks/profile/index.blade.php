@extends('Admin.fixed.master')

@section('left_bar')
@include('Admin.fixed.left_bar')
@endsection

@section('top_bar')
@include('Admin.fixed.top_bar')
@endsection

@section('alert')
@include('Admin.fixed.alert')
@endsection

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>

            My Profile Info

        </h3>
    </div>
</div>

<div class="clearfix"></div>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                
                <div class="clearfix"></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 profile_left">
                
                <h4><b>Name:</b> {{ auth()->user()->name }}</h4>
                <h4><b>User Name:</b> {{ auth()->user()->username }}</h4>
                <h4><b>Email:</b> {{ auth()->user()->email }}</h4>
                <h4><b>User Type:</b>
                    @if(auth()->user()->user_type == 1)
                        Admin
                    @else
                        Employee
                    @endif
                </h4>
                <h4><b>Status:</b>
                    @if(auth()->user()->status == 1)
                        Active
                    @else
                        Inactive
                    @endif 
                </h4>

                <a class="btn btn-success" href="{{ url('admin/adminuser/'.auth()->user()->id.'/edit') }}"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
                <br>

               

            </div>
        </div>
    </div>

</div>

@endsection

@section('foot_css_js')
<script src="{{ asset('public/assets/validator/validator.js') }}"></script>
@endsection
