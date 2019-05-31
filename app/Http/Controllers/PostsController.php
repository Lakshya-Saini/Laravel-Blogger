<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;
use Session;
use App\Category;
use App\Tag;

class PostsController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('blog.blog')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|integer',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug'
        ]);

        if($request->hasFile('featured_image'))
        {
            $file_with_extension = $request->file('featured_image')->getClientOriginalName();
            $filename = pathinfo($file_with_extension, PATHINFO_FILENAME);
            $file_extension = $request->file('featured_image')->getClientOriginalExtension();
            $filename_to_store = $filename . '_' . time() . '.' . $file_extension;
            $path = $request->file('featured_image')->storeAs('public/images', $filename_to_store);
        }
        else{
            $filename_to_store = 'noimage.png';
        }

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $filename_to_store;
        $post->category_id = $request->category_id;
        $post->slug = $request->slug;
        $post->user_id = auth()->user()->id;
        $post->save();

        $post->tags()->sync($request->tags, false);

        Session::flash('success', 'Post created successfully.');

        return redirect('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = Post::find($id);

        if(Auth()->user()->id != $post->user_id)
        {
            Session::flash('error', 'Unauthorized access');
            return redirect('/home');
        }

        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(Auth()->user()->id != $post->user_id)
        {
            Session::flash('error', 'Unauthorized access');
            return redirect('/home');
        }

        $categories = Category::all();
        $cats = [];
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $new_tags = [];
        foreach ($tags as $tag) {
            $new_tags[$tag->id] = $tag->name;
        }

        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($new_tags);
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

        $post = Post::find($id);

        if($request->slug == $post->slug)
        {
            $this->validate($request, [
                'title' => 'required|max:255',
                'description' => 'required',
                'category_id' => 'required|integer',
            ]);
        }
        else
        {
            $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|integer',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug'
            ]);
        }   

        if($request->hasFile('featured_image'))
        {
            $file_with_extension = $request->file('featured_image')->getClientOriginalName();
            $filename = pathinfo($file_with_extension, PATHINFO_FILENAME);
            $file_extension = $request->file('featured_image')->getClientOriginalExtension();
            $filename_to_store = $filename . '_' . time() . '.' . $file_extension;
            $path = $request->file('featured_image')->storeAs('public/images', $filename_to_store);
        }
        else{
            $filename_to_store = 'noimage.png';
        }

        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $filename_to_store;
        $post->category_id = $request->category_id;
        $post->slug = $request->slug;
        $post->save();

        if(isset($request->tags)){
            $post->tags()->sync($request->tags);
        }
        else
        {
            $post->tags()->sync([]);
        }
        

        Session::flash('success', 'Post updated successfully.');

        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(Auth()->user()->id != $post->user_id)
        {
            Session::flash('error', 'Unauthorized access');
            return redirect('/home');
        }

        $post->delete();

        Session::flash('success', 'Post deleted successfully');

        return redirect('home');
    }
}
