<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home.index')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><img src="{{asset('image/logo-white.png')}}" width="250" alt=""></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages category Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Quản lý các danh mục</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý các danh mục:</h6>
                <a class="collapse-item" href="{{Route('danhmuc.index')}}">Danh mục</a>
                <a class="collapse-item" href="{{Route('nhomsanpham.index')}}">Nhóm sản phẩm</a>
                <a class="collapse-item" href="{{Route('loaisanpham.index')}}">Loại sản phẩm</a>
                <a class="collapse-item" href="{{Route('tacgia.index')}}">Tác giả</a>
                <a class="collapse-item" href="{{Route('nhacungcap.index')}}">Nhà cung cấp</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Product -->
    <li class="nav-item">
        <a class="nav-link" href="{{Route('sanpham.index')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Quản lý sản phẩm</span></a>
    </li>

    <!-- Nav Item - Product -->
    <li class="nav-item">
        <a class="nav-link" href="{{Route('nguoidung.index')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Quản lý người dùng</span></a>
    </li>

    <!-- Nav Item - Product -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('nhaphang.index')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Nhập hàng(!)</span></a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Quản lý đơn hàng</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý đơn hàng:</h6>
                <a class="collapse-item" href="{{route('donhang.index')}}">Danh sách tất cả đơn hàng</a>
                <a class="collapse-item" href="{{route('donhang.getxuly')}}">Xử lý đơn hàng</a>
                <a class="collapse-item" href="{{route('donhang.getupdatexuly')}}">Chỉnh sửa nv giao hàng</a>
                <a class="collapse-item" href="{{route('donhang.getxuathang')}}">Xuất đơn hàng</a>
                <a class="collapse-item" href="{{route('donhang.getgiaohang')}}">Giao hàng</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Product -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('thongke.getthongke')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Thống kê</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>