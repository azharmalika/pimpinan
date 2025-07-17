       <!-- Sidebar -->
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('beranda')}}">
    <div class="sidebar-brand-icon">
        <i class="fas fa-tasks"></i>
    </div>
    <div class="sidebar-brand-text mx-3">AGENDA PIMPINAN</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item {{ $menuDashboard ?? '' }}">
    <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

@if (auth()->user()->jabatan == 'Admin')
<!-- Heading -->
<div class="sidebar-heading">
    MENU ADMIN
</div>

<!-- Nav Item - Data User -->
<li class="nav-item {{ $menuAdminUser ?? '' }}">
    <a class="nav-link" href="{{ route('user') }}">
        <i class="fas fa-fw fa-user"></i>
        <span>Data User</span></a>
</li>

<!-- Nav Item - Agenda Pimpinan -->
<li class="nav-item {{ $menuAdminAgenda ?? '' }}">
    <a class="nav-link" href="{{ route('agenda') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Agenda Pimpinan</span></a>
</li>

<!-- Nav Item - Boking Ruangan Rapat -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('ruangan') }}">
        <i class="fas fa-building"></i>
        <span>Boking Ruangan Rapat</span></a>
</li>

<!-- Nav Item - Transkip Presensi -->
<li class="nav-item {{ $menuAdminTranskrip ?? '' }}">
    <a class="nav-link" href="{{ route('transkrip.index') }}">
        <i class="fas fa-fw fa-tasks"></i>
        <span>Transkip Presensi</span></a>
</li>

@elseif (auth()->user()->jabatan == 'Pimpinan')
<!-- Heading -->
<div class="sidebar-heading">
    MENU PIMPINAN
</div>

<!-- Nav Item - Agenda Pimpinan -->
<li class="nav-item {{ $menuPimpinanAgenda ?? '' }}">
    <a class="nav-link" href="{{ route('agenda') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Agenda Pimpinan</span></a>
</li>

<!-- Nav Item - Boking Ruangan Rapat -->
<li class="nav-item {{ $menuPimpinanAgenda ?? '' }}">
    <a class="nav-link" href="ruangan">
        <i class="fas fa-building"></i>
        <span>Boking Ruangan Rapat</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider">

@else
<!-- Heading -->
<div class="sidebar-heading">
    MENU KARYAWAN
</div>

<!-- Nav Item - Agenda Pimpinan -->
<li class="nav-item {{ $menuKaryawanUser ?? '' }}">
    <a class="nav-link" href="{{ route('agenda') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Agenda Pimpinan</span></a>
</li>

<!-- Nav Item - Boking Ruangan Rapat -->
<li class="nav-item {{ $menuKaryawanUser ?? '' }}">
    <a class="nav-link" href="{{ route('ruangan') }}">
        <i class="fas fa-building"></i>
        <span>Boking Ruangan Rapat</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider">
@endif

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->