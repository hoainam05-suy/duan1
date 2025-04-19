<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->


<!-- Mirrored from themesflat.co/html/ecomus/admin-ecomus/product-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2024 14:58:56 GMT -->
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

<body class="body">

    <!-- #wrapper -->
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <!-- layout-wrap -->
           <div class="layout-wrap loader-off">
                <!-- preload -->
                <div id="preload" class="preload-container">
                    <div class="preloading">
                        <span></span>
                    </div>
                </div>
                <!-- /preload -->
                <!-- section-menu-left -->
                <?php include 'app/Views/Admin/layouts/sidebar.php' ?>
                <!-- /section-menu-left -->
                <!-- section-content-right -->
                <div class="section-content-right">
                    <!-- header-dashboard -->
                    <?php include 'app/Views/Admin/layouts/header.php' ?>
                    <!-- /header-dashboard -->
                    <!-- main-content -->
                    <div class="main-content">
                        <!-- main-content-wrap -->
                        <div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                                    <h3>All Products</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                        <li>
                                            <a><div class="text-tiny">Dashboard</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <a href="#"><div class="text-tiny">Product</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <div class="text-tiny">All Products</div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- product-list -->
                                <div class="wg-box">
                                        <?php if(isset($_SESSION['massage'])){
                                            echo "<p>".$_SESSION['massage']."</p>";
                                            unset($_SESSION['massage']);
                                        } ?>
                                  
                                    <div class="flex items-center justify-between gap10 flex-wrap">
                                     
                                        <a class="tf-button style-1 w208" href="<?= BASE_URL ?>?role=admin&act=add-product"><i class="icon-plus"></i>Add product</a>
                                    </div>
                                    <div class="wg-table table-product-list">
                                        <ul class="table-title flex gap20 mb-14">
                                            <li style="width: 50px;">
                                                <div class="body-title">STT</div>
                                            </li>
                                            <li style="width: 200px;">
                                                <div class="body-title">Name</div>
                                            </li>
                                            <li style="width: 100px;">
                                                <div class="body-title">Image</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Danh muc</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Gia</div>
                                            </li>
                                            <li style="width: 90px;">
                                                <div class="body-title">So luong</div>
                                            </li>
                                            <li >
                                                <div class="body-title">Action</div>
                                            </li>
                                        </ul>
                                        <ul class="flex flex-column">
                                            <?php foreach($listProduct as $key => $value):  ?>
                                                <li class="wg-product item-row gap20">
                                                    <div class="body-text text-main-dark mt-4" style="width: 50px;"><?= $key+ 1?></div>
                                                    <div class="body-text text-main-dark mt-4" style="width: 250px;"><?= $value->name?></div>
                                                    <div class="body-text text-main-dark mt-4" >
                                                        <img src="<?= $value->image_main?>" alt="" srcset="" width="50px">
                                                    </div>

                                                    <div class="body-text text-main-dark mt-4">
                                                        <?php foreach($listCategory as $category): ?>
                                                            <?php if($category->id == $value->category_id): ?>
                                                                <?= $category->name ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <div class="body-text text-main-dark mt-4">
                                                        <?= isset($value->price) ? number_format($value->price, 0, ',', '.') . ' VNĐ' : 'Không có giá' ?>
                                                    
                                                        <?php if($value->price_sale !== null){
                                                            echo "-";
                                                            echo isset($value->price_sale) ? number_format($value->price_sale, 0, ',', '.') . ' VNĐ' : 'Không có giá';
                                                        }  ?> 
                                                    </div>
                                                    <div class="body-text text-main-dark mt-4" style="width: 90px;" ><?= $value->stock ?></div>

                                                    <div class="list-icon-function">
                                                        <div class="item eye">
                                                        <a href="<?= BASE_URL ?>?role=admin&act=show-product&id=<?= $value->id ?>">
                                                            <i class="icon-eye"></i>
                                                        </a>
                                                        </div>
                                                        <div class="item edit">
                                                           <a href="<?= BASE_URL ?>?role=admin&act=update-product&id=<?= $value->id ?>">
                                                            <i class="icon-edit-3"></i>
                                                           </a>
                                                        </div>
                                                        <div class="item trash">
                                                            <a href="<?= BASE_URL ?>?role=admin&act=delete-product&id=<?= $value->id ?>">
                                                                <i class="icon-trash-2"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="divider"></div>
                                    
                                </div>
                                <!-- /product-list -->
                            </div>
                            <!-- /main-content-wrap -->
                        </div>
                        <!-- /main-content-wrap -->
                        <!-- bottom-page -->
                        <?php include 'app/Views/Admin/layouts/footer.php' ?>
                        <!-- /bottom-page -->
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
    <script src="assets/Admin/js/switcher.js"></script>
    <script defer src="assets/Admin/js/theme-settings.js"></script>
    <script defer src="assets/Admin/js/main.js"></script>

</body>


<!-- Mirrored from themesflat.co/html/ecomus/admin-ecomus/product-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2024 14:58:56 GMT -->
</html>
