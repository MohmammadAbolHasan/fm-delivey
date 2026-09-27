@csrf

<div class="mb-3">
    <label>{{ __('driver_name') }}</label>
    <input
        type="text"
        name="name"
        class="form-control"
        value="{{ old('name', $driver->name ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label>{{ __('driver_phone') }}</label>
    <input
        type="text"
        name="phone"
        class="form-control"
        value="{{ old('phone', $driver->phone ?? '') }}">
</div>

<div class="mb-3">
    <label>{{ __('car') }}</label>
    <input
        type="text"
        name="car"
        class="form-control"
        value="{{ old('car', $driver->car ?? '') }}">
</div>

<div class="mb-3">
    <label>{{ __('plate_number') }}</label>
    <input
        type="text"
        name="plate_number"
        class="form-control"
        value="{{ old('plate_number', $driver->plate_number ?? '') }}">
</div>

<div class="form-check mb-3">
    <input
        type="checkbox"
        class="form-check-input"
        name="is_active"
        value="1"
        {{ old('is_active', $driver->is_active ?? true) ? 'checked' : '' }}>

    <label class="form-check-label">
        {{ __('active') }}
    </label>
</div>