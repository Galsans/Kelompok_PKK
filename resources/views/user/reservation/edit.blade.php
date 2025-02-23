@extends('layout.dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Reservation</h4>
                            <form class="forms-sample" action="{{ route('userReservation.update', $reservation->id) }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Type Room Select -->
                                <div class="form-group">
                                    <label for="exampleSelectTypeRoom">Type Rooms</label>
                                    <select class="form-select text-dark" id="exampleSelectTypeRoom" name="type_room"
                                        required>
                                        <option disabled>--Select Type Room--</option>
                                        <option value="standard"
                                            {{ $reservation->type_room == 'standard' ? 'selected' : '' }}>Standard</option>
                                        <option value="deluxe" {{ $reservation->type_room == 'deluxe' ? 'selected' : '' }}>
                                            Deluxe</option>
                                        <option value="suite" {{ $reservation->type_room == 'suite' ? 'selected' : '' }}>
                                            Suite</option>
                                    </select>
                                    @error('type_room')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Phone Input -->
                                <div class="form-group">
                                    <label for="exampleInputPhone">Phone</label>
                                    <input type="number" class="form-control" name="phone"
                                        value="{{ $reservation->phone }}" required>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Check In Input -->
                                <div class="form-group">
                                    <label for="exampleInputCheckIn">Check In</label>
                                    <input type="date" class="form-control" name="check_in"
                                        value="{{ old('check_in', $reservation->check_in ? \Carbon\Carbon::parse($reservation->check_in)->format('Y-m-d') : '') }}"
                                        required>
                                    @error('check_in')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Check Out Input -->
                                <div class="form-group">
                                    <label for="exampleInputCheckOut">Check Out</label>
                                    <input type="date" class="form-control" name="check_out"
                                        value="{{ old('check_out', $reservation->check_out ? \Carbon\Carbon::parse($reservation->check_out)->format('Y-m-d') : '') }}"
                                        required>
                                    @error('check_out')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Jumlah Tamu -->
                                <div class="form-group">
                                    <label for="exampleSelectJumlahTamu">Jumlah Tamu</label>
                                    <input type="number" class="form-control" name="guest_count" id="guestCountInput"
                                        min="1" value="{{ $reservation->guest_count }}" required>
                                    <small id="guestCountMessage" class="text-danger d-none"></small>
                                    @error('guest_count')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Submit Buttons -->
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="{{ route('userReservation.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>

                            <script>
                                // document.addEventListener("DOMContentLoaded", function() {
                                //     const typeRoomSelect = document.getElementById("exampleSelectTypeRoom");
                                //     const guestCountInput = document.getElementById("guestCountInput");
                                //     const guestCountMessage = document.getElementById("guestCountMessage");

                                //     function updateMaxGuest() {
                                //         let maxGuest = 0;
                                //         let message = "";

                                //         switch (typeRoomSelect.value) {
                                //             case "deluxe":
                                //                 maxGuest = 7;
                                //                 message = "Jumlah tamu maksimal untuk Deluxe adalah 7.";
                                //                 break;
                                //             case "suite":
                                //                 maxGuest = 5;
                                //                 message = "Jumlah tamu maksimal untuk Suite adalah 5.";
                                //                 break;
                                //             case "standard":
                                //                 maxGuest = 2;
                                //                 message = "Jumlah tamu maksimal untuk Standard adalah 2.";
                                //                 break;
                                //         }

                                //         guestCountInput.setAttribute("max", maxGuest);
                                //         guestCountMessage.textContent = message;
                                //         guestCountMessage.classList.remove("d-none");
                                //     }

                                //     typeRoomSelect.addEventListener("change", updateMaxGuest);
                                //     updateMaxGuest();
                                // });
                                document.addEventListener("DOMContentLoaded", function() {
                                    const typeRoomSelect = document.getElementById("exampleSelectTypeRoom");
                                    const guestCountInput = document.getElementById("guestCountInput");
                                    const guestCountMessage = document.getElementById("guestCountMessage");

                                    typeRoomSelect.addEventListener("change", function() {
                                        let maxGuest = 0;
                                        let message = "";

                                        switch (this.value) {
                                            case "suite":
                                                maxGuest = 7;
                                                message = "Jumlah tamu total hanya ada 7 untuk tipe Suite.";
                                                break;
                                            case "deluxe":
                                                maxGuest = 5;
                                                message = "Jumlah tamu total hanya ada 5 untuk tipe Deluxe.";
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
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
