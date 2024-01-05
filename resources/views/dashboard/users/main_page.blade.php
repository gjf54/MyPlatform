@extends('layouts.dashboard_layout')

@section('title')
Users
@endsection

@section('content')
<div class="users_list">
    <div>
        @foreach($super_admins as $super_admin)
            <div class="user_field">
                {{ $super_admin->login }}
            </div>
        @endforeach
    </div>
    <div>
        @foreach($admins as $admin)
            <div class="user_field">
                {{ $admin->login }}
            </div>
        @endforeach
    </div>
    <div>
        @foreach($managers as $manager)
            <div class="user_field">
                {{ $manager->login }}
            </div>
        @endforeach
    </div>
    <div>
        @foreach($writers as $writer)
            <div class="user_field">
                {{ $writer->login }}
            </div>
        @endforeach()
    </div>
</div>
@endsection