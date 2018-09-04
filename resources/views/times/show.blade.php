@extends('layouts.app')

@section('content')
    <a href="/times" class="btn btn-primary mt-2"><<< Voltar</a>
    <div class="card text-center mt-3">
        <div class="card-header">
            <h3>{{$time->title}}</h3>
        </div>
        <div class="card-body">
            {{-- <h5 class="card-title">Special title treatment</h5> --}}
            <img class="card-img-top img-fluid" src="/storage/header_images/{{$time->header_image}}"
                alt="Card image cap"
            >
            <p class="card-text">{{$time->body}}</p>
            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
        </div>
        {{-- <div class="card-footer text-muted">
            2 days ago
        </div> --}}
    </div>
@endsection