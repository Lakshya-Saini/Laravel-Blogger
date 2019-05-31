<?php

namespace App\Http\Controllers;

use App\igration;
use Illuminate\Http\Request;
use App\Category;
use Session;

class CategoryController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
         return view('categories.index')->withCategories($categories);
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
            'name' => 'required|max:255'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'Category created successfully.');
        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\igration  $igration
     * @return \Illuminate\Http\Response
     */
    public function show(igration $igration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\igration  $igration
     * @return \Illuminate\Http\Response
     */
    public function edit(igration $igration)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\igration  $igration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, igration $igration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\igration  $igration
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        Session::flash('success', 'Category deleted successfully');
        return redirect('/categories');
    }
}
