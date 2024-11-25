<?php

namespace App\Http\Controllers;

use App\Models\Land;
use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandsController extends Controller
{
    public function index()
    {
        $lands = Land::with('user')->whereStatus(1)->get();
        $locations = Land::select('location')->whereStatus(1)->GroupBy('location')->get();
        return view('lands', compact('lands', 'locations'));
    }

    public function landDetail(string $id)
    {
        $land = Land::with('user')->where('id', $id)->first();
        $rent = Rent::where('buyer_id', '=', Auth::id())->where('land_id', '=', $id)->get();
        return view('landDetail', compact('land', 'rent'));
    }

    public function search(Request $request)
    {
        $lands = Land::with('user')
            ->when($request->location, function ($query, $location) {
                $query->where('location', 'LIKE', "%$location%");
            })
            ->when($request->price, function ($query, $price) {
                $priceRange = explode('-', $price); // Example: "1000-5000"
                if (count($priceRange) === 2) {
                    $query->whereBetween('price_per_month', [$priceRange[0], $priceRange[1]]);
                } else {
                    $query->where('price_per_month', '<=', $price);
                }
            })
            ->whereStatus(1)
            ->get();
        $locations = Land::select('location')->whereStatus(1)->GroupBy('location')->get();
        return view('lands', compact('lands', 'locations'));
    }

    public function appliedLands()
    {

        $requests = Land::select('lands.price_per_month', 'lands.location', 'rents.id as rent_id', 'rents.status', 'users.name')
            ->join('rents', 'lands.id', '=', 'rents.land_id')
            ->join('users', 'lands.seller_id', '=', 'users.id')
            ->where('rents.buyer_id', Auth::id())
            ->get();

        return view('appliedLands',compact('requests'));
    }
}
