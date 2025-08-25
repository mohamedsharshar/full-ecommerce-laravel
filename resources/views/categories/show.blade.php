@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                @if($category->image)
                    <img src="{{ asset('uploads/' . $category->image) }}" class="card-img-top rounded-top" alt="{{ $category->name }}" style="height:250px;object-fit:cover;">
                @else
                    <img src="https://via.placeholder.com/400x250?text=No+Image" class="card-img-top rounded-top" alt="no image" style="height:250px;object-fit:cover;">
                @endif
                <div class="card-body text-center">
                    <h2 class="card-title fw-bold mb-3">{{ $category->name }}</h2>
                    <p class="card-text text-muted mb-3">{{ $category->description }}</p>
                    <h5 class="mb-2">{{__('messages.sub_category_of')}}</h5>
                    @if($category->parent)
                        <span class="badge bg-info">{{ $category->parent->name }}</span>
                    @else
                        <span class="badge bg-secondary">{{__('messages.no_parent')}}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
