<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Reservation;
use App\Models\Rooms;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // ADMIN
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        // USER
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Rooms::create([
        //     "no_room" => 'K-127',
        //     "facilities" => 'K-127',
        //     "type_room" => 'K-127',
        //     "price" => 'K-127',
        //     "status" => 'K-127',
        //     "img" => 'K-127',
        // ]);

        // ROOMS
        $this->call(RoomSeeder::class);

        // Reservation::create([
        //     'user_id' => 2,
        //     'room_id' => null,
        //     'code_booking' => "BOOK-20250211-5359",
        //     'phone' => '076183882772',
        //     'type_room' => 'suite',
        //     'guest_count' => '2',
        // ]);

        // Reservation::create([
        //     'user_id' => 3,
        //     'room_id' => null,
        //     'code_booking' => 1234567822,
        //     'type_room' => 'deluxe',
        //     'phone' => '076183882711',
        //     'guest_count' => '3',
        // ]);
    }
}
