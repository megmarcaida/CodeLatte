@extends('admin.layouts.app')

@section('content')
    <div class="mainpanel">

        <div class="contentpanel">

            <ol class="breadcrumb breadcrumb-quirk">
                <li><a href="/admin/home"><i class="fa fa-home mr5"></i> Home</a></li>
                <li class="active">Plans</li>
            </ol>
            <div class="row">
                {{ csrf_field() }}
                <Plans></Plans>

                <ListPlans></ListPlans>
            </div>
        </div><!-- contentpanel -->
    </div><!-- mainpanel -->
@endsection
