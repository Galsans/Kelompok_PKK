<?php

namespace Database\Seeders;

use App\Models\Rooms;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [];
        $types = ['suite', 'deluxe', 'standard'];
        $statuses = ['tersedia', 'terisi'];

        for ($i = 1; $i <= 20; $i++) {
            $rooms[] = [
                'no_room' => 'K-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'type_room' => $types[array_rand($types)],
                'facilities' => json_encode(['Wi-Fi', 'TV', 'AC']),
                'price' => rand(500000, 2000000),
                'status' => $statuses[array_rand($statuses)],
                'img' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // DB::table('rooms')->insert($rooms);
        foreach ($rooms as $room) {
            Rooms::create($room);
        }
    }
}
