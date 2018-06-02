@extends('layouts.admin')

@section('heading')
    <i class="fa fa-fw fa-edit"></i>Edit {{$post->title}} Post

    {{--Delete Form--}}
    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'DELETE']) !!}
    {!! Form::submit('Delete Post', ['class' => 'btn btn-danger pull-right']) !!}
    {!! Form::close() !!}

@endsection

@section('content')

    @if(session('message'))
        <p class="alert alert-success">{{session('message')}}</p>
    @endif

    @include('includes.form_errors')


    <div class="row">

        <div class="col-md-8">

            {!! Form::model($post, [
                'method'    => 'PUT',
                'action'    => ['PostsController@update', $post->id],
                'files'     => true,
                'class'     => 'form-horizontal'
            ]) !!}

            <div class="form-group">
                {!! Form::label('category_id', 'Category', ['class' => 'control-label col-md-3']) !!}
                <div class="col-md-8">
                    {!! Form::select('category_id', ['' => 'Choose Option'] + $categories, null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            <div class="form-group">
                {!! Form::label('title', 'Title', ['class' => 'control-label col-md-3']) !!}
                <div class="col-md-8">
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Post Title']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('body', 'Content', ['class' => 'control-label col-md-3']) !!}
                <div class="col-md-8">
                    {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Enter Post Content', 'rows' => 8]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('photo', 'Photo', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::file('photo', ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-3">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>


            {!! Form::close() !!}


        </div>

        <div class="col-md-4">
            <img src="{{$post->photo ? $post->photo->photoPath() : 'http://placehold.it/200x200?text=No Photo'}}" alt="" class="img-responsive img-thumbnail">



        </div>

    </div>


@endsection