<?php

namespace App\Http\Middleware;

use App\Models\Rooms;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAvailableRooms
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $availableRooms = Rooms::whereNotIn('status', ['terisi', 'maintenance'])->exists();

        // Jika tidak ada kamar tersedia, redirect dengan pesan error
        if (!$availableRooms) {
            return redirect()->route('userReservation.index')->with('error', 'Maaf, tidak ada kamar yang tersedia untuk reservasi.');
        }

        return $next($request);
    }
}
