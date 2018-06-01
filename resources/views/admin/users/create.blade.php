@extends('layouts.admin')

@section('heading')
<i class="fa fa-fw fa-plus"></i>Create New User
@endsection

@section('content')

@include('includes.form_errors')

    {!! Form::open([
        'method'    => 'POST',
        'action'    => 'AdminUsersController@store',
        'files'      => true,
        'class'     => 'form-horizontal'
    ]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name', ['class' => 'control-label col-md-2']) !!}
        <div class="col-md-5">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Username']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email', ['class' => 'control-label col-md-2']) !!}
        <div class="col-md-5">
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email Address']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password', ['class' => 'control-label col-md-2']) !!}
        <div class="col-md-5">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'control-label col-md-2']) !!}
        <div class="col-md-5">
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('is_active', 'Status', ['class' => 'control-label col-md-2']) !!}
        <div class="col-md-5">
            {!! Form::select('is_active', ['' => 'Choose Option', 0 => 'Not Active', 1 => 'active'], null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('role_id', 'Role', ['class' => 'control-label col-md-2']) !!}
        <div class="col-md-5">
            {!! Form::select('role_id', ['' => 'Choose Option'] + $roles, null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('photo', 'Photo', ['class' => 'control-label col-md-2']) !!}
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