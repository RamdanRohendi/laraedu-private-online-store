<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.index') }}">Laraedu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::segment(1) == '' ? 'active' : '' }}" aria-current="page" href="{{ route('home.index') }}">Home</a>
                </li>
            </ul>
            @cannot('admin')
                <form method="GET" action="{{ route('home.pencarian') }}" class="d-flex mx-1 mb-3 mb-lg-0 mx-lg-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="input-search" name="kata_kunci" required>
                        <button class="btn btn-secondary border-light" type="submit" id="input-search">Search</button>
                    </div>
                </form>
            @endcannot
            @auth
                <div class="row d-flex justify-content-end">
                    <div class="dropdown col-auto">
                        <a class="text-decoration-none text-light dropdown-toggle ps-0" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->username }}
                            <img class="rounded-circle ms-1" src="{{ asset(Auth::user()->foto) }}" alt="foto-profile" width="30" height="30">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <div class="dropdown-item">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="w-100 btn text-start p-0" onclick="return confirm('Are you sure you want to logout?')">Logout</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            @endauth

            @guest
                <div class="text-end">
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-1">Login</a>
                    <a href="{{ route('register.show') }}" class="btn btn-light">Sign-Up</a>
                </div>
            @endguest
        </div>
    </div>
</nav>
