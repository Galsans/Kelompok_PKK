@extends('layout.dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Title -->
                    <h4 class="card-title mb-4 text-center">Your Comment Details</h4>

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

                        <!-- Subject -->
                        <div class="details-row">
                            <i class="mdi mdi-comment-text-outline text-primary details-icon"></i>
                            <div class="details-label">Subject</div>
                            <div class="details-value">: {{ $contact->subject }}</div>
                        </div>

                        <!-- Message -->
                        <div class="details-row">
                            <i class="mdi mdi-message-text text-warning details-icon"></i>
                            <div class="details-label">Message</div>
                            <div class="details-value">: {{ $contact->message }}</div>
                        </div>

                        <!-- Tanggapan -->
                        <div class="details-row">
                            <i class="mdi mdi-reply text-success details-icon"></i>
                            <div class="details-label">Tanggapan</div>
                            <div class="details-value">: {{ $contact->tanggapan }}</div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-4 text-center">
                        <a href="{{ route('user.contact') }}" class="btn btn-secondary btn-lg">
                            <i class="mdi mdi-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
