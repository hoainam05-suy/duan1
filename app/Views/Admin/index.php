<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Ecomus - Ultimate Admin Dashboard HTML</title>
    <meta name="author" content="themesflat.com">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="assets/Admin/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="assets/Admin/css/animation.css">
    <link rel="stylesheet" type="text/css" href="assets/Admin/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/Admin/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="assets/Admin/css/styles.css">
    <!-- Font -->
    <link rel="stylesheet" href="assets/Admin/font/fonts.css">
    <!-- Icon -->
    <link rel="stylesheet" href="assets/Admin/icon/style.css">
    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="assets/Admin/images/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="assets/Admin/images/favicon.png">
</head>
<body>
    <!-- #wrapper -->
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <!-- layout-wrap -->
            <div class="layout-wrap">
                <!-- preload -->
                <div id="preload" class="preload-container">
                    <div class="preloading">
                        <span></span>
                    </div>
                </div>
                <!-- /preload -->

                <!-- section-menu-left (giữ nguyên phần sidebar) -->
                <?php include 'app/Views/Admin/layouts/sidebar.php' ?>

                <!-- section-content-right -->
                <div class="section-content-right">
                    <!-- header-dashboard (giữ nguyên phần header) -->
                    <?php include 'app/Views/Admin/layouts/header.php' ?>

                    <!-- main-content -->
                    <div class="main-content">
                        <!-- main-content-inner -->
                        <div class="main-content-inner">
                            <!-- main-content-wrap mới thay dashboard -->
                            <div class="main-content-wrap">
                                <div class="row">
                                    <!-- Tổng sản phẩm -->
                                    <div class="col-md-4">
                                        <div class="wg-box">
                                            <h3>Tổng sản phẩm</h3>
                                            <p><?= isset($totalProducts) ? $totalProducts : 0 ?></p>
                                        </div>
                                    </div>
                                    <!-- Tổng người dùng -->
                                    <div class="col-md-4">
                                        <div class="wg-box">
                                            <h3>Tổng người dùng</h3>
                                            <p><?= isset($totalUsers) ? $totalUsers : 0 ?></p>
                                        </div>
                                    </div>
                                    <!-- Tổng đơn hàng -->
                                    <div class="col-md-4">
                                        <div class="wg-box">
                                            <h3>Tổng đơn hàng</h3>
                                            <p><?= isset($totalOrders) ? $totalOrders : 0 ?></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Bạn có thể bổ sung thêm nội dung dashboard khác tại đây -->
                            </div>
                        </div>
                        <!-- /main-content-inner -->

                        <!-- bottom-page (giữ nguyên phần footer) -->
                        <?php include 'app/Views/Admin/layouts/footer.php' ?>
                    </div>
                    <!-- /main-content -->
                </div>
                <!-- /section-content-right -->
            </div>
            <!-- /layout-wrap -->
        </div>
        <!-- /#page -->
    </div>
    <!-- /#wrapper -->

    <!-- Javascript -->
    <script src="assets/Admin/js/jquery.min.js"></script>
    <script src="assets/Admin/js/bootstrap.min.js"></script>
    <script src="assets/Admin/js/bootstrap-select.min.js"></script>
    <script src="assets/Admin/js/zoom.js"></script>
    <script src="assets/Admin/js/morris.min.js"></script>
    <script src="assets/Admin/js/raphael.min.js"></script>
    <script src="assets/Admin/js/morris.js"></script>
    <script src="assets/Admin/js/jvectormap.min.js"></script>
    <script src="assets/Admin/js/jvectormap-us-lcc.js"></script>
    <script src="assets/Admin/js/jvectormap-data.js"></script>
    <script src="assets/Admin/js/jvectormap.js"></script>
    <script src="assets/Admin/js/apexcharts/apexcharts.js"></script>
    <script src="assets/Admin/js/apexcharts/line-chart-1.js"></script>
    <script src="assets/Admin/js/apexcharts/line-chart-2.js"></script>
    <script src="assets/Admin/js/apexcharts/line-chart-3.js"></script>
    <script src="assets/Admin/js/apexcharts/line-chart-4.js"></script>
    <script src="assets/Admin/js/apexcharts/line-chart-5.js"></script>
    <script src="assets/Admin/js/apexcharts/line-chart-6.js"></script>
    <script src="assets/Admin/js/apexcharts/line-chart-7.js"></script>
    <script src="assets/Admin/js/switcher.js"></script>
    <script defer src="assets/Admin/js/theme-settings.js"></script>
    <script src="assets/Admin/js/main.js"></script>
</body>
</html>
