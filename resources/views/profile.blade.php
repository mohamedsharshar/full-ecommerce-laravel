@extends('layouts.app')



@section('content')
<div class="container mt-5 mb-5">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card shadow-sm border-0">
				<div class="card-header bg-primary text-white">{{ __('messages.profile') }}</div>
				<div class="card-body">
					@if(session('success'))
						<div class="alert alert-success">{{ session('success') }}</div>
					@endif
					<form action="{{ route('profile.update') }}" method="POST">
						@csrf
						@method('PUT')
						<div class="mb-3">
							<label for="name" class="form-label">{{ __('messages.name') }}</label>
							<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', Auth::user()->name) }}" required>
							@error('name')
								<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">{{ __('messages.email') }}</label>
							<input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', Auth::user()->email) }}" required>
							@error('email')
								<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
						<div class="mb-3">
							<label for="phone" class="form-label">{{ __('messages.phone') }}</label>
							<input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', Auth::user()->phone) }}">
							@error('phone')
								<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
						<div class="mb-3 text-end">
							<button type="submit" class="btn btn-success px-4">{{ __('messages.update') }}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
