@extends('layout')
 
@section('content')
    <h1>Edit: {{$article->title}}</h1>
 
    <hr/>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($article, ['method' => 'PATCH', 'url' => ['articles', $article->id]]) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', 'Body:') !!}
            {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('published_at', 'Publish On:') !!}
            {!! Form::input('date', 'published_at',$article->published_at->format("Y-m-d H:i:s"), ['class' => 'form-control']) !!}
        </div>    
        <div class="form-group">
            {!! Form::submit('Edit Article', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}
@endsection