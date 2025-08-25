@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">{{__('messages.categories')}}</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-success">+ {{__('messages.add_category')}}</a>
    </div>

    <div class="row">
        @foreach($allCategories as $cat)
            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card h-100 shadow-sm border-0 category-card">
                    <a href="{{ route('categories.show', $cat->id) }}" class="text-decoration-none">
                        @if($cat->image)
                            <img src="{{ asset('uploads/' . $cat->image) }}" class="card-img-top rounded-top" alt="{{ $cat->name }}" style="height:200px;object-fit:cover;">
                        @else
                            <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top rounded-top" alt="no image" style="height:200px;object-fit:cover;">
                        @endif
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-2">{{ $cat->name }}</h5>
                            <p class="card-text text-muted small mb-2">{{ $cat->description }}</p>
                            @if($cat->parent)
                                <span class="badge  mb-2">{{__('messages.parent_category')}}: {{ $cat->parent->name }}</span>
                            @endif
                        </div>
                    </a>
                    <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                        <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-sm btn-outline-primary">{{__('messages.edit')}}</a>
                        <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">{{__('messages.delete')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
     <div class="row">
            <div class="col-lg-12 text-center">
                {{ $allCategories->links() }}
            </div>
        </div>
</div>
@endsection
