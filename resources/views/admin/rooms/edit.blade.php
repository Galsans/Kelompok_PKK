@extends('layout.dashboard')
@section('content')
    {{-- <link rel="stylesheet" href="{{ asset('dist/assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}"> --}}
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
                                {{-- <a href="{{ route('rooms.create') }}" class="btn btn-primary text-white me-0">
                                    Create</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Rooms</h4>
                            <form class="forms-sample" action="{{ route('rooms.update', $rooms->id) }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInputFacilities">Facilities</label>
                                    <textarea name="facilities" id="" class="form-control"
                                        placeholder="Enter facilities separated by commas (e.g., wifi,pool,parking)" required>{{ implode(',', json_decode($rooms->facilities, true) ?? []) }}</textarea>
                                    @error('facilities')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPrice">Price</label>
                                    <input type="number" class="form-control" id="exampleInputPrice" name="price"
                                        placeholder="Price" value="{{ $rooms->price }}" required>
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectTypeRoom">Type Rooms</label>
                                    <select class="form-select text-dark" id="exampleSelectTypeRoom" name="type_room"
                                        required>
                                        <option disabled>--Select Type Room--</option>
                                        <option value="suite"
                                            {{ old('type_room', $rooms->type_room) == 'suite' ? 'selected' : '' }}>Suite
                                        </option>
                                        <option value="deluxe"
                                            {{ old('type_room', $rooms->type_room) == 'deluxe' ? 'selected' : '' }}>Deluxe
                                        </option>
                                        <option value="standard"
                                            {{ old('type_room', $rooms->type_room) == 'standard' ? 'selected' : '' }}>
                                            Standard</option>
                                    </select>
                                    @error('type_room')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectStatus">Status</label>
                                    <select class="form-select text-dark" id="exampleSelectStatus" name="status" required>
                                        <option disabled>--Select Status--</option>
                                        <option value="tersedia"
                                            {{ old('status', $rooms->status) == 'tersedia' ? 'selected' : '' }}>Tersedia
                                        </option>
                                        <option value="terisi"
                                            {{ old('status', $rooms->status) == 'terisi' ? 'selected' : '' }}>Terisi
                                        </option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <img src="{{ Storage::url($rooms->img) }}" class="rounded w-50 mb-3" alt="">
                                    <br>
                                    <label>File upload</label>
                                    <input type="file" name="img" class="file-upload">
                                    @error('img')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <button type="reset" class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="{{ asset('dist/assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('dist/assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('dist/assets/js/select2.js') }}"></script> --}}
    <!-- Plugin js for this page -->

    <script src="{{ asset('dash/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dash/assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page -->
    <script src="{{ asset('dash/assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('dash/assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('dash/assets/js/select2.js') }}"></script>
@endsection
