<div class="col-md-3 col-lg-2 bg-primary text-white p-4">
    <h4 class="text-center mb-4">SIPerpus</h4>

    <ul class="nav flex-column gap-2">
        <li class="nav-item">
            <a href="/admin" class="nav-link text-white fw-semibold">
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="/admin/books" class="nav-link text-white">
                Books
            </a>
        </li>

        <li class="nav-item">
            <a href="/admin/users" class="nav-link text-white">
                Users
            </a>
        </li>

        <li class="nav-item mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-light w-100">
                    Logout
                </button>
            </form>
        </li>
    </ul>
</div>
