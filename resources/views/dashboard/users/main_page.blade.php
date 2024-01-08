@extends('layouts.dashboard_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('styles/dashboard/users/main_page.css') }}">
@endsection

@section('title')
Users
@endsection

@section('content')
<a href="{{ route('dashboard') }}" class="btn btn-outline-secondary" id="return_to_dashboard_button">Return to dashboard</a>

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
        {{ $error }}
    @endforeach
</div>
@endif

<div class="users_list">
    <div class="users_group">
        <div class="header_field">
            <span role="group_title">Super-admin</span>
        </div>
        @foreach($super_admins as $super_admin)
            <div class="user_field">
                <span class="user_login" role="super_admin">
                    <?= '@'.$super_admin->login ?>
                </span>
            </div>
        @endforeach
    </div>
    <div class="users_group">
        <div class="header_field">
            <span role="group_title">Admins</span>
            @if($user->hasRole('admin') and !($user->hasRole('super_admin')))
                <a href="{{ route('dashboard_grant_role_to_user', ['role' => 'admin']) }}" class="btn btn-primary disabled" role="button" aria-disabled="true">Add</a>
            @else
            <a href="{{ route('dashboard_grant_role_to_user', ['role' => 'admin']) }}" class="btn btn-primary" role="button">Add</a>
            @endif
        </div>
        @foreach($admins as $admin)
            <div class="user_field">
                <span class="user_login" role="admin">
                    <?= '@'.$admin->login ?>
                </span>
                @if($user->hasRole('super_admin'))
                    <div class="user_control_buttons">
                        <a href="{{ route('dashboard_remove_user_role', ['id' => $admin->id, 'role' => 'admin']) }}" class="btn btn-danger">Remove user role</a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    <div class="users_group">
        <div class="header_field">
            <span role="group_title">Managers</span>
            <a href="{{ route('dashboard_grant_role_to_user', ['role' => 'manager']) }}" class="btn btn-primary">Add</a>
        </div>
        @foreach($managers as $manager)
            <div class="user_field">
                <span class="user_login" role="manager">
                    <?= '@'.$manager->login ?>
                </span>
                <div class="user_control_buttons">
                    <a href="{{ route('dashboard_remove_user_role', ['id' => $manager->id, 'role' => 'manager']) }}" class="btn btn-danger">Remove user role</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="users_group">
        <div class="header_field">
            <span role="group_title">Writers</span>
            <a href="{{ route('dashboard_grant_role_to_user', ['role' => 'writer']) }}" class="btn btn-primary">Add</a>
        </div>
        @foreach($writers as $writer)
            <div class="user_field">
                <span class="user_login" role="writer">
                <?= '@'.$writer->login ?>
                </span>
                <div class="user_control_buttons">
                    <a href="{{ route('dashboard_remove_user_role', ['id' => $writer->id, 'role' => 'writer']) }}" class="btn btn-danger">Remove user role</a>
                </div>
            </div>
        @endforeach()
    </div>
</div>
@endsection