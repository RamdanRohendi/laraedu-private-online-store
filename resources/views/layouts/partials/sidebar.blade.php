<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="text-white bg-dark vh-100 py-4 px-2">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::segment(1) == '' ? 'active' : '' }}" href="{{ route('home.index') }}">
                    <i class="bi bi-house-door me-1"></i> Home
                </a>
            </li>
            <li>
                <a class="nav-link text-white {{ Request::segment(1) == 'products' ? 'active' : '' }}" href="{{ route('products.index') }}">
                    <i class="bi bi-box-seam me-1"></i> Products
                </a>
            </li>
            <li>
                <a class="nav-link text-white {{ Request::segment(1) == 'users' ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <i class="bi bi-people me-1"></i> Users
                </a>
            </li>
        </ul>

        <div class="mt-4 d-md-none">
            <hr class="mb-0">
            <div class="d-flex justify-content-end">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-dark" onclick="return confirm('Are you sure you want to logout?')">
                        <i class="bi bi-box-arrow-in-left me-2"></i>Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>
