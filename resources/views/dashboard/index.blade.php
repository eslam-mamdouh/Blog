@extends('dashboard.layout')
@section('content')
    <div class="dashContent row">
        <a href="/dashboard/posts" class="posts col-sm-12 col-md-4 col-lg-4">
            <i class="far fa-newspaper"></i>
            <span class="count">{{$posts}}</span>
            <h2>Posts</h2>
        </a>
        <a href="/dashboard/categories" class="categories col-sm-12 col-md-4 col-lg-4">
            <i class="fas fa-network-wired"></i>
            <span class="count">{{$categories}}</span>
            <h2>Categories</h2>
        </a>
       
    </div>
@endsection