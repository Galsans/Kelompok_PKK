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
            'facilities' => ['required', 'string'],
            'type_room' => ['required', 'string', 'in:suite,deluxe,standard'],
            'status' => ['required', 'string', 'in:tersedia,terisi'],
            'img' => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        $validatedData = $validate->validated();
        $facilitiesArray = explode(',', $validatedData['facilities']);
        $itemCount = Rooms::count() + 1;
        $sequenceNumber = str_pad($itemCount, 3, '0', STR_PAD_LEFT);

        // Tentukan harga berdasarkan type_room
        $price = match ($validatedData['type_room']) {
            'standard' => 100000,
            'deluxe' => 300000,
            'suite' => 500000,
        };

        // Simpan gambar dengan path yang aman
        $imagePath = $request->file('img')->store('rooms', 'public');

        // Masukkan data ke dalam array sebelum dikirim ke database
        $roomData = [
            'facilities' => json_encode($facilitiesArray),
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
    public function update(Request $request, Rooms $rooms, $id)
    {
        $validate = Validator::make($request->all(), [
            "facilities" => 'required',
            "type_room" => 'required',
            "price" => 'required',
            "status" => 'required',
            'img' => ['image', 'mimes:jpg,jpeg,png'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        // $input = $request->all();
        $rooms = Rooms::find($id);
        $facilitiesArray = explode(',', $request->facilities);
        // Tentukan harga berdasarkan type_room
        $price = match ($validate['type_room']) {
            'standard' => 100000,
            'deluxe' => 300000,
            'suite' => 500000,
        };

        $rooms->type_room = $request->input('type_room');
        $rooms->price = $request->input('price');
        $rooms->status = $request->input('status');
        $rooms->facilities = json_encode($facilitiesArray);
        $rooms->price = $price;

        // Proses file upload jika ada
        if ($request->hasFile('img')) {
            // Delete the old image if exists
            if ($rooms->img) {
                Storage::delete($rooms->img);
            }
            // Store the new image
            $rooms->img = $request->file('img')->store('public/rooms');
        }

        // Update data room
        $rooms->save();


        return redirect()->route('rooms.index')->with('success', 'Berhasil Menyimpan Data');
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

    public function landing()
    {
        $room = Rooms::all();
        return view('landing', compact('room'));
    }
}
