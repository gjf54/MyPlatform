@extends('layouts.dashboard_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('styles/dashboard/home.css') }}">
@endsection

@section('title')
DashBoard
@endsection

@section('content')
<a href="{{ route('profile') }}" class="btn btn-outline-secondary" id="back_to_profile">К профилю</a>
<div class="header">
    <div>
        <span role="title">Панель управления</span>
        <span role="description">Админ панель для взаимодействия со всеми механизмами магазина.</span>
    </div>
</div>
<div class="select_setting row">
    @if($user->can('control_user'))
    <div class="col-xl-3 col-md-6 col-sm-12 setting">
        <a href="{{ route('dashboard_users') }}"><span>Права пользователей</span></a>
    </div>
    @endif

    @if($user->can('edit_catalog'))
    <div class="col-xl-3 col-md-6 col-sm-12 setting">
        <a href="{{ route('dashboard_catalog') }}"><span>Редактировать каталог</span></a>
    </div>
    @endif 

    @if($user->can('write_posts'))
    <div class="col-xl-3 col-md-6 col-sm-12 setting">
        <a href="{{ route('dashboard_writers_posts') }}"><span>Написать пост</span></a>
    </div>
    @endif

    @if($user->can('edit_settings'))
    <div class="col-xl-3 col-md-6 col-sm-12 setting">
        <a href="#"><span>Дополнительные настройки (в разработке)</span></a>
    </div>
    @endif
</div>

@endsection 