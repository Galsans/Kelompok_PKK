@extends('layout.dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="card">
                        <div class="card-body">
                            <h3>Dashboard</h3>
                            @if (Auth::user()->role === 'admin')
                                <div class="row">
                                    <!-- User Count Card -->
                                    <div class="col-md-4">
                                        <div class="card text-white bg-primary mb-3">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="card-title">Total Users</h5>
                                                    <h2>{{ $userCount }}</h2>
                                                </div>
                                                <i class="mdi mdi-account-group mdi-36px"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Room Count Card -->
                                    <div class="col-md-4">
                                        <div class="card text-white bg-success mb-3">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="card-title">Total Rooms</h5>
                                                    <h2>{{ $roomCount }}</h2>
                                                </div>
                                                <i class="mdi mdi-door-closed mdi-36px"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Reservation Count Card -->
                                    <div class="col-md-4">
                                        <div class="card text-white bg-warning mb-3">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="card-title">Total Reservations</h5>
                                                    <h2>{{ $reservationCount }}</h2>
                                                </div>
                                                <i class="mdi mdi-calendar-check mdi-36px"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Room Available Count Card -->
                                    <div class="col-md-4">
                                        <div class="card text-white bg-warning mb-3">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="card-title">Total Rooms Available</h5>
                                                    <h2>{{ $roomAvailable }}</h2>
                                                </div>
                                                <i class="mdi mdi-door-open mdi-36px"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif (Auth::user()->role === 'user')
                                <div class="row">
                                    <!-- Room Count Card -->
                                    <div class="col-md-4">
                                        <div class="card text-white bg-success mb-3">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="card-title">Total Rooms Yang Tersedia</h5>
                                                    <h2>{{ $roomAvailable }}</h2>
                                                </div>
                                                <i class="mdi mdi-door-open mdi-36px"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Reservation Count Card -->
                                    <div class="col-md-4">
                                        <div class="card text-white bg-warning mb-3">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="card-title">Your Reservations</h5>
                                                    <h2>{{ $reservUser }}</h2>
                                                </div>
                                                <i class="mdi mdi-calendar-check mdi-36px"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
