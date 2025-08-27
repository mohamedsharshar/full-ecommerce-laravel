@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-danger text-white text-center py-4 rounded-top-4">
                    <h3 class="mb-0 fw-bold">{{ __('messages.deleted_products') }}</h3>
                </div>
                <div class="card-body p-5">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('messages.name') }}</th>
                                    <th scope="col">{{ __('messages.image') }}</th>
                                    <th scope="col">{{ __('messages.price') }}</th>
                                    <th scope="col">{{ __('messages.quantity') }}</th>
                                    <th scope="col">{{ __('messages.deleted_at') }}</th>
                                    <th scope="col">{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <th scope="row">{{ $product->id }}</th>
                                        <td>{{ $product->name }}</td>
                                        <td><img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" width="50"></td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->deleted_at->format('Y-m-d') }}</td>
                                        <td>
                                            <form action="{{ route('products.restore', $product->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">{{ __('messages.restore') }}</button>
                                            </form>
                                            <form action="{{ route('products.forceDelete', $product->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('messages.force_delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">{{ __('messages.no_deleted_products') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
