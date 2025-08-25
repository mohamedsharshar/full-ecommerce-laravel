@extends('layouts.app')

@section('content')
   <!-- single product -->
	<div class="single-product mt-150 mb-150" >
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="single-product-img">
						<img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}">
					</div>
				</div>
				<div class="col-md-7">
					<div class="single-product-content">
						<h3>{{ $product->name }}</h3>
						<p class="single-product-pricing"><span>{{ __('messages.price') }}</span> ${{ number_format($product->price, 2) }}</p>
						<p>{{ $product->description }}</p>
						<div class="single-product-form">
							<form action="{{ route('cart.store') }}" method="POST">
								@csrf
								<input type="hidden" name="product_id" value="{{ $product->id }}">
								<input type="number" name="quantity" placeholder="0" min="1" value="1">
								<button type="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i> {{ __('messages.add_to_cart') }}</button>
							</form>
							<p><strong>{{ __('messages.category') }}: </strong>{{ $product->category->name }}</p>
                            @if($product->subcategory)
                                <p><strong>{{ __('messages.sub_category') }}: </strong>{{ $product->subcategory->name }}</p>
                            @endif
						</div>
						<h4>{{ __('messages.share') }}:</h4>
						<ul class="product-share" dir="rtl">
							<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
							<li><a href=""><i class="fab fa-twitter"></i></a></li>
							<li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
							<li><a href=""><i class="fab fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end single product -->


@endsection
