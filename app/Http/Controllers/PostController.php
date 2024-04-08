<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('blogs' , [
            'categories' => Category::WhereHas('posts' , function($query){
                $query->Published();
            })->take(5)->get()
        ]);
    }


    public function show($post_slug)
    {
        $single_post = Post::where('slug' , $post_slug)->first();
        if ($single_post) {
            return view('posts.single_post')->with('single_post'  , $single_post);
        }else{
            abort(404);
        }
    }
}
