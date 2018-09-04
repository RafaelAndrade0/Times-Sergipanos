@extends('layouts.app')

@section('content')
    <h1>Cadastrar Times</h1>
    {!! Form::open(['action' => 'TimesController@store', 'method' => 'POST', 'enctype' => 
        'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}           
            </div>
            <div class="form-group">
                {{Form::label('body', 'Body')}}
                {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body Text'])}}           
            </div>
            
            <div class="form-group">
                {{Form::label('cover_image', 'Cover Image')}}
                {{Form::file('cover_image')}}
            </div>

            <div class="form-group">
                {{Form::label('header_image', 'Header Image')}}
                {{Form::file('header_image')}}
            </div>

            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection