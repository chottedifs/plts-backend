<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('admin-dashboard') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="menu-title">Kios</li><!-- /.menu-title -->
                <li class="">
                    <a href="{{ route('user-kios.index') }}"> <i class="menu-icon fa fa-list"></i>Data Penyewa Kios</a>
                </li>
                <li class="">
                    <a href="{{ route('outlet.index') }}"> <i class="menu-icon fa fa-list"></i>Data Kios</a>
                </li>
                <li class="">
                    <a href="{{ route('rate.index') }} "> <i class="menu-icon fa fa-plus"></i>Tarif Kios</a>
                </li>
                <li class="">
                    <a href="{{ route('tarif-kwh.index') }}"> <i class="menu-icon fa fa-plus"></i>Tarif Kwh Listrik</a>
                </li>

                <li class="menu-title">Keuangan</li><!-- /.menu-title -->
                <li class="">
                    <a href="{{ route('tagihan.index') }}"> <i class="menu-icon fa fa-list"></i>Tagihan Outlet</a>
                </li>
                <li class="menu-title">Transaksi</li><!-- /.menu-title -->
                <li class="">
                    <a href="#"> <i class="menu-icon fa fa-list"></i>Lihat Transaksi</a>
                </li>
                <li class="menu-title">Dan Lainnya</li><!-- /.menu-title -->
                <li class="">
                    <a href="#"> <i class="menu-icon fa fa-list"></i>Informasi</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
