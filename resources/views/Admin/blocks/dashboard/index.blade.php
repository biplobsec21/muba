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
<!-- top tiles -->
<div class="row tile_count">
    
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-group"></i></div>
                  <div class="count">179</div>
                  <h3>Total Category</h3>
                  <p>Total Category</p>
                </div>
              </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                  <div class="count">179</div>
                  <h3>Total PNG Images</h3>
                  <p>Total Number of png images</p>
                </div>
              </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">179</div>
                  <h3>Total JPG images </h3>
                  <p>Total number of jpg images</p>
                </div>
    </div>
</div>
<!-- /top tiles -->
@endsection

@section('foot_css_js')

@endsection
