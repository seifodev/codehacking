@extends('layouts.admin')

@section('heading')
    {{$post->title}}
@endsection

@section('content')

    <div class="row">

        <div class="col-md-9">
            {{$post->body}}
        </div>

        <div class="col-md-3">
            <img src="{{$post->photo ? $post->photo->photoPath() : 'http://placehold.it/200x200?text=No Photo'}}" alt="/" class="img-responsive img-thumbnail">
        </div>

    </div>

@endsection