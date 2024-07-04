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
            $alert_dismiss = view('Admin.common.alert-dismiss', ['type' => $alert['type'], 'message' => $alert['msg']]);
            echo $alert_dismiss;
        }
   ?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List<small>All User Type</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            
                            <th>Status</th>
                            <th>Created by</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                        @if($data)
                            @foreach($data as $val)
                                 <tr>
                                 <td>{{ $val->name }}</td>
                                 <td>{{ $val->status == 1 ? 'Active' : 'Inactive' }}</td>
                                 <td>{{ $val->created_at }}</td>
                                 <td> <a href="{{ url('admin/settings/usertype/'.$val->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                 <a href="{{ url('admin/settings/usertype/'.$val->id.'/delete') }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a></td>
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
@endsection
