@extends('adminlte::page')

@section('title', __('settings'))

@section('content_header')
    <div class="settings-header">
        <div>
            <h1>
                <i class="fas fa-cog"></i>
                {{ __('settings') }}
            </h1>

            <p>
                {{ __('manage_system_settings') }}
            </p>
        </div>
    </div>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{ route('settings.update') }}" method="POST">

    @csrf

    <div class="row">

        {{-- Company Information --}}
        <div class="col-lg-8 col-md-12">

            <div class="card settings-card">

                <div class="card-header">
                    <div class="settings-title">
                        <span class="settings-icon bg-primary">
                            <i class="fas fa-building"></i>
                        </span>

                        <div>
                            <h3 class="card-title">
                                {{ __('company_information') }}
                            </h3>

                            <small>
                                {{ __('company_information_description') }}
                            </small>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label>
                            {{ __('company_name') }}
                        </label>

                        <input
                            type="text"
                            name="company_name"
                            class="form-control"
                            value="{{ old('company_name', session('company_name', 'FM Delivery')) }}"
                            placeholder="{{ __('company_name') }}">
                    </div>


                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>
                                    {{ __('phone') }}
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    value="{{ old('phone', session('company_phone')) }}"
                                    placeholder="{{ __('phone') }}">
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="form-group">
                                <label>
                                    {{ __('email') }}
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email', session('company_email')) }}"
                                    placeholder="{{ __('email') }}">
                            </div>

                        </div>

                    </div>


                    <div class="form-group">

                        <label>
                            {{ __('address') }}
                        </label>

                        <textarea
                            name="address"
                            class="form-control"
                            rows="3"
                            placeholder="{{ __('address') }}">{{ old('address', session('company_address')) }}</textarea>

                    </div>

                </div>

            </div>

        </div>


        {{-- Language --}}
        <div class="col-lg-4 col-md-12">

            <div class="card settings-card">

                <div class="card-header">

                    <div class="settings-title">

                        <span class="settings-icon bg-info">
                            <i class="fas fa-language"></i>
                        </span>

                        <div>
                            <h3 class="card-title">
                                {{ __('language') }}
                            </h3>

                            <small>
                                {{ __('choose_language') }}
                            </small>
                        </div>

                    </div>

                </div>


                <div class="card-body">

                    <a href="{{ route('language.switch', ['locale' => 'en']) }}"
                       class="language-option">

                        <span>
                            🇬🇧
                            <strong>{{ __('english') }}</strong>
                        </span>

                        @if(app()->getLocale() === 'en')
                            <i class="fas fa-check text-success"></i>
                        @endif

                    </a>


                    <a href="{{ route('language.switch', ['locale' => 'ar']) }}"
                       class="language-option">

                        <span>
                            🇱🇧
                            <strong>{{ __('arabic') }}</strong>
                        </span>

                        @if(app()->getLocale() === 'ar')
                            <i class="fas fa-check text-success"></i>
                        @endif

                    </a>

                </div>

            </div>


            {{-- Invoice Settings --}}
            <div class="card settings-card">

                <div class="card-header">

                    <div class="settings-title">

                        <span class="settings-icon bg-success">
                            <i class="fas fa-file-invoice"></i>
                        </span>

                        <div>
                            <h3 class="card-title">
                                {{ __('invoice_settings') }}
                            </h3>

                            <small>
                                {{ __('invoice_settings_description') }}
                            </small>
                        </div>

                    </div>

                </div>


                <div class="card-body">

                    <div class="form-group">

                        <label>
                            {{ __('currency') }}
                        </label>

                        <select name="currency" class="form-control">

                            <option value="USD"
                                {{ session('currency', 'USD') === 'USD' ? 'selected' : '' }}>
                                USD - $
                            </option>

                            <option value="LBP"
                                {{ session('currency') === 'LBP' ? 'selected' : '' }}>
                                LBP - ل.ل
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label>
                            {{ __('invoice_prefix') }}
                        </label>

                        <input
                            type="text"
                            name="invoice_prefix"
                            class="form-control"
                            value="{{ old('invoice_prefix', session('invoice_prefix', 'INV-')) }}"
                            placeholder="INV-">

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Save --}}
    <div class="settings-save">

        <button type="submit" class="btn btn-primary btn-lg">

            <i class="fas fa-save"></i>

            {{ __('save_changes') }}

        </button>

    </div>

</form>

@stop


@section('css')

<style>

.settings-header {
    margin-bottom: 20px;
}

.settings-header h1 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 5px;
}

.settings-header p {
    color: #777;
    margin: 0;
}

.settings-card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 3px 15px rgba(0,0,0,.07);
    overflow: hidden;
    margin-bottom: 20px;
}

.settings-card .card-header {
    background: #fff;
    padding: 18px 20px;
    border-bottom: 1px solid #eee;
}

.settings-title {
    display: flex;
    align-items: center;
    gap: 12px;
}

.settings-title .card-title {
    font-weight: 700;
    margin: 0 0 3px;
}

.settings-title small {
    color: #888;
}

.settings-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.settings-card .card-body {
    padding: 20px;
}

.settings-card label {
    font-weight: 600;
    font-size: 14px;
}

.language-option {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px;
    margin-bottom: 10px;
    border: 1px solid #eee;
    border-radius: 8px;
    color: #333;
    text-decoration: none !important;
    transition: .2s;
}

.language-option:hover {
    background: #f8f9fa;
    border-color: #ddd;
}

.settings-save {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 25px;
}

@media (max-width: 767px) {

    .settings-header h1 {
        font-size: 23px;
    }

    .settings-card .card-body {
        padding: 15px;
    }

    .settings-save {
        justify-content: stretch;
    }

    .settings-save .btn {
        width: 100%;
    }

}

</style>

@stop