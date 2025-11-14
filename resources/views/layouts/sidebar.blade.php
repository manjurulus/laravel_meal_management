<div class="sidebar bg-light p-3 h-100">
    @php $role = auth()->user()->role ?? null; @endphp
    <h5 class="mb-3">Navigation</h5>
    <ul class="nav flex-column">

        {{-- Common Links --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
        </li>

        {{-- Manager Links --}}
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
        @endif

        {{-- Accountant Links --}}
        @if($role === 'accountant')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('accountant.payments.receive') }}">Receive Payments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reports.monthly') }}">Monthly Reports</a>
            </li>

            {{-- Payment Form --}}
            <li class="nav-item px-2 mt-3">
                <form method="POST" action="{{ route('payments.store') }}">
                    @csrf
                    <div class="mb-2">
                        <select name="user_id" class="form-select form-select-sm" required>
                            <option value="" disabled selected>Select Member</option>
                            @foreach ($members ?? [] as $member)
                                <option value="{{ $member->id }}">{{ $member->name }} (ID: {{ $member->id }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <input type="number" name="amount" class="form-control form-control-sm" placeholder="Amount" required min="1">
                    </div>
                    <input type="hidden" name="method" value="cash">
                    <button type="submit" class="btn btn-sm btn-success w-100">Record Payment</button>
                </form>
            </li>
        @endif

        {{-- Member Links --}}
        @if($role === 'member')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('meals.index') }}">My Meals</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('payments.index') }}">My Payments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dues.index') }}">My Dues</a>
            </li>
        @endif

        {{-- Logout --}}
        <hr class="my-3">
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger w-100">Logout</button>
            </form>
        </li>
    </ul>
</div>