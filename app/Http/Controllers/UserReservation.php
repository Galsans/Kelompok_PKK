<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserReservation extends Controller
{
    public function index()
    {
        $user = Auth::id();
        $reservation = Reservation::where('user_id', $user)->get();
        return view('user.reservation.index', compact('reservation'));
    }

    public function create()
    {
        $kode_bookings = 'BOOK-' . date('Ymd') . '-' . rand(1000, 9999);
        return view('user.reservation.create', compact('kode_bookings'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "phone" => 'required',
            "type_room" => 'required|in:suite,deluxe,standard',
            "guest_count" => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        $input = $request->all();
        $input['user_id'] = Auth::id();
        $reservation = Reservation::create($input);

        return redirect()->route('userReservation.index');
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        return redirect()->route('userReservation.index');
    }
}
