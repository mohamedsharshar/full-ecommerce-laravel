@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">جميع الأقسام</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-success">+ إضافة قسم</a>
    </div>

    <div class="row">
        @foreach($allCategories as $cat)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($cat->image)
                        <img src="{{ asset('uploads/' . $cat->image) }}" class="card-img-top" alt="{{ $cat->name }}" style="height:180px;object-fit:cover;">
                    @else
                        <img src="https://via.placeholder.com/300x180?text=No+Image" class="card-img-top" alt="no image" style="height:180px;object-fit:cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="{{ route('categories.products', $cat->id) }}" class="text-decoration-none" style="color: inherit;">
                                {{ $cat->name }}
                            </a>
                        </h5>
                        <p class="card-text text-muted small mb-2">{{ $cat->description }}</p>
                        @if($cat->parent)
                            <span class="badge bg-info mb-2">فرعي من: {{ $cat->parent->name }}</span>
                        @endif
                        <div class="mt-auto d-flex justify-content-between">
                            <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-sm btn-primary">تعديل</a>
                            <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
