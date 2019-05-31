<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Tag;

class BlogController extends Controller
{

    public function singlePost($slug) {
    	$post = Post::where('slug', '=', $slug)->first();
    	$tags = Tag::all();
    	return view('blog.singlePost')->withPost($post)->withTags($tags);
    }

}
