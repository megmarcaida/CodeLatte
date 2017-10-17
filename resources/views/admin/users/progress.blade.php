@extends('admin.layouts.app')

@section('content')
    <div class="mainpanel">

        <div class="contentpanel">

            <ol class="breadcrumb breadcrumb-quirk">
                <li><a href="/admin/home"><i class="fa fa-home mr5"></i> Home</a></li>
                <li class="active">Progress</li>
            </ol>
            <div class="row">
                <UsersProgress></UsersProgress>
            </div>
        </div><!-- contentpanel -->
    </div><!-- mainpanel -->
@endsection
