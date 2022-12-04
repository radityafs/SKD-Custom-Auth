<ul>
    @if (Auth::check() && Auth::user()->role == 'admin')
        <li class="nav-item">
            <a href="{{ url('admin/dashboard') }}" class="nav-link">
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('admin/agama') }}" class="nav-link">
                <p>
                    Crud Agama
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ url('logout') }}" class="nav-link">
                <p>
                    Logout
                </p>
            </a>
        </li>
    @else
        <li class="nav-item">
            <a href="{{ url('user/dashboard') }}" class="nav-link">
                <p>
                    Dashboard
                </p>
            </a>
        </li>



        <li class="nav-item">
            <a href="{{ url('logout') }}" class="nav-link">
                <p>
                    Logout
                </p>
            </a>
        </li>
    @endif
</ul>
