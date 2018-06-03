@extends('layouts.admin')

@section('heading')
    Categories
@endsection

@section('content')

    @include('includes.form_errors')

    @if(session('message'))
        <p class="alert alert-success">{{session('message')}}</p>
    @endif

    <button class="btn btn-info category-create-btn">New Category <i class="fa fa-plus"></i></button>

    <div class="category-create">

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

    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">

            <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Control</th>
            </tr>
            </thead>

            <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->created_at->diffForHumans()}}</td>
                <td>{{$category->updated_at->diffForHumans()}}</td>
                <td>
                    <a href="{{route('admin.categories.edit', $category->id)}}">
                        <i class="fa fa-fw fa-wrench"></i>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
    </div>

@endsection