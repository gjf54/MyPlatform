@extends('layouts.main_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('styles/profile.css') }}">
@endsection

@section('title')
Profile
@endsection()

@section('content')

<div class="header">
        <div class="grey"></div>
        <div class="header_content">
                <div class="main">
                        <img src="{{ asset(Storage::url($user->image)) }}" alt="avatar">
                        <div class="text">        
                                <span role="nameSurname">{{ $user->name }} {{ $user->surname }}</span>
                                <span role="login"> <?php echo '@'.$user->login ?></span>
                        </div>
                </div>
                <div class="buttons">
                        <div>
                                <div class="dropdown">
                                        <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                          Edit Profile
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="{{ route('edit_data') }}">Edit Name/Surname</a></li>
                                          <li><a class="dropdown-item" href="{{ route('edit_avatar') }}">Edit Avatar</a></li>
                                          <li><a class="dropdown-item" href="{{ route('edit_password') }}">Edit password</a></li>
                                          <li><a class="dropdown-item" href="{{ route('edit_email') }}">Edit E-Mail</a></li>
                                        </ul>
                                </div>
                                @if($user->can('write_posts'))
                                <div>
                                        <a href="{{ route('dashboard') }}" class="btn btn-primary">DashBoard</a>
                                </div>
                                @endif
                                <div>
                                        <a href="{{ route('logout') }}" role="logout" class="btn btn-danger">Log out</a>
                                </div>
                        </div>
                </div>
        </div>
</div>

@endsection()
