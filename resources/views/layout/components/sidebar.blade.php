<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        @if (Auth::user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('rooms.index') }}">
                    <i class="menu-icon mdi mdi-bed"></i>
                    <span class="menu-title">Rooms</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('reservation.index') }}">
                    <i class="menu-icon mdi mdi-calendar-range"></i>
                    <span class="menu-title">Reservation</span>
                </a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('userReservation.index') }}">
                    <i class="menu-icon mdi mdi-calendar-range"></i>
                    <span class="menu-title">Reservation</span>
                </a>
            </li>
        @endif

        {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="menu-icon mdi mdi-layers-outline"></i>
                <span class="menu-title">Icons</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/icons/font-awesome.html">Font
                            Awesome</a></li>
                </ul>
            </div>
        </li> --}}
    </ul>
</nav>
