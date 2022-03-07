<?php

namespace App\Http\Controllers\Backend\ShippingArea;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Http\Request;

class ManageDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();

        return view('backend.ship.district.index', compact('divisions', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $district = new ShipDistrict();
        $district->division_id = $request->division_id;
        $district->district_name = $request->district_name;
        $district->save();

        $notification = array(
            'message' => 'the District Create Successfully',
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
        $district = ShipDistrict::findOrFail($id);
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('backend.ship.district.edit', compact('district', 'divisions'));
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
        $district = ShipDistrict::findOrFail($id);
        $district->division_id = $request->division_id;
        $district->district_name = $request->district_name;
        $district->save();

        $notification = array(
            'message' => 'the District Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manageDistrict.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $district = ShipDistrict::findOrFail($id);
        $district->delete();
        $notification = array(
            'message' => 'the District Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manageDistrict.index')->with($notification);
    }
}
