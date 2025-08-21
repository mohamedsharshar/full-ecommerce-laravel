@extends('layouts.app')

@section('content')
    <!-- Product Form Section -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-warning text-white text-center py-4 rounded-top-4">
                        <h3 class="mb-0 fw-bold">Add New Review</h3>
                    </div>
                    <div class="card-body p-5">
                        {{-- Success Message Alert --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Error Messages --}}
                        @if ($errors->any())
                            <div class="alert alert-danger mb-4 rounded-3">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('reviews.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <!-- user_name -->
                                <div class="col-12 ">
                                    <label for="user_name" class="form-label fw-semibold">Review Name</label>
                                    <input type="text" class="form-control form-control-lg rounded-3" name="user_name"
                                        id="user_name" placeholder="Enter Review Name" value="{{ old('user_name') }}">
                                </div>
                                <!-- rating -->
                                <div class="col-12 ">
                                    <label for="name" class="form-label fw-semibold">Rate Us</label>
                                    <input type="number" class="form-control form-control-lg rounded-3" min="1" max="5" name="rating"
                                        id="rating" placeholder="Enter Rating" value="{{ old('rating') }}">
                                </div>
                                <!-- Review Image -->
                                <div class="col-md-6 w-100">
                                    <label for="image" class="form-label fw-semibold">Review Image</label>
                                    <input type="file" class="form-control form-control-lg rounded-3" name="image"
                                        id="image" accept="image/*">
                                    <small class="form-text text-muted">Max file size: 2MB. Allowed types: JPG, PNG.</small>
                                </div>
                                <!-- comment -->
                                <div class="col-12">
                                    <label for="comment" class="form-label fw-semibold">Comment</label>
                                    <textarea name="comment" id="comment" class="form-control rounded-3" rows="6"
                                        placeholder="Enter your comment">{{ old('comment') }}</textarea>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-warning btn-lg rounded-pill fw-bold py-3">
                                    Save Review
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="testimonail-section mt-80 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-center">
                    <div class="testimonial-sliders owl-carousel owl-theme">
                        @foreach ($reviews as $review)
                            <div class="single-testimonial-slider">
                                <div class="client-avater">
                                    <img src="{{ asset($review->image) }}" alt="{{ $review->user_name }}">
                                </div>
                                <div class="client-meta">
                                    <h3>{{ $review->user_name }} <span>Rating: {{ $review->rating }}/5</span></h3>
                                    <p class="testimonial-body">
                                        " {{ $review->comment }} "
                                    </p>
                                    <div class="last-icon">
                                        <i class="fas fa-quote-right"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
