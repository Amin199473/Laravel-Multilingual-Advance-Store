<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Hash;
use Svg\Tag\Rect;

class FrontHomeController extends Controller
{
    public function index()
    {

        $posts = Post::latest()->take(4)->get();
        $products = Product::where('status', 1)->latest()->limit(6)->get();
        $sliders = Slider::where('status', 1)->latest()->limit(3)->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $featuredProducts = Product::where('featured', 1)->latest()->limit(6)->get();
        $hotDealProducts = Product::where('hot_deals', 1)->where('discount_price', '!=', null)->latest()->limit(3)->get();
        $specialDealsProducts = Product::where('special_deals', 1)->latest()->limit(3)->get();

        $skip_category = Category::skip(0)->first();
        $skip_products = Product::where('status', 1)->where('category_id', $skip_category->id)->orderBy('id', 'DESC')->get();

        $skip_category_1 = Category::skip(1)->first();
        $skip_products_1 = Product::where('status', 1)->where('category_id', $skip_category_1->id)->orderBy('id', 'DESC')->get();

        $skip_brand = Brand::skip(5)->first();
        $skip_products_brand = Product::where('status', 1)->where('brand_id', $skip_brand->id)->orderBy('id', 'DESC')->get();
        return view('frontend.index', compact([
            'categories',
            'sliders',
            'products',
            'featuredProducts',
            'hotDealProducts',
            'specialDealsProducts',
            'skip_category',
            'skip_products',
            'skip_category_1',
            'skip_products_1',
            'skip_brand',
            'skip_products_brand',
            'posts'
        ]));
    }

    public function UserLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function UserProfile()
    {
        $user = Auth::user();
        return view('frontend.userProfile.index', compact('user'));
    }

    public function UserProfileEdit(Request $request, $id)
    {
        $user = User::find($id);
        // dd($user->profile_photo_path);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        //upload Profile Image
        if ($request->hasFile('image')) {
            @unlink(public_path('storage/' . $user->profile_photo_path));
            $photo = $request->file('image');
            $filename = 'profile-photos/' . time() . '.' . $photo->getClientOriginalExtension();
            $location = public_path('storage/profile-photos');
            $request->file('image')->move($location, $filename);
            $user->profile_photo_path = $filename;
        }
        $user->save();
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function UserChangePassword()
    {
        return view('frontend.userProfile.changePassword');
    }

    public function UserUpdatePassword(Request $request)
    {
        $validateRequest = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        } else {
            $notification = array(
                'message' => 'the Current password is not correct',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
    }



    public function Posts()
    {
        $postCategories = PostCategory::latest()->get();
        $posts = Post::latest()->paginate(3);
        return view('frontend.post.posts', compact('posts', 'postCategories'));
    }

    public function PostDetail($id)
    {
        $post = Post::findOrFail($id);
        $postCategories = PostCategory::latest()->get();
        return view('frontend.post.detail', compact('post', 'postCategories'));
    }



    public function PostFindByCategory($id)
    {
        //find post by category_id
        $posts = Post::where('category_id', $id)->orderBy('id', 'DESC')->paginate(3);
        $postCategories = PostCategory::latest()->get();
        return view('frontend.post.posts', compact('posts', 'postCategories'));
    }

    public function ProductSearch(Request $request)
    {
        $request->validate(["search" => "required"]);

        $item = $request->search;
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $products = Product::where('product_name_en', 'LIKE', "%$item%")->get();
        return view('frontend.product.search_product', compact('products','categories'));
    }



    public function AdvanceSearch(Request $request){
        $request->validate(["search" => "required"]);

        $item = $request->search;
        $products = Product::where('product_name_en', 'LIKE', "%$item%")->select('product_name_en', 'product_thumbnail', 'selling_price', 'id', 'product_slug_en')->limit(5)->get();
        return view('frontend.product.advanceSearch_product', compact('products'));
    }
}
