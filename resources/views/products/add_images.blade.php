@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="mb-4 text-center">{{ __('messages.add_product_images') }}<br><small class="text-muted">{{ $product->name }}</small></h4>
                    <form action="{{ route('productimages.store', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="images" class="form-label fw-bold">{{ __('messages.choose_images') }}</label>
                            <input type="file" name="images[]" id="images" class="form-control @error('images.*') is-invalid @enderror" multiple required accept="image/*">
                            <div class="form-text">{{ __('messages.image_upload_info') }}</div>
                            @error('images.*')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary"> <i class="fas fa-upload"></i> {{ __('messages.upload') }}</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> {{ __('messages.back_to_product') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
