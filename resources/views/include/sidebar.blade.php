<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-header">ADMIN PANEL</li>
        <li class="nav-item">
            <a href="{{ route('admin.user.index') }}" class="nav-link">
                <i class="nav-icon fas fa-solid fa-user"></i>
                <p>
                    Пользователи
{{--                    <span class="badge badge-info right">{{ $users->count() }}</span> --}}{{-- total --}}
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.curs.index') }}" class="nav-link">
                <i class="nav-icon fas fa-solid fa-dollar-sign"></i>
                <p>
                    Валюта
{{--                    <span class="badge badge-info right">{{ $curs->count() }}</span> --}}{{-- total --}}
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.bel.index') }}" class="nav-link">
                <i class="nav-icon fas fa-solid fa-star"></i>
                <p>
                    Убеждения
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.checklist.index') }}" class="nav-link">
                <i class="nav-icon fas fa-solid fa-list"></i>
                <p>
                    Чек лист
                </p>
            </a>
        </li>
    </ul>
</nav>
