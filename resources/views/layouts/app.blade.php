<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-200 h-screen antialiased leading-none">
    <div id="app">
        <nav class="bg-white shadow mb-8 py-3">
            <div class="container mx-auto px-6 md:px-0">
                <div class="flex items-center justify-between ">
                    <h1 class="mr-6">
                        <a href="{{ url('/projects') }}">
                            <img src="{{ asset('images/logo.svg')}}" alt="birdboard">
                        </a>
                    </h1>
                    <div class="flex">
                        @guest
                            <a class="no-underline hover:underline text-black-100 text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="no-underline hover:underline text-black-100 text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <dropdown align="right">
                                <template v-slot:trigger>                           
                                    <button class="flex items-center text-black-100 text-sm pr-4">
                                        <img src="{{ asset('images/custom-cat-avatar.jpeg')}}" 
                                        alt="{{ Auth::user()->name }}'s avatar"
                                        class="rounded-full w-10 mr-1">
                                        {{ Auth::user()->name }}
                                    </button>
                                </template>

                                <a href="#" class="block hover:underline leading-loose px-4 ">Item 1</a>
                                <a href="#" class="block hover:underline leading-loose px-4">Item 2</a>
                                <a href="#" class="block hover:underline leading-loose px-4">Item 3</a>
                            </dropdown>  
                            <a href="{{ route('logout') }}"
                               class="no-underline hover:underline text-black-100 text-sm p-3"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <main class="container mx-auto py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
