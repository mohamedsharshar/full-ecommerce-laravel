@extends('layouts.app')



@section('content')
<div class="container mt-5 mb-5">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('messages.profile') }}</div>
				<div class="card-body">
					<h5>{{ __('messages.name') }}: {{ Auth::user()->name }}</h5>
					<h5>{{ __('messages.email') }}: {{ Auth::user()->email }}</h5>
					<h5>{{ __('messages.phone') }}: {{ Auth::user()->phone ?? '-' }}</h5>
					<!-- يمكنك إضافة المزيد من بيانات المستخدم هنا -->
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
