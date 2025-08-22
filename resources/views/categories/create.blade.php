@extends('layouts.app')

@section('content')
<div class="container">
    <h2>إضافة كاتجوري جديدة</h2>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>الاسم</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>الوصف</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>الصورة</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label>القسم الرئيسي (اختياري)</label>
            <select name="parent_id" class="form-control">
                <option value="">بدون</option>
                @foreach($mainCategories as $main)
                    <option value="{{ $main->id }}">{{ $main->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>
@endsection
