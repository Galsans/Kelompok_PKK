@extends('layout.dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                        <div>
                            <div class="btn-wrapper">
                                {{-- <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i>
                                    Share</a> --}}
                                {{-- <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i>
                                    Print</a> --}}
                                {{-- <a href="{{ route('rooms.create') }}" class="btn btn-primary text-white me-0"><i
                                        class="icon-download"></i>
                                    Export</a> --}}
                                <a href="{{ route('rooms.create') }}" class="btn btn-primary text-white me-0">
                                    Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Rooms Tables</h4>
                            <form method="GET" action="{{ route('rooms.index') }}">
                                <div class="row">
                                    <!-- Type Room Filter -->
                                    <div class="col-md-4">
                                        <label>Type Room</label>
                                        <select name="type_room" class="form-select">
                                            <option value="">-- Semua Type --</option>
                                            <option value="suite" {{ request('type_room') == 'suite' ? 'selected' : '' }}>
                                                Suite
                                            </option>
                                            <option value="deluxe" {{ request('type_room') == 'deluxe' ? 'selected' : '' }}>
                                                Deluxe
                                            </option>
                                            <option value="standard"
                                                {{ request('type_room') == 'standard' ? 'selected' : '' }}>
                                                Standard
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Status Filter -->
                                    <div class="col-md-4">
                                        <label>Status</label>
                                        <select name="status" class="form-select">
                                            <option value="">-- Semua Status --</option>
                                            <option value="tersedia"
                                                {{ request('status') == 'tersedia' ? 'selected' : '' }}>
                                                Tersedia</option>
                                            <option value="terisi" {{ request('status') == 'terisi' ? 'selected' : '' }}>
                                                Terisi
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary btn-lg w-75 mt-4">Filter</button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Rooms</th>
                                            <th>Type Rooms</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($rooms as $items)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $items->no_room }}</td>
                                                <td>{{ ucfirst($items->type_room) }}</td>
                                                <td> Rp. {{ number_format($items->price, 0, ',', '.') }}</td>
                                                <td>
                                                    {{-- <label class="badge badge-warning">In progress</label> --}}
                                                    @if ($items->status === 'tersedia')
                                                        <label
                                                            class="badge badge-success text-dark"><b>{{ ucfirst($items->status) }}</b></label>
                                                    @elseif ($items->status === 'tidak tersedia')
                                                        <label
                                                            class="badge badge-warning text-dark"><b>{{ ucfirst($items->status) }}</b></label>
                                                    @else
                                                        <label
                                                            class="badge badge-secondary text-dark"><b>{{ ucfirst($items->status) }}</b></label>
                                                    @endif
                                                </td>
                                                <td class="d-flex">
                                                    <a href="{{ route('rooms.show', $items->id) }}"
                                                        class="btn btn-info">Show</a>
                                                    <a href="{{ route('rooms.edit', $items->id) }}"
                                                        class="btn btn-secondary">Edit</a>
                                                    {{-- <a href="{{ route('rooms.show', $items->id) }}"
                                                        class="btn btn-danger">Remove</a> --}}
                                                    <form action="{{ route('rooms.destroy', $items->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Remove</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Data Belum Ada</td>
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
