@extends('layouts.app')

@section('content')
<div class="container py-5">
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-warning text-white text-center py-4 rounded-top-4">
                <h3 class="mb-0 fw-bold">إضافة منتج جديد</h3>
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

                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold text-end" style="text-align: right;">اسم المنتج</label>
                            <input type="text" class="form-control form-control-lg rounded-3" name="name"
                                id="name" placeholder="ادخل اسم المنتج" value="{{ old('name') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="price" class="form-label fw-semibold text-end">السعر</label>
                            <input type="number" step="0.01" class="form-control form-control-lg rounded-3"
                                name="price" id="price" placeholder="ادخل السعر" value="{{ old('price') }}"
                                min="0" max="1000000">
                        </div>

                        <div class="col-md-6"
                            style="display:flex;align-items:center;gap:8px;justify-content:space-between;flex-wrap:wrap;">
                            <label for="category_id" class="form-label fw-semibold text-end"
                                style="flex:0 0 34%;text-align:right;margin-bottom:0;">التصنيف الرئيسي</label>
                            <select name="category_id" id="category_id" class="form-select form-select-lg rounded-3"
                                style="flex:1 1 64%;min-width:160px;padding:.625rem .75rem;">
                                <option value="" disabled selected>اختر التصنيف</option>
                                @foreach ($mainCategories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            <select name="subcategory_id" id="subcategory_id" class="form-select form-select-lg rounded-3"
                                >
                                <option value="" disabled selected>اختر التصنيف الفرعي (إن وجد)</option>
                                @foreach ($subCategories as $subcategory)
                                    <option value="{{ $subcategory->id }}"
                                        {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                                        {{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="quantity" class="form-label fw-semibold text-end">الكمية</label>
                            <input type="number" class="form-control form-control-lg rounded-3" name="quantity"
                                id="quantity" placeholder="ادخل الكمية" value="{{ old('quantity') }}"
                                min="0" max="500000">
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label fw-semibold text-end">صورة المنتج</label>

                            <input type="file" class="form-control form-control-lg rounded-3" name="image"
                                id="image" accept="image/*">
                            <small class="form-text text-muted">الحجم الأقصى للملف: 2 ميغابايت. الصيغ المسموح بها:
                                JPG, PNG.</small>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label fw-semibold text-end">الوصف الكامل</label>
                            <textarea name="description" id="description" class="form-control rounded-3" rows="6"
                                placeholder="ادخل وصفًا تفصيليًا للمنتج">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-warning btn-lg rounded-pill fw-bold py-3">
                            حفظ المنتج
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
