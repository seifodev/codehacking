@extends('layouts.admin')

@section('heading')
    <i class="fa fa-fw fa-plus"></i>
    Create New Category
@endsection

@section('content')

    @include('includes.form_errors')

    {!! Form::open([
        'method'        => 'POST',
        'action'        => 'AdminCategoriesController@store',
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