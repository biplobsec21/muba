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
            $alert_dismiss = view('Admin.common.alert-dismiss', ['type' => $alert['type'], 'message' => $alert['msg']]);
            echo $alert_dismiss;
        }
   ?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List<small>All Content</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>JPG Image</th>
                            
                            <th>PNG Image</th>
                            <th>Is New</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                        @if($data)
                            @foreach($data as $val)
                                 <tr>
                                 <td>{{ $val->get_category->name }}</td>
                                 <td>
                                    @if($val->jpg_name)

        <a href="{{ asset('public/uploads_images/'.$val->cat_id.'/jpg/'.$val->jpg_name) }}" data-lightbox="{{ asset('public/uploads_images/'.$val->cat_id.'/jpg/'.$val->jpg_name) }}" data-title="{{ $val->get_category->name }} JPG Image {{ $val->id }}">
            <img src="{{ asset('public/uploads_images/'.$val->cat_id.'/jpg/'.$val->jpg_name) }}" width="100" height="100" /> 
        </a>                                   
                                    @else 
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($val->png_name)
        <a href="{{ asset('public/uploads_images/'.$val->cat_id.'/png/'.$val->png_name) }}" data-lightbox="{{ asset('public/uploads_images/'.$val->cat_id.'/png/'.$val->png_name) }}" data-title="{{ $val->get_category->name }} PNG Image {{ $val->id }}">
            <img src="{{ asset('public/uploads_images/'.$val->cat_id.'/png/'.$val->png_name) }}" width="100" height="100" /> 
        </a>
                                    @else 
                                        N/A
                                    @endif
                                </td>
                                 <td>
                                     {{ $val->is_new == 1 ? 'YES' : 'NO' }}</td>
                                 <td>{{ $val->created_at }}</td>
                                 <td> <a href="{{ url('admin/content/'.$val->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                 <a href="{{ url('admin/content/'.$val->id.'/delete') }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a></td>
                                </tr>

                                @endforeach
                            @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection

@section('foot_css_js')
<script src="{{ asset('public/assets/validator/validator.js') }}"></script>
<script src="{{ asset('public/assets/lightbox.js') }}"></script>
@endsection
