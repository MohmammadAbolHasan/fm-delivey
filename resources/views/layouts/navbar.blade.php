<nav class="navbar navbar-dark bg-dark">

    <div class="container-fluid">

        <span class="navbar-brand">
            {{ __('messages.app_name') }}
        </span>

        <div>
            <a href="{{ route('language.switch', 'en') }}" 
               class="btn btn-light btn-sm">
                {{ __('messages.english') }}
            </a>

            <a href="{{ route('language.switch', 'ar') }}" 
               class="btn btn-light btn-sm">
                {{ __('messages.arabic') }}
            </a>
        </div>

    </div>

</nav>