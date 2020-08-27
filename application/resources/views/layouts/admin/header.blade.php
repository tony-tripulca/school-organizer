@section('navigation')
<section class="topbar">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-secondary">
        <button type="button" class="hamburger hamburger--arrow d-none d-lg-block">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
        <a class="navbar-brand roboto-bold" href="{{ route('admin.base') }}">School Organizer</a>
        <button type="button" class="hamburger hamburger--squeeze d-lg-none">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
    </nav>
</section>
<section class="sidebar bg-white shadow">
    <div class="profile-box">
        <div class="row text-center">
            <div class="col-12">
                <img src="{{ asset('/images/admin/users/default-image.png') }}" class="rounded" width="100">
            </div>
            <div class="col-12">
                <p class="roboto-bold text-12">{{ $current_user['first_name'] }} {{ $current_user['last_name'] }}</p>
            </div>
        </div>
    </div>
    <div class="spacer">
        <span class="roboto-bold text-_9 text-verylightgrey">MENU</span>
    </div>
    <div class="main-list list-group">
        <div class="link-type">
            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">
                <i class="nav-icon material-icons">dashboard</i> Dashboard
            </a>
        </div>
        <div class="drop-type">
            <button type="button" class="list-group-item list-group-item-action">
                <i class="nav-icon material-icons">group</i> Users
                <i class="nav-arrow material-icons">keyboard_arrow_right</i>
            </button>
            <div class="sub-list list-group">
                <a href="{{ route('admin.users.index', ['type' => 'admin']) }}" class="list-group-item list-group-item-action">Admin</a>
                <a href="{{ route('admin.users.index', ['type' => 'students']) }}" class="list-group-item list-group-item-action">Students</a>
                <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">View All</a>
            </div>
        </div>
    </div>
</section>
@endsection

