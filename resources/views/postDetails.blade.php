@extends('layout')
@section('content')

<div class="post postDetails col-sm-10">
    <p class="title">{{$post->title}}</p>
    <span class="category">{{$post->category->name}}</span>
    <p class="content">{{$post->content}}</p>
</div>

@endsection