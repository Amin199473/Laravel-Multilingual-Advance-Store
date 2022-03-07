<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;
use App\Models\MultiImg;
use App\Models\SubCategory;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('backend.product.index', compact('products'));
    }


    public  function GetSubSubCategory(Request $request)
    {
        $subcategory_id = $request->subcategory_id;
        $subsubcategories = SubSubCategory::where('subcategory_id', $subcategory_id)->get();

        return response()->json($subsubcategories);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/' . $name_gen);
        $save_url = 'upload/products/thumbnail/' . $name_gen;

        $product = new Product();
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->subsubcategory_id = $request->subsubcategory_id;
        $product->product_name_en = $request->product_name_en;
        $product->product_name_persian = $request->product_name_persian;
        $product->product_slug_en = strtolower(str_replace(' ', '-', $request->product_name_en));
        $product->product_slug_persian = strtolower(str_replace(' ', '-', $request->product_name_persian));
        $product->product_code = $request->product_code;
        $product->product_qty = $request->product_qty;
        $product->product_tags_en = $request->product_tags_en;
        $product->product_tags_persian = $request->product_tags_persian;
        $product->product_size_en = $request->product_size_en;
        $product->product_size_persian = $request->product_size_persian;
        $product->product_color_en = $request->product_color_en;
        $product->product_color_persian = $request->product_color_persian;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->short_description_en = $request->short_description_en;
        $product->short_description_persian = $request->short_description_persian;
        $product->long_description_en = $request->long_description_en;
        $product->long_description_persian = $request->long_description_persian;
        $product->product_thumbnail = $save_url;
        $product->hot_deals = $request->hot_deals;
        $product->featured = $request->featured;
        $product->status = $request->status;
        $product->special_offer = $request->special_offer;
        $product->special_deals = $request->special_deals;
        $product->save();

        //upload multi image product
        $multiImages = $request->file('multi_img');
        foreach ($multiImages as $img) {
            $imageName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/' . $imageName);
            $uploadPath = 'upload/products/multi-image/' . $imageName;

            //save single image in database
            $mulIimage = new MultiImg();
            $mulIimage->product_id = $product->id;
            $mulIimage->image_name = $uploadPath;
            $mulIimage->save();
        }


        $notification = array(
            'message' => 'the Product Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('product.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function UpdateProducImages(Request $request)
    {
        //upload multi image product
        if ($request->hasFile('multi_img')) {
            $productMultiImages = $request->multi_img;
            foreach ($productMultiImages as $id => $img) {
                $image = MultiImg::find($id);
                @unlink(public_path($image->image_name));
                $imageName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/' . $imageName);
                $uploadPath = 'upload/products/multi-image/' . $imageName;

                //Update image in database
                $image->product_id = $image->product_id;
                $image->image_name = $uploadPath;
                $image->save();
            }
        }

        $notification = array(
            'message' => 'the Product Images Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }



    public function DeleteProducImage($id)
    {
        $image = MultiImg::find($id);
        unlink(public_path($image->image_name));
        $image->delete();
        $notification = array(
            'message' => 'the Image Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // dd($product->id);
        $brands = Brand::all();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $images = MultiImg::where('product_id', $product->id)->get();
        return view('backend.product.edit', compact([
            'brands',
            'categories',
            'subcategories',
            'product',
            'images'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //Add new Image to multiple Image
        if ($request->hasFile('multi_img')) {
            //upload multi image product
            $multiImages = $request->file('multi_img');
            foreach ($multiImages as $img) {
                $imageName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/' . $imageName);
                $uploadPath = 'upload/products/multi-image/' . $imageName;
                //save single image in database
                $mulIimage = new MultiImg();
                $mulIimage->product_id = $product->id;
                $mulIimage->image_name = $uploadPath;
                $mulIimage->save();
            }
        }

        //Update Product thumbnail Image
        if ($request->hasFile('product_thumbnail')) {
            @unlink(public_path($product->product_thumbnail));
            $image = $request->file('product_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/' . $name_gen);
            $save_url = 'upload/products/thumbnail/' . $name_gen;
        }

        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->subsubcategory_id = $request->subsubcategory_id;
        $product->product_name_en = $request->product_name_en;
        $product->product_name_persian = $request->product_name_persian;
        $product->product_slug_en = strtolower(str_replace(' ', '-', $request->product_name_en));
        $product->product_slug_persian = strtolower(str_replace(' ', '-', $request->product_name_persian));
        $product->product_code = $request->product_code;
        $product->product_qty = $request->product_qty;
        $product->product_tags_en = $request->product_tags_en;
        $product->product_tags_persian = $request->product_tags_persian;
        $product->product_size_en = $request->product_size_en;
        $product->product_size_persian = $request->product_size_persian;
        $product->product_color_en = $request->product_color_en;
        $product->product_color_persian = $request->product_color_persian;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->short_description_en = $request->short_description_en;
        $product->short_description_persian = $request->short_description_persian;
        $product->long_description_en = $request->long_description_en;
        $product->long_description_persian = $request->long_description_persian;
        $product->product_thumbnail = isset($save_url) ? $save_url : $product->product_thumbnail;
        $product->hot_deals = $request->hot_deals;
        $product->featured = $request->featured;
        $product->status = $request->status;
        $product->special_offer = $request->special_offer;
        $product->special_deals = $request->special_deals;
        $product->save();

        $notification = array(
            'message' => 'the Product Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        $notification = array(
            'message' => 'the Product Daleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function ProductInactive($id)
    {
        $product = Product::find($id);
        $product->update([
            'status' => 0
        ]);
        $notification = array(
            'message' => 'the Status Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ProductActive($id)
    {
        $product = Product::find($id);
        $product->update([
            'status' => 1
        ]);
        $notification = array(
            'message' => 'the Status Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ProductStock(){
        $products = Product::latest()->get();
        return view('backend.stock.product',compact('products'));
    }
}
