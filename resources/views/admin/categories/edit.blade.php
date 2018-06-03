@extends('layouts.admin')

@section('heading')
    <i class="fa fa-fw fa-edit"></i>
    Edit Category

    <div class="pull-right">
        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy', $category->id]]) !!}
        {!! Form::submit('Delete Category', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>
@endsection

@section('content')

    @if(session('message'))
        <p class="alert alert-success">{{session('message')}}</p>
    @endif

    @include('includes.form_errors')

    {!! Form::model($category, [
        'method'        => 'PUT',
        'action'        => ['AdminCategoriesController@update', $category->id],
        'class'         => 'form-horizontal'
    ]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Category Name']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-5 col-md-offset-2">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection