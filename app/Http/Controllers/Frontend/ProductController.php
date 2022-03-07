<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Review;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ProductDetails($slug, $id)
    {
        // Approved Review by Admin
        $reviews = Review::where('status', 1)->where('product_id', $id)->latest()->limit(6)->get();
        $avarage = Review::where('product_id',$id)->where('status',1)->avg('rating');
        $product = Product::findOrFail($id);
        $colors_en = explode(',', $product->product_color_en);
        $colors_persian = explode(',', $product->product_color_persian);
        $sizes_en = explode(',', $product->product_size_en);
        $sizes_persian = explode(',', $product->product_size_persian);
        $productImages = MultiImg::where('product_id', $id)->get();
        $category_id = $product->category_id;
        $relatedProducts = Product::where('category_id', $category_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.product.productDetails', compact([
            'product',
            'productImages',
            'colors_en',
            'colors_persian',
            'sizes_en',
            'sizes_persian',
            'relatedProducts',
            'reviews',
            'avarage'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function TagWiseProduct($tag)
    {
        $productsTag = Product::where('status', 1)
            ->where('product_tags_en', 'LIKE', '%' . $tag . '%')
            ->orWhere('product_tags_persian', 'LIKE', '%' . $tag . '%')
            ->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('frontend.tag.tagWiseProduct', compact([
            'productsTag',
            'categories'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function SubCategoryProducts($id, $slug)
    {
        $products = Product::where('status', 1)
            ->where('subcategory_id', $id)
            ->orderBy('id', 'DESC')
            ->paginate(6);

        $breadcrumbSubCat = SubCategory::where('id', $id)->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('frontend.product.subCategoryProducts', compact('products', 'categories', 'breadcrumbSubCat'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function SubSubCategoryProducts($id, $slug)
    {
        $products = Product::where('status', 1)
            ->where('subsubcategory_id', $id)
            ->orderBy('id', 'DESC')
            ->paginate(6);

        $breadcrumbSubSubCat = SubSubCategory::where('id', $id)->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('frontend.product.subsubCategoryProducts', compact('products', 'categories','breadcrumbSubSubCat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ProductViewModal($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);
        $product_color = explode(',', $product->product_color_en);
        $product_size = explode(',', $product->product_size_en);

        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
    }
}
