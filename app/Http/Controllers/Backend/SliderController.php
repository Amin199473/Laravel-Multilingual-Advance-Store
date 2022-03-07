<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.index', compact('sliders'));
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
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(870, 370)->save('upload/slider_img/' . $name_gen);
        $save_url = 'upload/slider_img/' . $name_gen;

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->slider_img = $save_url;
        $slider->save();

        $notification = array(
            'message' => 'the Slider Insert Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function InActiveSlider($id)
    {
        $slider = Slider::find($id);
        $slider->update([
            'status' => 0,
        ]);

        $notification = array(
            'message' => 'the Slider Status Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ActiveSlider($id)
    {

        $slider = Slider::find($id);
        $slider->update([
            'status' => 1,
        ]);

        $notification = array(
            'message' => 'the Slider Status Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('backend.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        if ($request->hasfile('image')) {
            @unlink(public_path($slider->slider_img));
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(870, 370)->save('upload/slider_img/' . $name_gen);
            $save_url = 'upload/slider_img/' . $name_gen;
        }

        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->slider_img = isset($save_url) ? $save_url : $slider->slider_img;
        $slider->save();

        $notification = array(
            'message' => 'the Slider Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('slider.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        $notification = array(
            'message' => 'the Slider Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('slider.index')->with($notification);
    }
}
