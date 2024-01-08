@extends('layouts.main_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('styles/welcome.css') }}">
@endsection

@section('title')
Project Platform
@endsection()

@section('content')

<div class="header">
    <img src="{{ asset('storage/imgs/welcome_page/header.jpg') }}" alt="header">
    <div class="header_text">
        <span role="title">Lorem ipsum dolor sit amet.</span>
        <span role="text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste exercitationem sint nihil itaque animi sit doloribus, suscipit quo sunt modi!</span>
        <a href="#" class="col-sm-12 col-md-2 btn btn-primary btn-lg active" aria-disabled="true" role="button">Buy it now</a> 
    </div>
</div>

<div class="description">
    <span role="title">Lorem ipsum dolor sit amet.</span>
    <ul>
        <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere, fugiat debitis tempora nihil earum culpa possimus!</li>
        <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere, fugiat debitis tempora nihil earum culpa possimus!</li>
        <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere, fugiat debitis tempora nihil earum culpa possimus!</li>
        <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere, fugiat debitis tempora nihil earum culpa possimus!</li>
    </ul>
</div>

<div class="figures row">
    <div class="figure col-xs-6">
        <div>
            <img src="{{ asset('storage/imgs/welcome_page/figure.jpg') }}" alt="figure">
            <span role="title">Lorem ipsum dolor sit amet.</span>
        </div>
        <span role="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore rerum voluptatum libero similique, aspernatur repellendus. Vel voluptas aliquam dolorum quas.</span>
    </div>
    <div class="figure col-xs-6">
        <div>
            <img src="{{ asset('storage/imgs/welcome_page/figure.jpg') }}" alt="figure">
            <span role="title">Lorem ipsum dolor sit amet.</span>
        </div>
        <span role="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore rerum voluptatum libero similique, aspernatur repellendus. Vel voluptas aliquam dolorum quas.</span>
    </div>
    <div class="figure col-xs-6">
        <div>
            <img src="{{ asset('storage/imgs/welcome_page/figure.jpg') }}" alt="figure">
            <span role="title">Lorem ipsum dolor sit amet.</span>
        </div>
        <span role="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore rerum voluptatum libero similique, aspernatur repellendus. Vel voluptas aliquam dolorum quas.</span>
    </div>
    <div class="figure col-xs-6">
        <div>
            <img src="{{ asset('storage/imgs/welcome_page/figure.jpg') }}" alt="figure">
            <span role="title">Lorem ipsum dolor sit amet.</span>
        </div>
        <span role="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore rerum voluptatum libero similique, aspernatur repellendus. Vel voluptas aliquam dolorum quas.</span>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/home.js') }}"></script>
@endsection