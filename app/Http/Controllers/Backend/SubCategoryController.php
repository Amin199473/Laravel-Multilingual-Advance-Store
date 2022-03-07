<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::latest()->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        return view('backend.subcategory.index', compact('subcategories', 'categories'));
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
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_persian' => 'required',
        ], [
            'category_id.required' => 'Please Select Any option',
            'subcategory_name_en.required' => 'Input subcategory Englis Name',
            'subcategory_name_persian.required' => 'Input subcategory Persian Name',
        ]);


        $subcategory = new SubCategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->subcategory_name_en = $request->subcategory_name_en;
        $subcategory->subcategory_name_persian = $request->subcategory_name_persian;
        $subcategory->subcategory_slug_en = strtolower(str_replace(' ', '-', $request->subcategory_name_en));
        $subcategory->subcategory_slug_persian = strtolower(str_replace(' ', '-', $request->subcategory_name_persian));
        $subcategory->save();

        $notification = array(
            'message' => 'the subCategory Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subcategory)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('backend.subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subcategory)
    {

        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_persian' => 'required',
        ], [
            'category_id.required' => 'Please Select Any option',
            'subcategory_name_en.required' => 'Input subcategory Englis Name',
            'subcategory_name_persian.required' => 'Input subcategory Persian Name',
        ]);


        $subcategory->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_persian' => $request->subcategory_name_persian,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_persian' => strtolower(str_replace(' ', '-', $request->subcategory_name_persian)),
        ]);

        $notification = array(
            'message' => 'the subCategory Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('subcategory.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subcategory)
    {
        $subcategory->delete();
        $notification = array(
            'message' => 'the SubCategory Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
