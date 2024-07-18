@extends('layouts.dashboard_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('styles/dashboard/posts/main_list.css') }}">
@endsection

@section('title')
Writers Posts
@endsection()

@section('content')
<a href="{{ route('dashboard') }}" class="btn btn-outline-secondary" id="return_to_dashboard">К панели</a>
<div class="posts row g-5">
    <div class="add_post col-xl-5 col-md-12">
        <a href="{{ route('dashboard_create_post') }}">
            <span>Создать новый пост...</span>
        </a>
    </div>
    @foreach($posts as $post)
    <div class="post col-xl-5 col-md-12">
        <div>
            <div class="buttons">
                <a href="{{ route('dashboard_edit_post', ['id' => $post->id]) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('dashboard_delete_post', ['id' => $post->id]) }}" class="btn btn-outline-danger">Delete</a>
            </div>
            <span role="title">{{ $post->title }}</span>
            <span role="text">{{ $post->text }}</span>
            <hr>
            <span role="created_by">Posted by: {{ $post->creator_login }}, {{ $post->created_at }}</span>
            @if($post->is_edited)
                <span role="edited_by">Edited by: {{ $post->editor_login }}, {{ $post->updated_at }}</span>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection()
