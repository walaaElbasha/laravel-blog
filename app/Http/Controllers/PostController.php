<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

    public function index()
    {
        $allPosts = Post::paginate(9);

        return view('posts.index', [
            'posts' => $allPosts
        ]);
    }

    public function show($postId)
    {
        $post = Post::  find($postId); //object of Post model

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function edit($postId)
    {
        $post = Post::find($postId);
        return view('posts.edit', [
            'post' => $post,
            'users' => User::all()
        ]);
    }
    public function update($postId, Request $request)
    {
        $requestData= $request->all();
        $post = Post::find($postId);
        $post->update($requestData);
        $post->save();
        return redirect()->route('posts.index');
    }

  
        public function create()
    {
        return view('posts.create', [
            'users' => User::all()
        ]);
    }
    
    public function destroy($postId){

        $post = Post::findorfail($postId);
        
        $post->delete();
        return redirect()->route('posts.index');
        
        }
    

    public function store(Request $request) // == calling request()
    {
        // $requestData = request()->all();
        
        //another syntax
        // $title = request()->title;
        // $description = request()->description;

        $requestData = $request->all();

        // Post::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        // ]);

        Post::create($requestData);

        //another syntax
        // $post = new Post;
        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->save();

        return redirect()->route('posts.index');
    }


    
}
