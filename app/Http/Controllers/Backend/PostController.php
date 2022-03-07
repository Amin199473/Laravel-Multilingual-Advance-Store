<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('backend.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCategories = PostCategory::all();
        return view('backend.post.create', compact('postCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(780, 433)->save('upload/post-image/' . $name_gen);
        $save_url = 'upload/post-image/' . $name_gen;

        $post = new Post();
        $post->category_id = $request->category_id;
        $post->post_title_en = $request->post_title_en;
        $post->post_title_persian = $request->post_title_persian;
        $post->post_slug_en = strtolower(str_replace(' ', '-', $request->post_title_en));
        $post->post_slug_persian = strtolower(str_replace(' ', '-', $request->post_title_persian));
        $post->image = $save_url;
        $post->post_details_en = $request->post_details_en;
        $post->post_details_persian = $request->post_details_persian;
        $post->save();


        $notification = array(
            'message' => 'the Post Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('post.index')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $post = Post::findOrFail($id);
        $postCategories = PostCategory::all();
        return view('backend.post.edit',compact('post','postCategories'));
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

        $post = Post::findOrFail($id);

        if ($request->hasfile('image')) {
            @unlink(public_path($post->image));
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(780, 433)->save('upload/post-image/' . $name_gen);
            $save_url = 'upload/post-image/' . $name_gen;
        }

        $post->category_id = $request->category_id;
        $post->post_title_en = $request->post_title_en;
        $post->post_title_persian = $request->post_title_persian;
        $post->post_slug_en = strtolower(str_replace(' ', '-', $request->post_title_en));
        $post->post_slug_persian = strtolower(str_replace(' ', '-', $request->post_title_persian));
        $post->image = isset($save_url) ? $save_url : $post->image;
        $post->post_details_en = $request->post_details_en;
        $post->post_details_persian = $request->post_details_persian;
        $post->save();


        $notification = array(
            'message' => 'the Post Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('post.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        $notification = array(
            'message' => 'the Post Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
}
