@extends('layout.dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <h2>Konfirmasi Reservations</h2>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('reservation.index') }}" class="mb-4">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari berdasarkan Email atau Kode Booking..."
                                        value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="menu-icon mdi mdi-magnify"></i> Search
                                    </button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('reservation.index') }}" class="btn btn-secondary w-100">
                                        <i class="fas fa-sync-alt"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Code Booking</th>
                                    <th>No Kamar</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Type Room</th>
                                    <th>Status</th>
                                    {{-- <th>Pilih Kamar</th> --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reservations as $booking)
                                    <tr>
                                        <td>{{ $booking->code_booking }}</td>
                                        <td>{{ $booking->rooms->no_room }}</td>
                                        <td>{{ $booking->users->name }}</td>
                                        <td>{{ $booking->users->email }}</td>
                                        <td>{{ $booking->type_room }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $booking->status == 'pending'
                                                    ? 'warning'
                                                    : ($booking->status == 'cancel'
                                                        ? 'danger'
                                                        : ($booking->status == 'maintenance'
                                                            ? 'info'
                                                            : 'success')) }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>

                                        </td>
                                        <td class="d-flex gap-2">
                                            <a href="{{ route('reservation.show', $booking->id) }}"
                                                class="btn btn-info btn-sm">Detail</a>
                                            @if ($booking->status == 'pending')
                                                <form action="{{ route('reservation.confirm', $booking->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure to confirm this booking?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="btn btn-success btn-sm">Konfirmasi</button>
                                                </form>
                                            @elseif ($booking->status === 'confirm')
                                                <form action="{{ route('reservation.checkout', $booking->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure to check-out this booking?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-primary btn-sm">Check Out</button>
                                                </form>
                                                {{-- <a href="{{ route('reservation.checkout', $booking->id) }}"
                                                    class="">Check Out</a> --}}
                                            @else
                                                <span class="btn btn-sm btn-success disabled">Sudah
                                                    Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">Data Tidak Ada</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- <div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <div>
                        <div class="btn-wrapper">
                            <a href="{{ route('reservation.create2') }}" class="btn btn-primary text-white me-0">
                                Create</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Reservation Tables</h4>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Code Room</th>
                                        <th>Username</th>
                                        <th>Code Reservation</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reservation as $items)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ optional($items->rooms)->no_room ?? 'room belum di set oleh admin' }}
                                            </td>
                                            <td>{{ $items->users->name }}</td>
                                            <td>{{ $items->code_booking }}</td>
                                            <td>
                                                @if ($items->status === 'pending')
                                                    <label
                                                        class="badge badge-warning text-dark"><b>{{ $items->status }}</b></label>
                                                @elseif ($items->status === 'confirm')
                                                    <label
                                                        class="badge badge-primary text-dark"><b>{{ $items->status }}</b></label>
                                                @else
                                                    <label
                                                        class="badge badge-success text-dark"><b>{{ $items->status }}</b></label>
                                                @endif
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ route('reservation.show', $items->id) }}"
                                                    class="btn btn-info">Show</a>
                                                <a href="{{ route('reservation.edit', $items->id) }}"
                                                    class="btn btn-secondary">Edit</a>
                                                <form action="{{ route('reservation.destroy', $items->id) }}"
                                                    method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Data Belum Ada</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
