<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postCategories = PostCategory::latest()->get();

        return view('backend.postCategory.index', compact('postCategories'));
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
        ], [
            'category_name_en.required' => 'Input category English Name ',
            'category_name_persian.required' => 'Input category Persian Name',
        ]);

        $postCategory = new PostCategory();
        $postCategory->postCategory_name_en = $request->category_name_en;
        $postCategory->postCategory_name_persian = $request->category_name_persian;
        $postCategory->postCategory_slug_en = strtolower(str_replace(' ', '-', $request->category_name_en));
        $postCategory->postCategory_slug_persian = strtolower(str_replace(' ', '-', $request->category_name_persian));
        $postCategory->save();

        $notification = array(
            'message' => 'the Category Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $postCategory = PostCategory::findOrFail($id);
        return view('backend.postCategory.edit', compact('postCategory'));
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
        $postCategory = PostCategory::findOrFail($id);
        $postCategory->postCategory_name_en = $request->category_name_en;
        $postCategory->postCategory_name_persian = $request->category_name_persian;
        $postCategory->postCategory_slug_en = strtolower(str_replace(' ', '-', $request->category_name_en));
        $postCategory->postCategory_slug_persian = strtolower(str_replace(' ', '-', $request->category_name_persian));
        $postCategory->save();

        $notification = array(
            'message' => 'the Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('postCategory.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postCategory = PostCategory::findOrFail($id);
        $postCategory->delete();
        $notification = array(
            'message' => 'the Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('postCategory.index')->with($notification);
    }
}
