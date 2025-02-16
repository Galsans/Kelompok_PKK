<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Rooms;
use Carbon\Carbon;
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
        // $kode_bookings = 'BOOK-' . date('Ymd') . '-' . rand(1000, 9999);
        // return view('user.reservation.create', compact('kode_bookings'));
        return view('user.reservation.create');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "phone" => 'required',
            "type_room" => 'required|in:suite,deluxe,standard',
            "guest_count" => 'required|integer|min:1',
            "check_in" => 'required|date',
            "check_out" => 'required|date|after:check_in',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        // Cari room_id yang tersedia dengan type_room yang sama
        $room = Rooms::where('type_room', $request->type_room)
            ->where('status', 'tersedia')
            ->first();

        if (!$room) {
            return redirect()->back()->with('error', 'Tidak ada kamar tersedia untuk tipe ini.');
        }

        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['room_id'] = $room->id; // Set room_id otomatis dari kamar yang tersedia
        $input['check_in'] = Carbon::parse($request->check_in)->setTime(10, 0, 0)->format('Y-m-d H:i:s');
        // UNTUK PKK
        $input['check_out'] = Carbon::parse($request->check_out)->setTime(10, 0, 0)->format('Y-m-d H:i:s');

        // $input['check_out'] = Carbon::parse($request->check_out)->setTime(10, 0, 0)->format('Y-m-d H:i:s');

        // Hitung jumlah hari antara check_in dan check_out
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);

        // Pastikan check_out lebih besar dari check_in
        $days = $checkIn->diffInDays($checkOut);

        // Minimal 1 hari, jika check_out di hari yang sama, tetap hitung 1 hari
        $days = max($days, 1);

        // Ambil harga per malam dari room
        $roomPrice = $room->price ?? 0;

        // Hitung total harga
        $input['price'] = $roomPrice * $days;

        $kode_bookings = 'BOOK-' . date('Ymd') . '-' . rand(1000, 9999);
        $input['code_booking'] = $kode_bookings;
        // check_out otomatis 1 hari setelah check_in
        // UNTUK LSP
        // $input['check_out'] = Carbon::parse($input['check_in'])->addDay()->format('Y-m-d H:i:s');

        // Simpan reservasi
        Reservation::create($input);

        // Update status kamar menjadi 'terisi'
        $room->update(['status' => 'terisi']);

        return redirect()->route('userReservation.index')->with('success', 'Reservasi berhasil dibuat.');
    }

    public function edit($id)
    {
        $reservation = Reservation::find($id);
        return view('user.reservation.edit', compact('reservation'));
    }


    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            "phone" => 'required',
            "type_room" => 'required|in:suite,deluxe,standard',
            "guest_count" => 'required|integer|min:1',
            "check_in" => 'required|date',
            "check_out" => 'required|date|after:check_in',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        // Ambil reservasi yang akan diperbarui
        $reservation = Reservation::findOrFail($id);

        // Ambil room lama
        $oldRoom = Rooms::find($reservation->room_id);

        // Cek apakah type_room berubah
        $isRoomTypeChanged = $request->type_room !== $oldRoom->type_room;

        if ($isRoomTypeChanged) {
            // Set room lama menjadi tersedia kembali
            if ($oldRoom) {
                $oldRoom->update(['status' => 'tersedia']);
            }

            // Cari room_id baru berdasarkan type_room yang dipilih
            $newRoom = Rooms::where('type_room', $request->type_room)
                ->where('status', 'tersedia')
                ->first();

            if (!$newRoom) {
                return redirect()->back()->with('error', 'Tidak ada kamar tersedia untuk tipe ini.');
            }

            $room = $newRoom;
        } else {
            $room = $oldRoom;
        }

        // Hitung ulang harga dan set ulang tanggal check-in & check-out
        $checkIn = Carbon::parse($request->check_in)->setTime(10, 0, 0);
        $checkOut = Carbon::parse($request->check_out)->setTime(10, 0, 0);

        $days = max($checkIn->diffInDays($checkOut), 1);
        $roomPrice = $room->price ?? 0;
        $totalPrice = $roomPrice * $days;

        // Update data reservasi
        $reservation->update([
            'phone' => $request->phone,
            'type_room' => $request->type_room,
            'guest_count' => $request->guest_count,
            'check_in' => $checkIn->format('Y-m-d H:i:s'),
            'check_out' => $checkOut->format('Y-m-d H:i:s'),
            'room_id' => $room->id,
            'price' => $totalPrice,
        ]);

        // Set room baru menjadi 'terisi'
        $room->update(['status' => 'terisi']);

        return redirect()->route('userReservation.index')->with('success', 'Reservasi berhasil diperbarui.');
    }

    public function show($id)
    {
        $reservation = Reservation::find($id);
        return view('user.reservation.show', compact('reservation'));
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $oldRoom = Rooms::find($reservation->room_id);

        // Cek apakah type_room berubah
        // $isRoomTypeChanged = $request->type_room !== $oldRoom->type_room;

        if ($oldRoom) {
            $oldRoom->update(['status' => 'tersedia']);
        }
        // if ($oldRoom) {
        //     // Set room lama menjadi tersedia kembali
        // }
        $reservation->delete();

        return redirect()->back();
    }
}
