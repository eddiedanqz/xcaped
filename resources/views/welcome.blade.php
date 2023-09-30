<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen bg-gray-100 font-sans leading-none antialiased">
    <div class="flex flex-col">
        @if (Route::has('login'))
            <div class="absolute right-0 top-0 mr-4 mt-4 space-x-4 sm:mr-6 sm:mt-6 sm:space-x-6">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="text-sm font-normal uppercase text-teal-800 no-underline hover:underline">{{ __('Dashboard') }}</a>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-normal uppercase text-teal-800 no-underline hover:underline">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="text-sm font-normal uppercase text-teal-800 no-underline hover:underline">{{ __('Register') }}</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="flex min-h-screen items-center justify-center">
            <div class="flex h-full flex-col justify-around">
                <div>
                    <h1 class="mb-6 text-center text-4xl font-light tracking-wider text-gray-600 sm:mb-8 sm:text-6xl">
                        {{ config('app.name', 'Laravel') }}
                    </h1>
                    <ul class="flex flex-col space-y-2 sm:flex-row sm:flex-wrap sm:space-x-8 sm:space-y-0">
                        <li>
                            <a href="https://laravel.com/docs"
                                class="text-sm font-normal uppercase text-teal-800 no-underline hover:underline"
                                title="Documentation">Documentation</a>
                        </li>
                        <li>
                            <a href="https://laracasts.com"
                                class="text-sm font-normal uppercase text-teal-800 no-underline hover:underline"
                                title="Laracasts">Laracasts</a>
                        </li>
                        <li>
                            <a href="https://laravel-news.com"
                                class="text-sm font-normal uppercase text-teal-800 no-underline hover:underline"
                                title="News">News</a>
                        </li>
                        <li>
                            <a href="https://nova.laravel.com"
                                class="text-sm font-normal uppercase text-teal-800 no-underline hover:underline"
                                title="Nova">Nova</a>
                        </li>
                        <li>
                            <a href="https://forge.laravel.com"
                                class="text-sm font-normal uppercase text-teal-800 no-underline hover:underline"
                                title="Forge">Forge</a>
                        </li>
                        <li>
                            <a href="https://vapor.laravel.com"
                                class="text-sm font-normal uppercase text-teal-800 no-underline hover:underline"
                                title="Vapor">Vapor</a>
                        </li>
                        <li>
                            <a href="https://github.com/laravel/laravel"
                                class="text-sm font-normal uppercase text-teal-800 no-underline hover:underline"
                                title="GitHub">GitHub</a>
                        </li>
                        <li>
                            <a href="https://tailwindcss.com"
                                class="text-sm font-normal uppercase text-teal-800 no-underline hover:underline"
                                title="Tailwind Css">Tailwind CSS</a>
                        </li>
                    </ul>
                </div>
            </div>
            {{ var_dump(openssl_get_cert_locations()) }}
            <form method="POST" action="{{ route('pay') }}" role="form">

                <input type="email" name="email" value="test@gmail.com" required> {{-- required --}}
                <input type="text" name="orderID" value="38">
                <input type="text" name="amount" value="1.00"> {{-- required in kobo --}}
                <input type="text" name="quantity" value="3">
                <input type="text" name="currency" value="GHS">
                <input type="text" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}

                <p>
                    <button class="btn btn-success btn-lg btn-block" type="submit" value="Proceed to Payment">
                        <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                    </button>
                </p>
            </form>

        </div>
    </div>
</body>

</html>
