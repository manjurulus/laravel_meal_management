<div class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
    <div class="position-sticky pt-3">
        <h5 class="text-center">Dashboard</h5>
        <ul class="nav flex-column">
            @php $role = auth()->user()->role; @endphp

            @if($role === 'manager')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('manager.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('manager.users.create') }}">Create User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('manager.members.search') }}">Search Members</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('manager.reports.index') }}">Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bills.index') }}">Bills</a>
                </li>
            

            @elseif($role === 'accountant')
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/accountant/reports/monthly/' . now()->format('m')) }}">Monthly Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('accountant.payments.receive') }}">Receive Payments</a>
                </li>


            @elseif($role === 'operations')
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/expenses/create') }}">Daily Bazar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/costs') }}">Other Costs</a>
                </li>

            @elseif($role === 'member')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('meals.index') }}">My Meals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dues.index') }}">My Dues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('payments.index') }}">My Payments</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('payments.store') }}" class="px-3">
                        @csrf
                        <div class="mb-2">
                            <input type="number" name="amount" class="form-control form-control-sm" placeholder="Enter amount" required min="1">
                        </div>
                        <input type="hidden" name="method" value="cash">
                        <button type="submit" class="btn btn-sm btn-primary w-100">Make Payment</button>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/profile') }}">Profile</a>
                </li>
            @endif

            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link text-danger bg-transparent border-0">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>