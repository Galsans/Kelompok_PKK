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
                            {{-- <img src="{{ Storage::url($reservation->img) }}" alt="Room Image"
                                class="img-fluid rounded shadow-sm mb-4 w-50"> --}}
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
                                width: 150px;
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

                        <!-- Kode Booking -->
                        <div class="details-row">
                            <i class="mdi mdi-ticket-confirmation text-primary details-icon"></i>
                            <div class="details-label">Kode Booking</div>
                            <div class="details-value">: {{ $reservation->code_booking }}</div>
                        </div>

                        <!-- Room Number -->
                        <div class="details-row">
                            <i class="mdi mdi-door text-primary details-icon"></i>
                            <div class="details-label">Room No</div>
                            <div class="details-value">: {{ $reservation->rooms->no_room }}</div>
                        </div>

                        <!-- Room Type -->
                        <div class="details-row">
                            <i class="mdi mdi-bed text-success details-icon"></i>
                            <div class="details-label">Type</div>
                            <div class="details-value">: {{ $reservation->rooms->type_room }}</div>
                        </div>

                        <!-- Room Price -->
                        <div class="details-row">
                            <i class="mdi mdi-cash text-warning details-icon"></i>
                            <div class="details-label">Price</div>
                            <div class="details-value">: Rp. {{ number_format($reservation->rooms->price, 0, ',', '.') }}
                            </div>
                        </div>

                        <!-- Reservation Status -->
                        <div class="details-row">
                            <i class="mdi mdi-information-outline text-info details-icon"></i>
                            <div class="details-label">Status</div>
                            <div class="details-value">: {{ $reservation->status }}</div>
                        </div>

                        @php
                            use Carbon\Carbon;
                        @endphp

                        <!-- Reservation Check In -->
                        <div class="details-row">
                            <i class="mdi mdi-calendar-check text-success details-icon"></i>
                            <div class="details-label">Check In</div>
                            <div class="details-value">:
                                {{ Carbon::parse($reservation->check_in)->translatedFormat('l, d F Y - H:i') }}</div>
                        </div>

                        <!-- Reservation Check Out-->
                        <div class="details-row">
                            <i class="mdi mdi-calendar-remove text-danger details-icon"></i>
                            <div class="details-label">Check Out</div>
                            <div class="details-value">:
                                {{ Carbon::parse($reservation->check_out)->translatedFormat('l, d F Y - H:i') }}</div>
                        </div>


                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-4 text-center">
                        <a href="{{ route('userReservation.index') }}" class="btn btn-secondary btn-lg">
                            <i class="mdi mdi-arrow-left me-2"></i>Back to List
                        </a>
                        {{-- <a href="{{ route('userReservation.edit', $reservation->id) }}" class="btn btn-success btn-lg">
                            <i class="mdi mdi-pencil me-2"></i>Edit List
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
