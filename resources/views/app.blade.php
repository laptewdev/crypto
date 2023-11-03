@extends('layouts.app')

<head>
    @vite('resources/sass/main.scss')
</head>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-title">Tracking cryptocurrency rates</h5>
                <div class="card-text">
                    using our service is very simple
                </div>
            </div>
        </div>
    </div>
    <main-page></main-page>
</div>
@endsection