@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h2 class="card-title text-center mb-4">{{__('messages.edit_category')}}</h2>
                    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">{{__('messages.name')}}</label>
                            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{__('messages.category_description')}}</label>
                            <textarea name="description" class="form-control">{{ $category->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{__('messages.current_image')}}:</label><br>
                            @if($category->image)
                                <img src="{{ asset('uploads/' . $category->image) }}" style="max-width:120px;" class="mb-2 rounded">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{__('messages.change_image')}}</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{__('messages.parent_category')}} ({{__('messages.optional')}})</label>
                            <select name="parent_id" class="form-select">
                                <option value="">{{__('messages.no_parent')}}</option>
                                @foreach($mainCategories as $main)
                                    <option value="{{ $main->id }}" @if($category->parent_id == $main->id) selected @endif>{{ $main->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{__('messages.edit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
