<header>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <img src="{{asset('images/cliquetip-logo.png')}}" width="60" height="70" alt="CliqueTip Logo">
            <a class="navbar-brand" href="{{ url('/home') }}">
                {{ config('CliqueTip', 'CliqueTip') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <div class="row">
                            
                            <form action="{{ route('search') }}" method="GET" class="col-10">
                                <div class="input-group input-group-sm mt-2">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-warning" type="submit"><i class="bi bi-search"></i></button>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Search..." name="searchBar">
                                </div>
                            </form>

                            <a id="navbarDropdown" class="nav-link dropdown-toggle col-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('home')}}">
                                    {{ __('Home') }}
                                </a>
                                <a class="dropdown-item" href="/user">
                                    {{ __('User Profile') }}
                                </a>

                                <a class="dropdown-item" href="/chatroom">
                                    {{ __('Chat Room') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="col m-l-auto">
                            <a href="#" class="hamburger">
                                <div></div>
                            </a>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>