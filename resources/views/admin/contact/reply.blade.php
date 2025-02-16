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
                            <h4 class="card-title">Tanggapan</h4>
                            <form class="forms-sample" action="{{ route('contact.storeReply', $contact->id) }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="exampleInputTanggapan">Tanggapan</label>
                                    <textarea name="tanggapan" id="" class="form-control" placeholder="Enter Tanggapan" required></textarea>
                                    @error('tanggapan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary me-2">Send</button>
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
