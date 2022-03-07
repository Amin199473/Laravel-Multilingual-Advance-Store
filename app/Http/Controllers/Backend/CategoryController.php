<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name_en' => 'required',
            'category_name_persian' => 'required',
            'category_icon' => 'required',
        ], [
            'category_name_en.required' => 'Input category English Name ',
            'category_name_persian.required' => 'Input category Persian Name',
            'category_icon.required' => 'Input category Icon',
        ]);


        $category = new Category();
        $category->category_name_en = $request->category_name_en;
        $category->category_name_persian = $request->category_name_persian;
        $category->category_slug_en = strtolower(str_replace(' ', '-', $request->category_name_en));
        $category->category_slug_persian = strtolower(str_replace(' ', '-', $request->category_name_persian));
        $category->category_icon = $request->category_icon;
        $category->save();

        $notification = array(
            'message' => 'the Category Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update([
            'category_name_en' => $request->category_name_en,
            'category_name_persian' => $request->category_name_persian,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_persian' => strtolower(str_replace(' ', '-', $request->category_name_persian)),
            'category_icon' => $request->category_icon
        ]);

        $notification = array(
            'message' => 'the Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        $notification = array(
            'message' => 'the Category Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
