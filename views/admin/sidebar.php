<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?=BASE_URL('');?>" class="nav-link">HOME</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="https://www.cmsnt.co/" target="_blank" class="nav-link">LIÊN HỆ</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="https://zalo.me/g/idapcx933" target="_blank" class="nav-link">HỖ TRỢ ZALO</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="https://www.youtube.com/playlist?list=PLylqe6Lzq69-TzmQ6kLzTg8ZkrxJxxtZm" target="_blank"
                        class="nav-link">HƯỚNG DẪN YOUTUBE</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="<?=BASE_URL('template/AdminLTE3/');?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">CMSNT.CO</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?=BASE_URL('template/AdminLTE3/');?>dist/img/user2-160x160.jpg"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?=$getUser['username'];?></a>
                    </div>
                </div>
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-header">Admin</li>
                        <li class="nav-item has-treeview menu-open">
                            <a href="<?=BASE_URL('views/admin/index.php');?>" class="nav-link <?=active_sidebar(['index.php']);?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item <?=menuopen_sidebar(['lich-su-nap-tien.php', 
                        'lich-su-dong-tien.php', 
                        'lich-su-hoat-dong.php',
                        'lich-su-mua-goi.php'
                        ]);?>">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-history"></i>
                                <p>
                                    Lịch Sử
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=BASE_URL('views/admin/lich-su-mua-goi.php');?>"
                                        class="nav-link <?=active_sidebar(['lich-su-mua-goi.php']);?>">
                                        <i class="fas fa-money-check-alt nav-icon"></i>
                                        <p>Lịch sử mua gói</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=BASE_URL('views/admin/lich-su-nap-tien.php');?>"
                                        class="nav-link <?=active_sidebar(['lich-su-nap-tien.php']);?>">
                                        <i class="fas fa-money-check-alt nav-icon"></i>
                                        <p>Lịch sử nạp tiền</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=BASE_URL('views/admin/lich-su-dong-tien.php');?>"
                                        class="nav-link <?=active_sidebar(['lich-su-dong-tien.php']);?>">
                                        <i class="fas fa-money-check-alt nav-icon"></i>
                                        <p>Lịch sử dòng tiền</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item <?=menuopen_sidebar(['lich-su-nap-tien.php', 
                        'boc-link-vpcs.php', 
                        'fake-link.php',
                        'rut-gon-link.php'
                        ]);?>">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>
                                    Quản Lý
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=BASE_URL('views/admin/boc-link-vpcs.php');?>"
                                        class="nav-link <?=active_sidebar(['boc-link-vpcs.php']);?>">
                                        <i class="fas fa-cog nav-icon"></i>
                                        <p>Bọc Link VPCS</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=BASE_URL('views/admin/fake-link.php');?>"
                                        class="nav-link <?=active_sidebar(['fake-link.php']);?>">
                                        <i class="fas fa-cog nav-icon"></i>
                                        <p>Fake Link</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('views/admin/users.php');?>"
                                class="nav-link <?=active_sidebar(['users.php', 'edit-user.php']);?>">
                                <i class="nav-icon fas fa-user-alt"></i>
                                <p>
                                    Thành Viên
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('views/admin/banks.php');?>"
                                class="nav-link <?=active_sidebar(['banks.php']);?>">
                                <i class="nav-icon fas fa-university"></i>
                                <p>
                                    Ngân hàng
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('views/admin/packages.php');?>"
                                class="nav-link <?=active_sidebar(['packages.php']);?>">
                                <i class="nav-icon fas fa-cubes"></i>
                                <p>
                                    Gói Thành Viên
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('views/admin/domains.php');?>"
                                class="nav-link <?=active_sidebar(['domains.php', 'edit-domain.php']);?>">
                                <i class="nav-icon fab fa-chrome"></i>
                                <p>
                                    Tên Miền
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('views/admin/menus.php');?>"
                                class="nav-link <?=active_sidebar(['menus.php', 'edit-menu.php']);?>">
                                <i class="nav-icon fas fa-bars"></i>
                                <p>
                                    Menus
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('views/admin/theme.php');?>"
                                class="nav-link <?=active_sidebar(['theme.php']);?>">
                                <i class="nav-icon fas fa-image"></i>
                                <p>
                                    Giao Diện
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('views/admin/settings.php');?>"
                                class="nav-link <?=active_sidebar(['settings.php']);?>">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Cài Đặt
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>