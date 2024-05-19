<div class="main-sidebar sidebar-style-2">
<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
    <a href="/dashboard">Dashboard</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
    <a href="/dashboard">GST</a>
    </div>
    <ul class="sidebar-menu">        
    <li class="menu-header">Avialable Features</li>
    <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Pages</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('parties.type.info') }}">Party Management</a></li>
            <li><a class="nav-link" href="{{ route('parties.info') }}">Party Info Management</a></li>
            {{-- <li><a class="nav-link" href="#">Leave Management</a></li> --}}
        </ul>
    </li>
</div>