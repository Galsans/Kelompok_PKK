<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bookings = Reservation::where('status', 'pending')->get();
        $kamars = Rooms::where('status', 'tersedia')->get();

        $search = $request->input('search'); // Bisa email atau kode booking

        // Query data reservasi dengan filter email atau kode booking
        $reservations = Reservation::with(['rooms', 'users'])
            ->leftJoin('users', 'users.id', '=', 'reservations.user_id') // Menghubungkan tabel users
            ->when($search, function ($query) use ($search) {
                return $query->where('users.email', 'like', "%$search%") // Gunakan LIKE untuk hasil lebih fleksibel
                    ->orWhere('reservations.code_booking', 'like', "%$search%");
            })
            ->orderBy('reservations.created_at', 'desc') // Sort default by terbaru
            ->select('reservations.*') // Memastikan hanya mengambil kolom dari reservations
            ->get();

        return view('admin.reservation.index', compact('reservations', 'bookings', 'kamars'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $kode_bookings = 'BOOK-' . date('Ymd') . '-' . rand(1000, 9999);
        $rooms = Rooms::findOrFail($id);
        $users = Auth::user()->id;
        return view('admin.reservation.create', compact(['rooms', 'kode_bookings', 'users']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "code_booking" => 'required',
            "phone" => 'required',
            "user_id" => 'required',
            "room_id" => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        $input = $request->all();
        // $input['code_booking'] = Str::upper();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reservation = Reservation::find($id);
        return view('admin.reservation.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reservation = Reservation::find($id);
        return view('admin.reservation.edit', compact('reservation'));
    }


    public function checkOut($id)
    {
        $reservation = Reservation::where('id', $id)->where('status', 'confirm')->first();


        if (!$reservation) {
            return redirect()->back()->with('error', 'Reservasi tidak ditemukan atau status tidak valid.');
        }

        // Update data room and kamar
        $reservation->update([
            'status' => 'checkOut',
        ]);

        if ($reservation->rooms) {
            $reservation->rooms->update([
                'status' => 'maintenance'
            ]);
        }

        return redirect()->back()->with('success', 'Checkout berhasil dan status kamar diperbarui.');
    }

    public function confirmReservation(Request $request, $id)
    {
        $reservation = Reservation::where('id', $id)->where('status', 'pending')->first();

        // Update data reser$reservation
        $reservation->update([
            'status' => 'confirm',
        ]);

        return redirect()->back()->with('success', 'Konfimasi Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     $reservation = Reservation::find($id)->delete();
    //     return redirect()->route('reservation.index')->with('success', 'Berhasil Menghapus Data');
    // }
}
