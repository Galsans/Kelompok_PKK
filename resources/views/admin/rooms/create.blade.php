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
                            <h4 class="card-title">Create Rooms</h4>
                            <form class="forms-sample" action="{{ route('rooms.store') }}" enctype="multipart/form-data"
                                method="POST">
                                @csrf
                                <!-- Type Room Select -->
                                <div class="form-group">
                                    <label for="exampleSelectTypeRoom">Type Rooms</label>
                                    <select class="form-select text-dark" id="exampleSelectTypeRoom" name="type_room"
                                        required>
                                        <option selected disabled>--Select Type Room--</option>
                                        <option value="suite">Suite</option>
                                        <option value="deluxe">Deluxe</option>
                                        <option value="standard">Standard</option>
                                    </select>
                                    @error('type_room')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Facilities Textarea -->
                                <div class="form-group">
                                    <label for="exampleInputFacilities">Facilities</label>
                                    <textarea name="facilities" id="exampleInputFacilities" class="form-control"
                                        placeholder="Enter facilities separated by commas (e.g., wifi,pool,parking)" required readonly></textarea>
                                    @error('facilities')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Price Input -->
                                {{-- <div class="form-group">
                                    <label for="exampleInputPrice">Price</label>
                                    <input type="number" class="form-control" id="exampleInputPrice" name="price"
                                        placeholder="Price" required>
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> --}}

                                <!-- Status Select -->
                                <div class="form-group">
                                    <label for="exampleSelectStatus">Status</label>
                                    <select class="form-select text-dark" id="exampleSelectStatus" name="status" required>
                                        <option selected disabled>--Select Status--</option>
                                        <option value="tersedia">Tersedia</option>
                                        <option value="terisi">Terisi</option>
                                        <option value="maintenance">Maintenance</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- File Upload -->
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="img" class="file-upload" required>
                                    @error('img')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Submit Buttons -->
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <button type="reset" class="btn btn-light">Cancel</button>
                            </form>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const typeRoomSelect = document.getElementById('exampleSelectTypeRoom');
                                    const facilitiesTextarea = document.getElementById('exampleInputFacilities');

                                    // Mapping type_room to facilities
                                    const facilitiesMap = {
                                        suite: 'TV, WiFi, Pool',
                                        deluxe: 'TV, WiFi',
                                        standard: 'WiFi'
                                    };

                                    // Update textarea when type_room changes
                                    typeRoomSelect.addEventListener('change', function() {
                                        const selectedType = this.value;
                                        facilitiesTextarea.value = facilitiesMap[selectedType] ||
                                            ''; // Set value based on the selected type_room
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Plugin js for this page -->

    <script src="{{ asset('dash/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dash/assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page -->
    <script src="{{ asset('dash/assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('dash/assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('dash/assets/js/select2.js') }}"></script>
@endsection
