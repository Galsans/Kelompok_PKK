<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [];
        $types = ['suite', 'deluxe', 'standard'];
        // $statuses = ['tersedia', 'terisi'];

        for ($i = 1; $i <= 13; $i++) {
            $type_room = $types[array_rand($types)]; // Pilih type_room secara acak

            $facilities = match ($type_room) {
                'standard' => ['WiFi', 'TV', 'AC'],
                'deluxe' => ['WiFi', 'TV', 'AC', 'Mini Bar', 'Bath Tub'],
                'suite' => ['WiFi', 'TV', 'AC', 'Mini Bar', 'Bath Tub', 'Living Room'],
            };

            // Tentukan harga berdasarkan type_room yang dipilih
            $price = match ($type_room) {
                'standard' => 100000,
                'deluxe' => 300000,
                'suite' => 500000,
            };

            $rooms[] = [
                'no_room' => 'K-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'type_room' => $type_room,
                'facilities' => json_encode($facilities),
                'price' => $price,
                // 'status' => $statuses[array_rand($statuses)],
                'status' => 'tersedia',
                'img' => 'rooms/' . $i . '.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Masukkan semua data sekaligus untuk efisiensi
        DB::table('rooms')->insert($rooms);
    }
}
