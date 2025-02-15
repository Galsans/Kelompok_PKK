<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ComponentController extends Controller
{
    public function dashboard()
    {
        $userCount = DB::table('users')->count();
        $roomCount = DB::table('rooms')->count();
        $reservationCount = DB::table('reservations')->count();

        $dashUser = DB::table('rooms')->where('status', 'tersedia')->count();
        $auth = Auth::user();
        $reservUser = DB::table('reservations')->where('user_id', $auth)->count();

        return view('dashboard', compact('userCount', 'roomCount', 'reservationCount', 'dashUser', 'reservUser'));
    }
}
