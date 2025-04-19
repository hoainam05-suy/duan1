<!-- Giống cấu trúc bạn gửi -->
<div id="wrapper">
    <div id="page" class="">
        <div class="layout-wrap loader-off">

            <!-- Preload -->
            <div id="preload" class="preload-container">
                <div class="preloading"><span></span></div>
            </div>

            <!-- Sidebar -->
            <?php include 'app/Views/Admin/layouts/sidebar.php'; ?>

            <!-- Main content -->
            <div class="section-content-right">

                <!-- Header -->
                <?php include 'app/Views/Admin/layouts/header.php'; ?>

                <div class="main-content">
                    <div class="main-content-inner">
                        <div class="main-content-wrap">

                            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                                <h3>Dashboard</h3>
                                <ul class="breadcrumbs flex items-center gap10">
                                    <li><a href="#"><div class="text-tiny">Dashboard</div></a></li>
                                    <li><i class="icon-chevron-right"></i></li>
                                    <li><div class="text-tiny">Home</div></li>
                                </ul>
                            </div>

                            <!-- Dashboard Stat Cards -->
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body">
                                            <h5 class="card-title">Tổng sản phẩm</h5>
                                            <p class="fs-4"><?= $totalProducts ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="card bg-success text-white">
                                        <div class="card-body">
                                            <h5 class="card-title">Tổng người dùng</h5>
                                            <p class="fs-4"><?= $totalUsers ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="card bg-warning text-dark">
                                        <div class="card-body">
                                            <h5 class="card-title">Tổng đơn hàng</h5>
                                            <p class="fs-4"><?= $totalOrders ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add chart area or latest orders if muốn mở rộng -->
                            
                        </div>
                    </div>

                    <!-- Footer -->
                    <?php include 'app/Views/Admin/layouts/footer.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="assets/Admin/js/jquery.min.js"></script>
<script src="assets/Admin/js/bootstrap.min.js"></script>
<script src="assets/Admin/js/bootstrap-select.min.js"></script>
<script src="assets/Admin/js/zoom.js"></script>
<script src="assets/Admin/js/switcher.js"></script>
<script defer src="assets/Admin/js/theme-settings.js"></script>
<script defer src="assets/Admin/js/main.js"></script>
