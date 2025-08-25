@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                    <h3 class="mb-0 fw-bold">{{ __('messages.edit_product') }}</h3>
                </div>
                <div class="card-body p-5">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4 rounded-3">
                            <ul class="mb-0 pe-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold text-end">{{ __('messages.name') }}</label>
                                <input type="text" name="name" class="form-control form-control-lg rounded-3" value="{{ old('name', $product->name) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-semibold text-end">{{ __('messages.price') }}</label>
                                <input type="number" name="price" class="form-control form-control-lg rounded-3" value="{{ old('price', $product->price) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="quantity" class="form-label fw-semibold text-end">{{ __('messages.quantity') }}</label>
                                <input type="number" name="quantity" class="form-control form-control-lg rounded-3" value="{{ old('quantity', $product->quantity) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="category_id" class="form-label fw-semibold text-end">{{ __('messages.category') }}</label>
                                <select name="category_id" id="category_id" class="form-select form-select-lg rounded-3 border-primary shadow-sm" style="background-color:#f9fafb;">
                                    @foreach($categories as $category)
                                        @if(is_null($category->parent_id))
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="subcategory_id" class="form-label fw-semibold text-end">{{ __('messages.sub_category') }}</label>
                                <select name="subcategory_id" id="subcategory_id" class="form-select form-select-lg rounded-3 border-primary shadow-sm" style="background-color:#f9fafb;">
                                    <option value="" disabled selected>{{ __('messages.choose_subcategory') }}</option>
                                    @foreach($categories as $subcategory)
                                        @if(!is_null($subcategory->parent_id))
                                            <option value="{{ $subcategory->id }}" {{ (isset($product->subcategory_id) && $product->subcategory_id == $subcategory->id) ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label fw-semibold text-end">{{ __('messages.full_description') }}</label>
                                <textarea name="description" class="form-control rounded-3">{{ old('description', $product->description) }}</textarea>
                            </div>
                            <div class="col-12">
                                <label for="image" class="form-label fw-semibold text-end">{{ __('messages.product_image') }}</label><br>
                                @if($product->image)
                                    <img src="{{ asset('uploads/' . ltrim($product->image, '/')) }}"  alt="{{__('messages.current_image_product')}}" width="100" class="mb-2 rounded-3"><br>
                                @endif
                                <input type="file" name="image" class="form-control form-control-lg rounded-3" accept="image/*">
                            </div>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold py-3">{{ __('messages.edit_product') }}</button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg rounded-pill fw-bold py-3 mt-2">{{ __('messages.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
