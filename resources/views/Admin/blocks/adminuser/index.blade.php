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
            $alert_dismiss = view('Admin.common.alert-dismiss', ['type' => $alert['type'], 'message' => $alert['msg']]);
            echo $alert_dismiss;
        }
    ?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List<small>All Users</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                       
                            @if($data)
                            @foreach($data as $val)
                                 <tr>
                                 <td>{{ $val->name }}</td>
                                 <td>{{ $val->username }}</td>
                                 <td>{{ $val->email }}</td>
                                 <td>{{ $val->user_type == 2 ? 'Employee' : 'Admin' }}</td>
                                 <td>{{ $val->created_at }}</td>
                                 <td> <a href="{{ url('admin/adminuser/'.$val->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                 <a href="{{ url('admin/adminuser/'.$val->id.'/delete') }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a></td>
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
