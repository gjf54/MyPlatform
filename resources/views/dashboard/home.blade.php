@extends('layouts.dashboard_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('styles/dashboard/home.css') }}">
@endsection

@section('title')
DashBoard
@endsection

@section('content')
<a href="{{ route('profile') }}" class="btn btn-outline-secondary" id="back_to_profile">Back to profile</a>
<div class="header">
    <div>
        <span role="title">Dashboard</span>
        <span role="description">This is admin panel where you can edit catalog and manage all users.</span>
    </div>
</div>
<div class="select_setting row">
    @if($user->can('control_user'))
    <div class="col-xl-3 col-md-6 col-sm-12 setting">
        <a href="{{ route('dashboard_users') }}"><span>Edit users</span></a>
    </div>
    @endif

    @if($user->can('edit_catalog'))
    <div class="col-xl-3 col-md-6 col-sm-12 setting">
        <a href="#"><span>Edit catalog</span></a>
    </div>
    @endif 

    @if($user->can('write_posts'))
    <div class="col-xl-3 col-md-6 col-sm-12 setting">
        <a href="{{ route('dashboard_writers_posts') }}"><span>Write post</span></a>
    </div>
    @endif

    @if($user->can('edit_settings'))
    <div class="col-xl-3 col-md-6 col-sm-12 setting">
        <a href="#"><span>Main settings</span></a>
    </div>
    @endif
</div>

@endsection 