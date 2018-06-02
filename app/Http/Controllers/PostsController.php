<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostsRequest;
use App\Photo;
use App\Category;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        $inputs = $request->all();


        $post = Auth::user()->posts()->create($inputs);

        // check if there is a photo to be uploaded
        if($photoUpload = Photo::upload($request))
        {
            // add the photo to the created post
            $post->photo()->save($photoUpload);

        }

        $request->session()->flash('message', 'post has been added successfully');
        return redirect()->route('admin.posts.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.posts.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsRequest $request, $id)
    {
        $inputs = $request->all();

        $post = Post::findOrFail($id);
        $post->update($inputs);

        // check if there is a photo to be uploaded
        if($photoUpload = Photo::upload($request))
        {
            // delete the old photo if existed
            if($post->photo)
            {
                $post->photo->delete();
            }
            // add the new uploaded photo to the updated users
            $post->photo()->save($photoUpload);
        }

        $request->session()->flash('message', 'Post has been updated successfully');
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
        $post = Post::findOrFail($id);
        $post->delete();
        session()->flash('message', 'Post has been deleted successfully');
        return redirect()->route('admin.posts.index');

    }
}
