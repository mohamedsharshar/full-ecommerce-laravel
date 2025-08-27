<style>
    .boxed-btn{
        background: #f28123;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 10px 20px;
    }
    .boxed-btn:hover{
        background: #051922;
        color: #f28123;
    }
</style>
<div class="billing-address-form">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('shipping.store') }}" method="POST">
        @csrf
        <p>
            <input type="text" name="name" placeholder="{{ __('messages.name') }}" value="{{ old('name', $shipping->name ?? '') }}" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </p>
        <p>
            <input type="email" name="email" placeholder="{{ __('messages.email') }}" value="{{ old('email', $shipping->email ?? '') }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </p>

        <div class="mb-4">
            <input type="text" name="address" id="address" placeholder="{{ __('messages.address') }}" value="{{ old('address', $shipping->address ?? '') }}"
                class="w-100 px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
            @error('address')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <p>
            <input type="text" name="city" placeholder="{{ __('messages.city') }}" value="{{ old('city', $shipping->city ?? '') }}" required>
            @error('city')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </p>
        <p>
            <input type="text" name="state" placeholder="{{ __('messages.state') }}" value="{{ old('state', $shipping->state ?? '') }}" required>
            @error('state')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </p>
        <p>
            <input type="text" name="zip" placeholder="{{ __('messages.zip') }}" value="{{ old('zip', $shipping->zip ?? '') }}" required>
            @error('zip')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </p>
        <p>
            <button type="submit" class="boxed-btn">{{ __('messages.complete_order') }}</button>
        </p>
    </form>
</div>
