@extends('layouts.app')

@section('content')
    {{-- @include('inc.messages') --}}
    <h1>Times Página Principal</h1>
    @foreach ($times as $time)
        <div class="card flex-row flex-wrap mt-3">
                <div class="card-header border-0">
                    <img src="/storage/cover_images/{{$time->cover_image}}" alt=""
                        
                    >
                </div>
                <div class="card-block px-2">
                    <h4 class="card-title">
                        <a href="/times/{{$time->id}}">{{$time->title}}</a>
                    </h4>
                    <p class="card-text">
                        {{-- Limitar Número de Caracteres(100) que aparecem na descrição do Index --}}
                        {{str_limit($time->body, 100)}}
                        <a href="/times/{{$time->id}}">(Ler mais)</a>
                    </p>
                </div>
                <div class="w-100"></div>
                <div class="card-footer w-100 text-muted">
                    <small>Created By: xyz</small>
                    <div class="float-right">
                        <a href="" class="btn btn-warning">Editar</a>
                        {{-- <a href="" class="btn btn-danger">Deletar</a> --}}
                        {!! Form::open(['action' => ['TimesController@destroy', $time->id], 'method' => 'POST',
                        'class' => 'float-right']) !!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Deletar', ['class' => 'btn btn-danger'])}}
                        {!! Form::close() !!}
                    </div>
                </div>
        </div>
    @endforeach
    {{$times->links()}}
@endsection