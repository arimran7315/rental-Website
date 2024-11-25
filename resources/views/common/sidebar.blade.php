<div class="sidebar card shadow border-0 p-4">
    <h3>Sidebar</h3>
    <div class="card-body p-2">
        <ul>
            <li><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
            @cannot('isSeller')
                <li>
                    <a href="{{ route('users.index') }}">Users</a>
                </li>
            @endcannot
            @can('isSeller')
                <li>
                    <a href="{{ route('lands.index') }}">Land Listings</a>
                </li>
            @endcan
        </ul>
    </div>
</div>
