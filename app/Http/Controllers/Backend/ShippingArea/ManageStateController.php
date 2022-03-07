<?php

namespace App\Http\Controllers\Backend\ShippingArea;

use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShipState;

class ManageStateController extends Controller
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
        $states = ShipState::orderBy('state_name', 'ASC')->get();
        return view('backend.ship.state.index', compact([
            'divisions',
            'districts',
            'states',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetDistricts(Request $request)
    {

        $division_id = $request->division_id;
        $districts = ShipDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return response()->json($districts);
    }
    public function GetStates(Request $request)
    {
        $district_id = $request->district_id;
        $states = ShipState::where('district_id', $district_id)->orderBy('state_name', 'ASC')->get();
        return response()->json($states);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $state  = new ShipState();
        $state->division_id = $request->division_id;
        $state->district_id = $request->district_id;
        $state->state_name = $request->state_name;
        $state->save();

        $notification = array(
            'message' => 'the state Create Successfully',
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
        $state = ShipState::findOrFail($id);
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        return view('backend.ship.state.edit', compact([
            'state',
            'divisions',
            'districts',
        ]));
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
        $state = ShipState::findOrFail($id);
        $state->division_id = $request->division_id;
        $state->district_id = $request->district_id;
        $state->state_name = $request->state_name;
        $state->save();

        $notification = array(
            'message' => 'the state Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manageState.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = ShipState::findOrFail($id);
        $state->delete();

        $notification = array(
            'message' => 'the state Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
