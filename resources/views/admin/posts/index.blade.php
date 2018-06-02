@extends('layouts.admin')

@section('heading') Posts @endsection

@section('content')

    @if(session('message'))
        <p class="alert alert-success">{{session('message')}}</p>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Control</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>
                    <a href="{{route('admin.posts.show', $post->id)}}">
                        <img src="{{$post->photo ? $post->photo->photoPath() : 'http://placehold.it/85x70?text=No Photo'}}" alt="" class="user_photo_thumb">
                    </a>
                </td>
                <td>{{$post->title}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->category->name}}</td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td>{{$post->updated_at->diffForHumans()}}</td>
                <td>
                    <a href="{{route('admin.posts.edit', $post->id)}}">
                        <i class="fa fa-fw fa-wrench"></i>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection