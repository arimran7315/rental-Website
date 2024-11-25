<?php

namespace App\Http\Controllers;

use App\Models\Land;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'buyer') {
                $locations = Land::select('location', DB::raw('count(*) as location_count'))
                    ->where('status', 1)
                    ->groupBy('location')
                    ->get();;
                return view('index', compact('locations'));
            } else {
                if (Auth::user()->role == 'admin') {
                    $landRequests = Land::with('user')
                        ->where('lands.status', 0)
                        ->get();
                    return view('admin.dashboard', compact('landRequests'));
                } else {
                    $RentRequests = Rent::with('user')
                        ->orderBy('status', 'asc')
                        ->get();
                    return view('admin.dashboard', compact('RentRequests'));
                }
            }
        } else {
            $locations = Land::select('location', DB::raw('count(*) as location_count'))
    ->where('status', 1)
    ->groupBy('location')
    ->get();
            return view('index', compact('locations'));
        }
    }
    public function register(Request $request)
    {
        $user = $request->validate([
            'username' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role' => 'required'
        ], [
            'username.required' => 'This field is required!!',
            'username.email' => 'This must be a valid email address',
            'username.unique' => 'This email already exists',
            'password.required' => 'This field is required!!',
            'role.required' => 'This field is required!!'
        ]);

        $role = $request->role == 0 ? 'seller' : 'buyer';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        return redirect()->route('loginPage')->with([
            'type' => 'success',
            'message' => 'Account was successfully created'
        ]);
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'This field is required',
            'password.required' => 'This field is required'
        ]);
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('adminDashboard');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->back()->with([
                'type' => 'danger',
                'message' => 'Invalid username or password!!'
            ])->withInput($request->only('email'));
        }
    }
    public function logout()
    {
        Auth::logout();
        return  redirect()->route('loginPage');
    }
}
