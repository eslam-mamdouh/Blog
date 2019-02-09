@extends('layout')
@section('content')
    
    @foreach ($posts as $post)
        
        <div class="post col-sm-10 col-lg-5">
            <p class="title">{{$post->title}}</p>
            <span class="category">{{$post->category->name}}</span>
            <p class="desc">{{$post->description}}</p>
            <a href="/posts/{{$post->id}}" class="btn btn-info btn-circle">Details</a>
        </div>
    @endforeach

@endsection