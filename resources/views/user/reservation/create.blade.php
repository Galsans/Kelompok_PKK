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
                            <h4 class="card-title">Create Reservation</h4>
                            <form class="forms-sample" action="{{ route('userReservation.store') }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                <!-- Type Room Select -->
                                {{-- <div class="form-group">
                                    <label for="exampleSelectTypeRoom">Code Booking</label>
                                    <input type="text" class="form-control" value="{{ $kode_bookings }}"
                                        name="code_booking">
                                    @error('code_booking')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> --}}

                                <div class="form-group">
                                    <label for="exampleSelectTypeRoom">Type Rooms</label>
                                    <select class="form-select text-dark" id="exampleSelectTypeRoom" name="type_room"
                                        required>
                                        <option selected disabled>--Select Type Room--</option>
                                        <option value="standard">Standard</option>
                                        <option value="suite">Suite</option>
                                        <option value="deluxe">Deluxe</option>
                                    </select>
                                    @error('type_room')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Phone Input -->
                                <div class="form-group">
                                    <label for="exampleInputPhone">Phone</label>
                                    <input type="number" class="form-control" name="phone">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Check In Input -->
                                <div class="form-group">
                                    <label for="exampleInputPhone">Check In</label>
                                    <input type="date" class="form-control" name="check_in">
                                    @error('check_in')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Check Out Input -->
                                <div class="form-group">
                                    <label for="exampleInputPhone">Check Out</label>
                                    <input type="date" class="form-control" name="check_out">
                                    @error('check_out')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Jumlah -->
                                <div class="form-group">
                                    <label for="exampleSelectJumlahTamu">Jumlah Tamu</label>
                                    <input type="number" class="form-control" name="guest_count" id="guestCountInput"
                                        min="1">
                                    <small id="guestCountMessage" class="text-danger d-none"></small>
                                    @error('guest_count')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Submit Buttons -->
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <button type="reset" class="btn btn-light">Cancel</button>
                            </form>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const typeRoomSelect = document.getElementById("exampleSelectTypeRoom");
                                    const guestCountInput = document.getElementById("guestCountInput");
                                    const guestCountMessage = document.getElementById("guestCountMessage");

                                    typeRoomSelect.addEventListener("change", function() {
                                        let maxGuest = 0;
                                        let message = "";

                                        switch (this.value) {
                                            case "deluxe":
                                                maxGuest = 7;
                                                message = "Jumlah tamu total hanya ada 7 untuk tipe Deluxe.";
                                                break;
                                            case "suite":
                                                maxGuest = 5;
                                                message = "Jumlah tamu total hanya ada 5 untuk tipe Suite.";
                                                break;
                                            case "standard":
                                                maxGuest = 2;
                                                message = "Jumlah tamu total hanya ada 2 untuk tipe Standard.";
                                                break;
                                            default:
                                                maxGuest = 0;
                                                message = "";
                                        }

                                        if (maxGuest > 0) {
                                            guestCountInput.setAttribute("max", maxGuest);
                                            guestCountMessage.textContent = message;
                                            guestCountMessage.classList.remove("d-none");
                                        } else {
                                            guestCountInput.removeAttribute("max");
                                            guestCountMessage.classList.add("d-none");
                                        }
                                    });
                                });

                                // document.addEventListener('DOMContentLoaded', function() {
                                //     const typeRoomSelect = document.getElementById('exampleSelectTypeRoom');
                                //     const facilitiesTextarea = document.getElementById('exampleInputFacilities');

                                //     // Mapping type_room to facilities
                                //     const facilitiesMap = {
                                //         suite: 'TV, WiFi, Pool',
                                //         deluxe: 'TV, WiFi',
                                //         standard: 'WiFi'
                                //     };

                                //     // Update textarea when type_room changes
                                //     typeRoomSelect.addEventListener('change', function() {
                                //         const selectedType = this.value;
                                //         facilitiesTextarea.value = facilitiesMap[selectedType] ||
                                //             ''; // Set value based on the selected type_room
                                //     });
                                // });
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
