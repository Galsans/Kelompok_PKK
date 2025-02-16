@extends('layout.dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <h2>Table Contact Us</h2>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.contact') }}" class="mb-4">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari berdasarkan Email atau Subject..."
                                        value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="menu-icon mdi mdi-magnify"></i> Search
                                    </button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('admin.contact') }}" class="btn btn-secondary w-100">
                                        <i class="fas fa-sync-alt"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Subject</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($searching as $items)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $items->subject }}</td>
                                        <td>{{ $items->user->email }}</td>
                                        <td>{{ $items->message }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('contact.reply', $items->id) }}"
                                                class="btn btn-info">Reply</a>
                                            {{-- <form action="{{ route('rooms.destroy', $items->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Data Belum Ada</td>
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
