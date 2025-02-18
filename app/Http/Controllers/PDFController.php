<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function save()
    {
        $user_id = Auth::id();

        $reservations = Reservation::where('user_id', $user_id)->where('status', 'pending')->get();

        // $total = $reservations->price * $reservations->count();
        $total = $reservations->sum('price'); // ✅ Langsung jumlahkan harga dari reservations


        $pdf = Pdf::loadView('pdf.reservation', compact('reservations', 'total'));


        // Unduh atau tampilkan PDF
        return $pdf->download('reservationDownload.pdf');
    }
}
