@extends('layouts.app')

@section('content')

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>{{ __('messages.support_24_7') }}</p>
						<h1>{{ __('messages.contact_us') }}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- contact form -->
	<div class="contact-from-section mt-150 mb-150">
		@if (session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		@endif
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul class="mb-0">
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mb-5 mb-lg-0">
					<div class="form-title">
						<h2>{{ __('messages.have_question') }}</h2>
						<p>{{ __('messages.lorem_text') }}</p>
					</div>
				 	<div id="form_status"></div>
					<div class="contact-form">
						<form method="POST" action="{{ route('contact.submit') }}">
							@csrf
							<p>
								<input type="text" placeholder="{{ __('messages.name') }} (AR)" name="name_ar" id="name_ar">
								<input type="text" placeholder="{{ __('messages.name') }} (EN)" name="name_en" id="name_en">
								<input type="email" placeholder="{{ __('messages.email') }}" name="email" id="email">
							</p>
							<p>
								<input type="tel" placeholder="{{ __('messages.phone') }}" name="phone" id="phone">
								<input type="text" placeholder="{{ __('messages.subject') }} (AR)" name="subject_ar" id="subject_ar">
								<input type="text" placeholder="{{ __('messages.subject') }} (EN)" name="subject_en" id="subject_en">
							</p>
							<p>
								<textarea name="message_ar" id="message_ar" cols="30" rows="5" placeholder="{{ __('messages.message') }} (AR)"></textarea>
								<textarea name="message_en" id="message_en" cols="30" rows="5" placeholder="{{ __('messages.message') }} (EN)"></textarea>
							</p>
							<input type="hidden" name="token" value="FsWga4&@f6aw" />
							<p><input type="submit" value="{{ __('messages.submit') }}"></p>
						</form>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="contact-form-wrap">
						<div class="contact-form-box">
							<h4><i class="fas fa-map"></i> {{ __('messages.shop_address') }}</h4>
							<p>34/8, East Hukupara <br> Gifirtok, Sadan. <br> Country Name</p>
						</div>
						<div class="contact-form-box">
							<h4><i class="far fa-clock"></i> {{ __('messages.shop_hours') }}</h4>
							<p>MON - FRIDAY: 8 to 9 PM <br> SAT - SUN: 10 to 8 PM </p>
						</div>
						<div class="contact-form-box">
							<h4><i class="fas fa-address-book"></i> {{ __('messages.contact') }}</h4>
							<p>Phone: +00 111 222 3333 <br> Email: support@fruitkha.com</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end contact form -->

	<!-- find our location -->
	<div class="find-location blue-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<p><i class="fas fa-map-marker-alt"></i> {{ __('messages.find_location') }}</p>
				</div>
			</div>
		</div>
	</div>
	<!-- end find our location -->

	<!-- google map section -->
	<div class="embed-responsive embed-responsive-21by9">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26432.42324808999!2d-118.34398767954286!3d34.09378509738966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bf07045279bf%3A0xf67a9a6797bdfae4!2sHollywood%2C%20Los%20Angeles%2C%20CA%2C%20USA!5e0!3m2!1sen!2sbd!4v1576846473265!5m2!1sen!2sbd" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" class="embed-responsive-item"></iframe>
	</div>
	<!-- end google map section -->

@endsection
