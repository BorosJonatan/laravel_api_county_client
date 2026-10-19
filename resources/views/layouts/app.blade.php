<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Counties App</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('counties.index') }}">{{ __('buttons.counties')}}</a></li>
                <li><a href="{{ route('cities.index') }}">{{ __('buttons.cities')}}</a></li>
                @if (!session()->has('api_token'))
                    <li><a href="{{ route('login') }}">{{ __('buttons.login')}}</a></li>
                @else
                    <li><a href="{{ route('logout') }}">{{ __('buttons.logout')}}</a></li>
                @endif
            </ul>
        </nav>
    </header>

    <main>
        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                <strong>Please fix the following errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>