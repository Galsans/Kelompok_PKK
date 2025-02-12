@extends('layout.dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Title -->
                    <h4 class="card-title mb-4 text-center">Reservation Details</h4>

                    <!-- Room Image -->
                    <div class="row">
                        <div class="col-12">
                            <img src="{{ Storage::url($reservation->img) }}" alt="Room Image"
                                class="img-fluid rounded shadow-sm mb-4 w-50">
                        </div>
                    </div>

                    <!-- Room Information -->
                    <div class="col-12">
                        <!-- Styling for alignment -->
                        <style>
                            .details-row {
                                display: flex;
                                align-items: center;
                                margin-bottom: 1rem;
                            }

                            .details-label {
                                width: 120px;
                                /* Adjust width for alignment */
                                font-weight: bold;
                            }

                            .details-value {
                                flex: 1;
                            }

                            .details-icon {
                                margin-right: 1rem;
                                font-size: 1.25rem;
                            }
                        </style>

                        <!-- Room Number -->
                        <div class="details-row">
                            <i class="mdi mdi-door text-primary details-icon"></i>
                            <div class="details-label">Room No</div>
                            <div class="details-value">: {{ $reservation->no_room }}</div>
                        </div>

                        <!-- Room Type -->
                        <div class="details-row">
                            <i class="mdi mdi-bed-outline text-success details-icon"></i>
                            <div class="details-label">Type</div>
                            <div class="details-value">: {{ $reservation->type_room }}</div>
                        </div>

                        <!-- Room Price -->
                        <div class="details-row">
                            <i class="mdi mdi-cash-multiple text-warning details-icon"></i>
                            <div class="details-label">Price</div>
                            <div class="details-value">: Rp. {{ number_format($reservation->price, 0, ',', '.') }}</div>
                        </div>

                        <!-- Room Status -->
                        <div class="details-row">
                            <i class="mdi mdi-check-circle-outline text-success details-icon"></i>
                            <div class="details-label">Status</div>
                            <div class="details-value">: {{ $reservation->status }}</div>
                        </div>

                        <!-- Room Facilities -->
                        <div class="details-row">
                            <i class="mdi mdi-clipboard-text-outline text-muted details-icon"></i>
                            <div class="details-label">Facilities</div>
                            <div class="details-value">
                                @php
                                    $facilities = json_decode($reservation->facilities, true);

                                @endphp
                                @if (!empty($facilities))
                                    <ul>
                                        @foreach ($facilities as $facility)
                                            <li>{{ $facility }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span>Facilities not available</span>
                                @endif

                            </div>
                        </div>
                    </div>


                    <!-- Action Buttons -->
                    <div class="mt-4 text-center">
                        {{-- <a href="/book/{{ $reservation->id }}" class="btn btn-primary btn-lg me-2">
                            <i class="mdi mdi-calendar-check me-2"></i>Book Now
                        </a> --}}
                        <a href="{{ route('reservation.index') }}" class="btn btn-secondary btn-lg">
                            <i class="mdi mdi-arrow-left me-2"></i>Back to List
                        </a>
                        <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-success btn-lg">
                            <i class="mdi mdi-pen me-2"></i>Edit List
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
