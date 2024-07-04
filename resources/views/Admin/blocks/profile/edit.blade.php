@extends('Admin.fixed.master')

@section('navbar')
@include('Admin.fixed.nav')
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>
            <a class="btn btn-success" href="{{ url('admin/adminuser/create') }}">
                <i class="fa fa-plus"></i> Add New User
            </a>
            <a class="btn btn-success" href="{{ url('admin/adminuser') }}">
                <i class="fa fa-eye"></i> View All User
            </a>
        </h3>
    </div>
</div>

<div class="clearfix"></div>
<div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12">
        <div class="panel panel-default panel-cust">
            <div class="panel-heading">
                <div class="panel-title">
                    <div class="pull-left">Edit Page</div>
                    <div class="pull-right">
                        <a href="{{ route('admin.sourceinterview.create') }}" class="btn-sm btn-primary btn-cust-add"><span class="glyphicon glyphicon-plus"></span>&nbsp;Create New Source Interview</a>
                        <a href="{{ route('admin.sourceinterview.index') }}" class="btn-sm btn-primary btn-cust-view"><span class="glyphicon glyphicon-list"></span>&nbsp;List All Source Interview Name</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="panel-body">
                <?php
                // dd($alert);
                if ( Session::has('alert') ) {
                    $alert = Session::get('alert');
                    $alert_dismiss = view('Admin.common.alert-dismiss', ['type' => $alert['type'], 'message' => $alert['msg'] ]);
                    echo $alert_dismiss;
                }
                ?>
                <form class="" action="{{ route('admin.sourceinterview.update', $resourceData->id) }}" method="post">

                    <div class="form-group {{ ( $errors->has('name') ) ? 'has-error' : '' }}">
                        <label class="control-label" for="page_title">Updated Source Interview  Title</label>
                        <input class="form-control" type="text" id="page_title" name="name" value="{{ $resourceData->name }}" placeholder="Updated Prison Title">
                        <span class="help-block">{{ ( $errors->has('name') ) ? $errors->first('name') : '' }}</span>
                    </div>

                    <div class="form-group">

                        <label class="control-label" for="page-title">Source Interview Status</label><br>
                        <label class="radio-inline"><input type="radio" name="status" value="1" {{ $resourceData->status == 1 ? 'checked': '' }} >Active</label>
                        <label class="radio-inline"><input type="radio" name="status" value="0" {{ $resourceData->status == 0 ? 'checked': '' }}>Inactive</label>
                    </div>


                    <button class="btn btn-cust-1u btn-cust-save-1u" type="submit" name="update_button">
                        <span class="glyphicon glyphicon-ok"></span>
                        Update
                    </button>
                    <a class="btn btn-cust-1u btn-cust-cancel-1u" href="{{ route('admin.sourceinterview.index') }}" name="cancel_button">
                        <span class="glyphicon glyphicon-remove"></span>
                        Cancel
                    </a>
                    {{ csrf_field() }}
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
