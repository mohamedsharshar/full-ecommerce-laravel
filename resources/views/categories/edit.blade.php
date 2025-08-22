@extends('layouts.app')

@section('content')
<div class="container">
    <h2>تعديل الكاتجوري</h2>
    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>الاسم</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <div class="form-group">
            <label>الوصف</label>
            <textarea name="description" class="form-control">{{ $category->description }}</textarea>
        </div>
        <div class="form-group">
            <label>الصورة الحالية:</label><br>
            @if($category->image)
                <img src="{{ asset('uploads/' . $category->image) }}" style="max-width:100px;">
            @endif
        </div>
        <div class="form-group">
            <label>تغيير الصورة</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label>القسم الرئيسي (اختياري)</label>
            <select name="parent_id" class="form-control">
                <option value="">بدون</option>
                @foreach($mainCategories as $main)
                    <option value="{{ $main->id }}" @if($category->parent_id == $main->id) selected @endif>{{ $main->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
</div>
@endsection
