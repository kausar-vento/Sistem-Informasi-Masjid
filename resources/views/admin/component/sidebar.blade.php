<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route('admin.homeLaporanKeuangan')}}" class="app-brand-link">
            <span class="app-brand-logo demo">

            </span>
            <span class="app-brand-text demo menu-text fw-bolder text-uppercase">admin</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Layouts -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li>
        <li class="menu-item {{(request()->is('admin/laporan-keuangan*')) ? 'active' : ''}}">
            <a href="{{route('admin.homeLaporanKeuangan')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Account Settings">Transaksi Terakhir</div>
            </a>
        </li>
        <li class="menu-item {{(request()->is('admin/list-transaksi*')) ? 'active' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Transaksi</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('homeTransaksiEvent')}}" class="menu-link">
                        <div data-i18n="Account">Event Masjid</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('homeTransaksiFR')}}" class="menu-link">
                        <div data-i18n="Notifications">Penggalangan Dana</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('transaksiPR')}}" class="menu-link">
                        <div data-i18n="Connections">Pesan Ruangan</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{(request()->is('admin/ruangan-disewa*')) ? 'active' : ''}}">
            <a href="{{route('homeRuanganSewa')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Account Settings">Ruangan Disewa</div>
            </a>
        </li>
        <li class="menu-item {{(request()->is('admin/verifikasi-pesanan*')) ? 'active' : ''}}">
            <a href="{{route('verifikasiPesananRuangan')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                <div data-i18n="Account Settings">Pesanan Ruangan Masjid</div>
            </a>
        </li>
        <li class="menu-item {{(request()->is('admin/verifikasi-transaksi*')) ? 'active' : ''}}">
            <a href="{{route('admin.verifikasiTransaksiUser')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-check"></i>
                <div data-i18n="Account Settings">Verifikasi Transaksi</div>
            </a>
        </li>
        <li class="menu-item {{(request()->is('admin/manage-acount*')) ? 'active open' : ''}}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="User interface">Manage Acount</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{(request()->is('admin/manage-acount/petugas*')) ? 'active' : ''}}">
                    <a href="{{route('homeManagePetugas')}}" class="menu-link">
                        <div data-i18n="Accordion">Petugas</div>
                    </a>
                </li>
                <li class="menu-item {{(request()->is('admin/manage-acount/warga-pj*')) ? 'active' : ''}}">
                    <a href="{{route('homeMengeolaWargaPJ')}}" class="menu-link">
                        <div data-i18n="Alerts">Verifikasi Warga PJ</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
