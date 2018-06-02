@extends('layouts.admin')

@section('heading')
    <i class="fa fa-fw fa-plus"></i>
    Create New Post
@endsection

@section('content')

    @include('includes.form_errors')

    {!! Form::open([
        'method'        => 'POST',
        'action'        => 'PostsController@store',
        'files'         => true,
        'class'         => 'form-horizontal',
    ]) !!}

    <div class="form-group">
        {!! Form::label('category_id', 'Category', ['class' => 'control-label col-md-2']) !!}
        <div class="col-md-5">
            {!! Form::select('category_id', ['' => 'Choose Option'] + $categories, null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('title', 'Title', ['class' => 'control-label col-md-2']) !!}
        <div class="col-md-5">
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Post Title']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('body', 'Content', ['class' => 'control-label col-md-2']) !!}
        <div class="col-md-5">
            {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Enter Post Content', 'rows' => 8]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('photo', 'Photo', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::file('photo', ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-5 col-md-offset-2">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection