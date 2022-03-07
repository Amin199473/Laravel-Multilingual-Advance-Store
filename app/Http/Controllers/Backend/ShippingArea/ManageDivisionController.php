<?php

namespace App\Http\Controllers\Backend\ShippingArea;

use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShipState;

class ManageDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('backend.ship.division.index', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $division = new ShipDivision();
        $division->division_name = $request->division_name;
        $division->save();

        $notification = array(
            'message' => 'the Division Create Successfully',
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
        $division = ShipDivision::findOrFail($id);
        return view('backend.ship.division.edit', compact('division'));
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
        $division = ShipDivision::findOrFail($id);
        $division->division_name = $request->division_name;
        $division->save();

        $notification = array(
            'message' => 'the Division Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manageDivision.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //delete Child Models From ShipDiviosion Model(parent Model)
        $districts = ShipState::where('division_id', $id)->get();
        if ($districts != null) {
            foreach ($districts as $district) {
                $district->delete();
            }
        }

        //delete Child Models From ShipDiviosion Model(parent Model)
        $districts = ShipDistrict::where('division_id', $id)->get();
        if ($districts != null) {
            foreach ($districts as $district) {
                $district->delete();
            }
        }

        $division = ShipDivision::findOrFail($id);
        $division->delete();
        $notification = array(
            'message' => 'the Division deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
