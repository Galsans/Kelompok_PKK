<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Pending</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Konfirmasi Reservation</h2>
    <p><strong>User:</strong> {{ auth()->user()->name }}</p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Reservation</th>
                <th>Name</th>
                <th>Tanggal Check In</th>
                <th>Tanggal Check Out</th>
                <th>Jumlah Orang</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->code_booking }}</td>
                    <td>{{ $reservation->users->name }}</td>
                    <td>{{ $reservation->check_in }}</td>
                    <td>{{ $reservation->check_out }}</td>
                    <td>{{ $reservation->guest_count }}</td>
                    <td>{{ $reservation->price }}</td>
                    <td>{{ ucfirst($reservation->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h4>Total Harga: Rp {{ number_format($total, 0, ',', '.') }}</h4>
</body>

</html>
