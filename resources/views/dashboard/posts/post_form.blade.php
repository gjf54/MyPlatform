@extends('layouts.dashboard_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('styles/dashboard/posts/post_form.css') }}">
@endsection

@section('title')
@if($status == 'create')
Create post
@endif

@if($status == 'edit')
Edit post
@endif
@endsection

@section('content')
<a href="{{ route('dashboard_writers_posts') }}" class="btn btn-outline-secondary" id="return_to_posts_button">Return to posts</a>
<div class="form">
    <form action="<?php 
        if($status == 'create'){ 
            echo route('dashboard_send_created_post');
        }else { 
            echo route('dashboard_send_edit_post', ['id' => $post->id]);
        }
        ?>" method="POST">
        @csrf
        <div class="mb-3 d-flex flex-column">
            <label for="title" class="form-label">Enter title of post</label>
            <input type="text" name="title" class="form-control" 
                <?php 
                    if($status == 'edit') {
                        echo 'value="'.$post->title.'"';
                    }
                ?>
            >
        </div>
        <div class="mb-3 d-flex flex-column form-floating">
            <textarea name="text" id="text_of_post" class="form-control">
                <?php 
                    if($status == 'edit') {
                        echo $post->text;
                    }
                ?>
            </textarea>
            <label for="title" class="form-label">Enter text of post</label>
        </div>
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
        
        @if(session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <button type="submit" class="btn btn-primary">
            @if($status == 'create')
            Create 
            @endif
    
            @if($status == 'edit')
            Save changes
            @endif      
        </button>
    </form>
</div>
@endsection