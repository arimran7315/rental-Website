<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Land;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lands = Land::where('seller_id',Auth::id())->get();
        return view('admin.lands.lands', compact('lands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $land = $request->validate([
            'location' => 'required|string|max:255',
            'address' => 'required',
            'price_per_month' => 'required',
        ], [
            'location.required' => 'Location is required',
            'location.string' => 'Location must be a string',
            'location.max' => 'Location must be less than 255 characters',
            'address.required' => 'Address is required',
            'price_per_month.required' => 'Price is required',
        ]);
        Land::create([
            'address' => $request->address,
            'location' => $request->location,
            'price_per_month' => $request->price_per_month,
            'description' => $request->description,
            'status' => 0,
            'seller_id' => Auth::id()
        ]);
        return redirect()->route('lands.index');
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
        $land = Land::find($id);
        return view('admin.lands.edit', compact('land'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        if($request->status == "approve"){
            $land = Land::find($id);
            $land->status = 1;
            $land->save();
            return redirect()->route('adminDashboard')->with([
                'type'=> 'success',
                'message'=> 'Land Approved Successfully'
            ]);
        }
        elseif($request->status == 'reject'){
            $land = Land::find($id);
            $land->status = 2;
            $land->save();
            return redirect()->route('adminDashboard')->with([
                'type'=> 'warning',
                'message'=> 'Land Rejected Successfully'
            ]);
        }else{
           $land = Land::whereId($id)->update([
            'location' => $request->location,
            'description' => $request->description,
            'address' => $request->address,
            'price_per_month' => $request->price_per_month,
           ]);
            return redirect()->route('lands.index')->with([
                'type' => 'success',
                'message' => 'Land Details Updated Successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $land = Land::find($id);

        if ($land) {
            $land->delete();
        }
        return redirect()->route('lands.index')->with([
            'type'=> 'warning',
            'message'=> 'Land Deleted Successfully'
        ]);
    }
}
