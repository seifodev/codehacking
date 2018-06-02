<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use App\User;
use App\Role;
use App\Photo;

class AdminUsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $inputs = $request->all();

        $inputs['password'] = bcrypt($inputs['password']);
        $user = User::create($inputs);

        // Check if there is a photo to be uploaded
        if($photoUpload = Photo::upload($request))
        {
            // add the photo to the user
            $user->photo()->save($photoUpload);
        }

        session()->flash('message', 'User was added successfully');
        return redirect()->route('admin.users.index');


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name'          => 'required|max:255',
            'email'         => 'required|email|max:255|unique:users,email,'.$user->id,
            'password'      => 'sometimes|min:6|confirmed',
            'role_id'       => 'required|numeric',
            'photo'         => 'file',
            'is_active'     => 'required|digits_between:0,1',
        ]);

        if($request->password == '')
        {
            $inputs = $request->except('password');

        } else
        {
            $inputs = $request->all();
            $inputs['password'] = bcrypt($request->password);
        }


        $user->update($inputs);

        // Check if there is a photo to be uploaded
        if($photoUpload = Photo::upload($request))
        {
            // If there is an old photo, delete it
            if($user->photo)
            {
                $user->photo->delete();
            }

            // add the new photo to the user
            $user->photo()->save($photoUpload);
        }

        $request->session()->flash('message', 'User was updated successfully');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        session()->flash('message', 'User has been deleted successfully');
        return redirect()->route('admin.users.index');
    }
}
