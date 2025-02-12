<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'fasilities' => 'array'
    ];


    /**
     * Get all of the reservation for the Rooms
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}
