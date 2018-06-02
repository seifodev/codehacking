@extends('layouts.admin')

@section('heading')
Users
@endsection



@section('content')

    @if(session('message'))
        <p class="alert alert-success">{{session('message')}}</p>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Active</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Control</th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>
                    <a href="{{route('admin.users.show', $user->id)}}">
                        <img src="{{$user->photo ? $user->photo->photoPath() : 'http://placehold.it/85x70?text=No Photo'}}" alt="" class="user_photo_thumb">
                    </a>
                </td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role->name}}</td>
                <td>
                    <i class="fa fa-fw fa-{{$user->is_active ? 'check-circle text-success' : 'times-circle text-danger'}}"></i>
                </td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->updated_at->diffForHumans()}}</td>
                <td>
                    <a href="{{route('admin.users.edit', $user->id)}}">
                        <i class="fa fa-fw fa-wrench"></i>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
    </div>
@endsection