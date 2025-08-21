@extends('layouts.app')

@section('content')
    <!-- Product Form Section -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-warning text-white text-center py-4 rounded-top-4">
                        <h3 class="mb-0 fw-bold">Add New Product</h3>
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

                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                <!-- Product Name -->
                                <div class="col-12 ">
                                    <label for="name" class="form-label fw-semibold">Product Name</label>
                                    <input type="text" class="form-control form-control-lg rounded-3" name="name" id="name"
                                        placeholder="Enter product name" value="{{ old('name') }}" >
                                </div>

                                <!-- Product Price -->
                                <div class="col-12">
                                    <label for="price" class="form-label fw-semibold">Price</label>
                                    <input type="number" step="0.01" class="form-control form-control-lg rounded-3" name="price"
                                        id="price" placeholder="Enter price" value="{{ old('price') }}" >
                                </div>

                                <!-- Category -->
                                <div class="col-12">
                                    <label for="category_id" class="form-label fw-semibold">Category</label>
                                    <select name="category_id" id="category_id" class="form-select form-select-lg rounded-3" >
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach ($mainCategories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Sub Category --}}
                                <div class="col-12">
                                    <label for="parent_id" class="form-label fw-semibold">Sub Category</label>
                                    <select name="parent_id" id="parent_id" class="form-select form-select-lg rounded-3" >
                                        <option value="" disabled selected>Select Sub Category</option>
                                        @foreach ($subCategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ old('parent_id') == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Product Quantity -->
                                <div class="col-md-6">
                                    <label for="quantity" class="form-label fw-semibold">Quantity</label>
                                    <input type="number" class="form-control form-control-lg rounded-3" name="quantity" id="quantity"
                                        placeholder="Enter quantity" value="{{ old('quantity') }}" >
                                </div>

                                <!-- Product Image -->
                                <div class="col-md-6">
                                    <label for="image" class="form-label fw-semibold">Product Image</label>

                                    <input type="file" class="form-control form-control-lg rounded-3" name="image" id="image"
                                        accept="image/*">
                                    <small class="form-text text-muted">Max file size: 2MB. Allowed types: JPG, PNG.</small>
                                </div>

                                <!-- Full Description -->
                                <div class="col-12">
                                    <label for="description" class="form-label fw-semibold">Full Description</label>
                                    <textarea name="description" id="description" class="form-control rounded-3" rows="6"
                                        placeholder="Enter detailed description">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-warning btn-lg rounded-pill fw-bold py-3">
                                    Save Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
