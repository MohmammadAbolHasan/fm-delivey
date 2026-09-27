@csrf

<div class="mb-3">
    <label>{{ __('client_name') }}</label>
    <input
        type="text"
        name="name"
        class="form-control"
        value="{{ old('name', $client->name ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label>{{ __('client_type') }}</label>

    <select name="type" class="form-control">

        <option value="Restaurant"
            {{ old('type', $client->type ?? '') == 'Restaurant' ? 'selected' : '' }}>
            {{ __('restaurant') }}
        </option>

        <option value="Shop"
            {{ old('type', $client->type ?? '') == 'Shop' ? 'selected' : '' }}>
            {{ __('shop') }}
        </option>

    </select>
</div>

<div class="mb-3">
    <label>{{ __('phone') }}</label>
    <input
        type="text"
        name="phone"
        class="form-control"
        value="{{ old('phone', $client->phone ?? '') }}">
</div>

<div class="mb-3">
    <label>{{ __('email') }}</label>
    <input
        type="email"
        name="email"
        class="form-control"
        value="{{ old('email', $client->email ?? '') }}">
</div>

<div class="mb-3">
    <label>{{ __('address') }}</label>
    <textarea
        name="address"
        class="form-control"
        rows="3">{{ old('address', $client->address ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>{{ __('notes') }}</label>
    <textarea
        name="notes"
        class="form-control"
        rows="3">{{ old('notes', $client->notes ?? '') }}</textarea>
</div>

<div class="form-check mb-3">
    <input
        type="checkbox"
        class="form-check-input"
        name="is_active"
        value="1"
        {{ old('is_active', $client->is_active ?? true) ? 'checked' : '' }}>

    <label class="form-check-label">
        {{ __('active') }}
    </label>
</div>