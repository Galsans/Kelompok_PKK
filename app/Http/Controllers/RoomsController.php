<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $typeRoom = $request->input('type_room');
        $status = $request->input('status');

        // Query data reservasi dengan filter jika tersedia
        $rooms = DB::table('rooms')
            ->when($typeRoom, function ($query) use ($typeRoom) {
                return $query->where('type_room', $typeRoom);
            })
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc') // Sort default by latest
            ->get();

        // $rooms = Rooms::whereIn('type_room', ['suite', 'deluxe', 'standard'])
        //     ->whereIn('status', ['terisi', 'tersedia'])
        //     ->orderByRaw("FIELD(type_room, 'suite', 'deluxe', 'standard')")
        //     ->orderByRaw("FIELD(status, 'tersedia', 'terisi')")
        //     ->get();

        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'type_room' => ['required', 'string', 'in:suite,deluxe,standard'],
            'status' => ['required', 'string', 'in:tersedia,terisi,maintenance'],
            'img' => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        $validatedData = $validate->validated();
        $itemCount = Rooms::count() + 1;
        $sequenceNumber = str_pad($itemCount, 3, '0', STR_PAD_LEFT);

        // Tentukan harga berdasarkan type_room
        $price = match ($validatedData['type_room']) {
            'standard' => 100000,
            'deluxe' => 300000,
            'suite' => 500000,
        };

        // Tentukan fasilitas berdasarkan type_room
        $facilities = match ($validatedData['type_room']) {
            'standard' => ['WiFi', 'TV', 'AC'],
            'deluxe' => ['WiFi', 'TV', 'AC', 'Mini Bar', 'Bath Tub'],
            'suite' => ['WiFi', 'TV', 'AC', 'Mini Bar', 'Bath Tub', 'Living Room'],
        };

        // Simpan gambar dengan path yang aman
        $imagePath = $request->file('img')->store('rooms', 'public');

        // Masukkan data ke dalam array sebelum dikirim ke database
        $roomData = [
            'facilities' => json_encode($facilities), // Simpan dalam format JSON
            'type_room' => $validatedData['type_room'],
            'status' => $validatedData['status'],
            'price' => $price,
            'img' => $imagePath,
            'no_room' => 'K-' . $sequenceNumber,
        ];

        Rooms::create($roomData);

        return redirect()->route('rooms.index')->with('success', 'Berhasil Menyimpan Data');
    }


    /**
     * Display the specified resource.
     */
    public function show(Rooms $rooms, $id)
    {
        $rooms = Rooms::find($id);
        return view('admin.rooms.show', compact('rooms'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rooms $rooms, $id)
    {
        $rooms = Rooms::find($id);
        return view('admin.rooms.edit', compact('rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            // "facilities" => 'nullable|string|max:255',
            "type_room" => 'in:standard,suite,deluxe',
            // "price" => 'integer',
            "status" => 'in:tersedia,tidak tersedia,maintenance',
            'img' => ['image', 'mimes:jpg,jpeg,png'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        // Cari room berdasarkan ID
        $rooms = Rooms::findOrFail($id);

        // Tentukan fasilitas default berdasarkan type_room
        $defaultFacilities = match ($request->input('type_room')) {
            'standard' => ['WiFi', 'TV', 'AC'],
            'deluxe' => ['WiFi', 'TV', 'AC', 'Mini Bar', 'Bath Tub'],
            'suite' => ['WiFi', 'TV', 'AC', 'Mini Bar', 'Bath Tub', 'Living Room'],
            // default => json_decode($rooms->facilities, true) // Gunakan fasilitas lama jika tidak ada perubahan
        };

        // Ambil fasilitas dari input, jika tidak ada gunakan default
        $facilitiesArray = $request->filled('facilities') ? explode(',', $request->input('facilities')) : $defaultFacilities;

        // Tentukan harga berdasarkan type_room
        $price = match ($request->input('type_room')) {
            'standard' => 100000,
            'deluxe' => 300000,
            'suite' => 500000,
            // default => $rooms->price, // Gunakan harga lama jika tidak ada perubahan
        };

        // Update data
        $rooms->type_room = $request->input('type_room', $rooms->type_room);
        $rooms->price = $price;
        $rooms->status = $request->input('status', $rooms->status);
        $rooms->facilities = json_encode($facilitiesArray);

        // Proses file upload jika ada
        if ($request->hasFile('img')) {
            // Hapus gambar lama jika ada
            if ($rooms->img) {
                Storage::delete($rooms->img);
            }
            // Simpan gambar baru
            $rooms->img = $request->file('img')->store('public/rooms');
        }

        // Simpan perubahan
        $rooms->save();

        return redirect()->route('rooms.index')->with('success', 'Berhasil Memperbarui Data');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rooms $rooms, $id)
    {
        $rooms = Rooms::find($id);
        if ($rooms->img) {
            Storage::delete($rooms->img);
        }
        $rooms->delete();
        return redirect()->route('rooms.index')->with('success', 'Berhasil Menghapus Data');
    }
}
