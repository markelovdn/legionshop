<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/dist/img/legionLogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LegionShop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img
                    alt="{{ Auth::user()->name }}"
                    style="height:40px;border-radius: 50px;border: 1px solid grey;"
                    src="{{asset('storage/img/users/')}}/{{Auth::user()->picture}}"
                >
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('allUsers') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Пользователи</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('allCategories') }}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Категории товаров</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('allProducts') }}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Товары</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
