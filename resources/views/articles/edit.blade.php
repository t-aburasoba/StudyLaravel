@extends('layout')
 
@section('content')
    <h1>Edit: {{ $article->title }}</h1>
 
    <hr/>
 
    @include('errors.form_errors')
 
    {!! Form::model($article, ['method' => 'PATCH', 'route' => ['articles.show', $article->id]]) !!}
    @include('articles.form', ['published_at' => Carbon\Carbon::parse($article->published_at)->format('Y-m-d'), 'submitButton' => 'Edit Article'])
    {!! Form::close() !!}
 
@endsection