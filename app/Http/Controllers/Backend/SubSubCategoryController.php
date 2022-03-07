<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subsubcategory = SubSubCategory::latest()->get();
        // dd($subsubcategory);
        return view('backend.sub_subcategory.index', compact('categories', 'subsubcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    ///Action Method for handel Ajax request
    public function create(Request $request)
    {
        $category_id = $request->category_id;
        $subCategories = SubCategory::where('category_id', $category_id)->get();

        return response()->json($subCategories);
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
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_persian' => 'required',
        ], [
            'category_id.required' => 'Please Select Any option',
            'subcategory_id.required' => 'Please Select Any option',
            'subsubcategory_name_en.required' => 'Input subsubcategory Englis Name',
            'subsubcategory_name_persian.required' => 'Input subsubcategory Persian Name',
        ]);

        $subsubcategory = new SubSubCategory();
        $subsubcategory->category_id = $request->category_id;
        $subsubcategory->subcategory_id = $request->subcategory_id;
        $subsubcategory->subsubcategory_name_en = $request->subsubcategory_name_en;
        $subsubcategory->subsubcategory_name_persian = $request->subsubcategory_name_persian;
        $subsubcategory->subsubcategory_slug_en = strtolower(str_replace(' ', '-', $request->subsubcategory_name_en));
        $subsubcategory->subsubcategory_slug_persian = strtolower(str_replace(' ', '-', $request->subsubcategory_name_persian));
        $subsubcategory->save();

        $notification = array(
            'message' => 'the sub-subCategory Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubSubCategory  $subSubCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubSubCategory $subSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubSubCategory  $subSubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubSubCategory $subsubcategory)
    {

        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('backend.sub_subcategory.edit', compact('subsubcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubSubCategory  $subSubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubSubCategory $subsubcategory)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_persian' => 'required',
        ], [
            'category_id.required' => 'Please Select Any option',
            'subcategory_id.required' => 'Please Select Any option',
            'subsubcategory_name_en.required' => 'Input subsubcategory Englis Name',
            'subsubcategory_name_persian.required' => 'Input subsubcategory Persian Name',
        ]);

        $subsubcategory->category_id = $request->category_id;
        $subsubcategory->subcategory_id = $request->subcategory_id;
        $subsubcategory->subsubcategory_name_en = $request->subsubcategory_name_en;
        $subsubcategory->subsubcategory_name_persian = $request->subsubcategory_name_persian;
        $subsubcategory->subsubcategory_slug_en = strtolower(str_replace(' ', '-', $request->subsubcategory_name_en));
        $subsubcategory->subsubcategory_slug_persian = strtolower(str_replace(' ', '-', $request->subsubcategory_name_persian));
        $subsubcategory->save();

        $notification = array(
            'message' => 'the sub-subCategory Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('subsubcategory.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubSubCategory  $subSubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubSubCategory $subsubcategory)
    {
        $subsubcategory->delete();
        $notification = array(
            'message' => 'the Sub-SubCategory Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
