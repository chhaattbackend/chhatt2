
<aside class="main-sidebar sidebar-dark-primary elevation-4 mbg">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('images/clogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Chhatt/چھت Admin</span>
    </a>
    {{-- {{ config('app.name') }} --}}
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
