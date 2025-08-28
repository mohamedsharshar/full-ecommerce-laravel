@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-9">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="mb-4 text-center">{{ __('messages.add_product_images') }}<br><small class="text-muted">{{ $product->name }}</small></h4>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.image') }}</th>
                                    <th>{{ __('messages.update') }}</th>
                                    <th>{{ __('messages.delete') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product->images as $img)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset($img->image_path) }}" alt="" style="max-width: 120px; max-height: 120px; border-radius: 8px;">
                                        </td>
                                        <td>
                                            <form action="{{ route('productimages.update', $img->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="image" accept="image/*" class="form-control mb-2" required>
                                                <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-sync-alt"></i> {{ __('messages.update') }}</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('productimages.destroy', $img->id) }}" method="POST" onsubmit="return confirm('{{ __('messages.confirm_delete') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> {{ __('messages.delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> {{ __('messages.back_to_product') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
