@extends('layouts.app')

<head>
    @vite('resources/sass/main.scss')
</head>

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="main__head">
                <img src="{{Vite::asset('resources/images/main_page_bg1.jpg')}}" alt="" class="main__head__image">
            </div>
        </div>
    </div>
    <main-page></main-page>
</div>
@endsection