<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::route()->named('dashboard') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('dashboard') }}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>

            @can('add-employee')
                <li class="nav-item">
                    <a class="nav-link {{ Request::route()->named('employee.add') ? 'active' : '' }}"
                        href="{{ route('employee.add') }}">
                        <span data-feather="users"></span>
                        Add Employee
                    </a>
                </li>
            @endcan

            @can('add-customer')
                <li class="nav-item">
                    <a class="nav-link {{ Request::route()->named('customer.add') ? 'active' : '' }}"
                        href="{{ route('customer.add') }}">
                        <span data-feather="users"></span>
                        Add Customer
                    </a>
                </li>
            @endcan

            @can('get-customers')
                <li class="nav-item">
                    <a class="nav-link {{ Request::route()->named('customer.all') ? 'active' : '' }}"
                        href="{{ route('customer.all') }}">
                        <span data-feather="users"></span>
                        @if (Auth::user()->role === \App\Models\User::ADMIN_ROLE)
                            All Customers
                        @else
                            My Customers
                        @endif
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</nav>
