<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Feature</li>

        <li class="nav-item">
            <a class="nav-link {{(request()->is('user/event*')) ? '' : 'collapsed'}}" href="{{route('homeListEvent')}}">
                <i class="bi bi-calendar-check"></i>
                <span>List Event</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{(request()->is('user/fund-raising*')) ? '' : 'collapsed'}}" href="{{route('homeFundRaising')}}">
                <i class="bi bi-cash-coin"></i>
                <span>List Fund Raising</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{(request()->is('user/pesan-ruangan*')) ? '' : 'collapsed'}}" href="{{route('testPesanRuanganNew')}}">
                <i class="bi bi-calendar-plus-fill"></i>
                <span>Pesan Ruangan</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">User</li>

        <li class="nav-item">
            <a class="nav-link {{(request()->is('user/pembayaran*')) ? '' : 'collapsed'}}" href="{{route('keranjang')}}">
                <i class="ri-shopping-cart-fill"></i>
                <span>Keranjang</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{(request()->is('user/history-transaksi*')) ? '' : 'collapsed'}}" href="{{route('historyTransaksi')}}">
                <i class="bx bxs-cart-alt"></i>
                <span>History Transaksi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-contact.html">
                <i class="ri-ticket-2-fill"></i>
                <span>Tiket Event</span>
            </a>
        </li><!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-register.html">
                <i class="bi bi-card-list"></i>
                <span>Upgrade Jamaah</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{(request()->is('user/transaksi/pesanan-ruangan*')) ? '' : 'collapsed'}}" href="{{route('listPesananRuangan')}}">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Pesanan Ruangan Anda</span>
            </a>
        </li><!-- End Login Page Nav -->

    </ul>

</aside><!-- End Sidebar-->
