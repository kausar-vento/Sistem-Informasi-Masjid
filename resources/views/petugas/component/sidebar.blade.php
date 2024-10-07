 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center" href="index.html">
         <div class="sidebar-brand-text mx-3">Welcome Petugas</div>
     </a>


     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Feature
     </div>

     <li class="nav-item {{(request()->is('petugas/event*')) ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Events</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List Events</h6>
                <a class="collapse-item {{(request()->is('petugas/event/notifikasi*')) ? 'active' : ''}}" href="{{route('homeListEventHadir')}}">Mengirimkan Notifikasi</a>
                <a class="collapse-item {{(request()->is('petugas/event/mengeola*')) ? 'active' : ''}}" href="{{route('petugas.homeEventPetugas')}}">Mengeola Event</a>
            </div>
        </div>
    </li>

     <!-- Nav Item - Tables -->
     <li class="nav-item {{(request()->is('petugas/fund-raising*')) ? 'active' : ''}}">
         <a class="nav-link" href="{{route('petugas.homeFundR')}}">
             <i class="fas fa-fw fa-table"></i>
             <span>Mengeola Fund Raising</span></a>
     </li>

     <!-- Nav Item - Charts -->
     <li class="nav-item {{(request()->is('petugas/mengeola-jamaah*')) ? 'active' : ''}}">
         <a class="nav-link" href="{{route('homeListJamaah')}}">
             <i class="fas fa-fw fa-chart-area"></i>
             <span>Mengeola Data Jamaah</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->
