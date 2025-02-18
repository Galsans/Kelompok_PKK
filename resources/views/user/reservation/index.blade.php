@extends('layout.dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                        <div>
                            <div class="btn-wrapper">
                                @if (!$availableRooms)
                                    <p class="text-danger">Maaf, tidak ada kamar yang tersedia untuk reservasi.</p>
                                @else
                                    <a href="{{ route('userReservation.create') }}" class="btn btn-primary text-white me-0">
                                        Create</a>
                                @endif
                                @if ($hasPendingReservations)
                                    <a href="{{ route('reservation.pdf') }}" class="btn btn-danger">
                                        <i class="mdi mdi-file-pdf-box"></i> Download PDF
                                    </a>
                                @endif

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
                                            <th>Code Reservation</th>
                                            <th>Code Room</th>
                                            <th>Type Room</th>
                                            <th>Username</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($reservation as $items)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $items->code_booking }}</td>
                                                <td>{{ optional($items->rooms)->no_room ?? 'Konfimasi pembayaran terlebih dahulu' }}
                                                </td>
                                                <td>{{ $items->type_room }}</td>
                                                <td>{{ $items->users->name }}</td>
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
                                                <td> Rp. {{ number_format($items->price, 0, ',', '.') }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ route('userReservation.show', $items->id) }}"
                                                        class="btn btn-info">Detail</a>
                                                    @if ($items->status !== 'confirm')
                                                        <a href="{{ route('userReservation.edit', $items->id) }}"
                                                            class="btn btn-secondary">Edit</a>
                                                        <form action="{{ route('userReservation.destroy', $items->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure to cancel your reservation?');">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Data Belum Ada</td>
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
    </div>
@endsection
