<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentLandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rent = Rent::create([
            'buyer_id' => Auth::id(),
            'land_id' => $request->land_id,
            'status' => 0
        ]);
        return redirect()->route('landDetailPage',$request->land_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->status == "approve"){
            $rent = Rent::find($id);
            $rent->status = 1;
            $rent->save();
            return redirect()->route('adminDashboard')->with([
                'type'=> 'success',
                'message'=> 'Land Approved Successfully'
            ]);
        }
        else{
            $rent = Rent::find($id);
            $rent->status = 2;
            $rent->save();
            return redirect()->route('adminDashboard')->with([
                'type'=> 'warning',
                'message'=> 'Land Rejected Successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
