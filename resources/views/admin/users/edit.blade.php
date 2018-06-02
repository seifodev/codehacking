@extends('layouts.admin')

@section('heading')
    <i class="fa fa-fw fa-edit"></i>Edit {{$user->name}} Profile

    {{--Delete Form--}}
    {!! Form::open(['action' => ['AdminUsersController@destroy', $user->id], 'method' => 'DELETE']) !!}
    {!! Form::submit('Delete User', ['class' => 'btn btn-danger pull-right']) !!}
    {!! Form::close() !!}

@endsection

@section('content')

    @if(session('message'))
        <p class="alert alert-success">{{session('message')}}</p>
    @endif

    @include('includes.form_errors')


    <div class="row">

        <div class="col-md-8">

            {!! Form::model($user, [
                'method'    => 'PUT',
                'action'    => ['AdminUsersController@update', $user->id],
                'files'     => true,
                'class'     => 'form-horizontal'
            ]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name', ['class' => 'control-label col-md-3']) !!}
                <div class="col-md-8">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Username']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Email', ['class' => 'control-label col-md-3']) !!}
                <div class="col-md-8">
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email Address']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password', ['class' => 'control-label col-md-3']) !!}
                <div class="col-md-8">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'control-label col-md-3']) !!}
                <div class="col-md-8">
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('is_active', 'Status', ['class' => 'control-label col-md-3']) !!}
                <div class="col-md-8">
                    {!! Form::select('is_active', ['' => 'Choose Option', 0 => 'Not Active', 1 => 'active'], null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('role_id', 'Role', ['class' => 'control-label col-md-3']) !!}
                <div class="col-md-8">
                    {!! Form::select('role_id', ['' => 'Choose Option'] + $roles, null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('photo', 'Photo', ['class' => 'control-label col-md-3']) !!}
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
            <img src="{{$user->photo ? $user->photo->photoPath() : 'http://placehold.it/200x200?text=No Photo'}}" alt="" class="img-responsive img-thumbnail">



        </div>

    </div>


@endsection