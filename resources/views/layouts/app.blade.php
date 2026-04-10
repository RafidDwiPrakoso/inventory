<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Inventaris')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            width: 250px;
            background-color: #343a40;
            color: white;
        }

        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #495057;
            color: white;
        }

        .content-area {
            flex-grow: 1;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body class="d-flex">

    <div class="sidebar d-flex flex-column pt-3">
        <h4 class="text-center mb-4">InventarisKu</h4>

        @if (auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('staff.dashboard.*') ? 'active' : '' }}"><i class="bi bi-speedometer2 me-2"></i>
                Dashboard</a>
            <a href="{{ route('admin.categories.index')}}"
                class="{{ request()->routeIs('staff.categories.*') ? 'active' : ''}}"><i class="bi bi-tags me-2"></i>
                Categories</a>
            <a href="{{ route('admin.items.index')}}"
                class="{{ request()->routeIs('staff.items.*') ? 'active' : ''}}"><i class="bi bi-box-seam me-2"></i>
                Items</a>
            <a href="{{ route('admin.users.index')}}"
                class="{{ request()->routeIs('staff.users.*') ? 'active' : ''}}"><i class="bi bi-people me-2"></i>
                Users</a>
        @elseif (auth()->user()->role === 'headstaff')
            <a href="{{ route('staff.dashboard')}}"
                class="{{ request()->routeIs('staff.dashboard.*') ? 'active' : ''}}"><i class="bi bi-speedometer2 me-2"></i>
                Dashboard</a>
            <a href="{{ route('staff.borrows.index')}}"
                class="{{ request()->routeIs('staff.borrows.*') ? 'active' : ''}}"><i class="bi bi-arrow-left-right me-2"></i>
                Borrow</a>
            <a href="{{ route('staff.users.index')}}"
                class="{{ request()->routeIs('staff.users.*') ? 'active' : ''}}"><i
                    class="bi bi-person-circle me-2"></i> User</a>
        @elseif (auth()->user()->role === 'staff')
            <a href="{{ route('staff.dashboard')}}"
                class="{{ request()->routeIs('staff.dashboard.*') ? 'active' : ''}}"><i class="bi bi-speedometer2 me-2"></i>
                Dashboard</a>
            <a href="{{ route('staff.borrows.index')}}"
                class="{{ request()->routeIs('staff.borrows.*') ? 'active' : ''}}"><i class="bi bi-arrow-left-right me-2"></i>
                Borrow</a>  
        @endif
    </div>

    <div class="content-area d-flex flex-column">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4">
            <div class="ms-auto d-flex align-items-center">
                <span class="me-3 fw-bold">Halo, {{ auth()->user()->name }}
                    ({{ ucfirst(auth()->user()->role) }})</span>

                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-box-arrow-right"></i>
                        Logout</button>
                </form>
            </div>
        </nav>

        <div class="container-fluid p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
