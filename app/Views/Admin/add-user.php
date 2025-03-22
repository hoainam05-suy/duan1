<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->


<!-- Mirrored from themesflat.co/html/ecomus/admin-ecomus/add-new-user.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2024 14:58:58 GMT -->
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
                                <!-- <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                                    <h3>Add New User</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                        <li>
                                            <a href="index.html"><div class="text-tiny">Dashboard</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <a href="#"><div class="text-tiny">User</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <div class="text-tiny">Add New User</div>
                                        </li>
                                    </ul>
                                </div> -->
                                <!-- add-new-user -->
                               
                                <form action="<?= BASE_URL ?>?role=admin&act=post-add-user" class="form-add-new-user form-style-2" method="post" enctype="multipart/form-data">
                                    <div class="wg-box">
                                    <?php if(isset($_SESSION['massage'])){
                                            echo "<p>".$_SESSION['massage']."</p>";
                                            unset($_SESSION['massage']);
                                        }
                                        // if (isset($_SESSION['error'])) {
                                        //     echo "<p>" . $_SESSION['error'] . "</p>";
                                        //     unset($_SESSION['error']);
                                        // }
                                         ?>
                                        <div class="right flex-grow">
                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10" for="name">Name</div>
                                                <input class="flex-grow" type="text" id="name" placeholder="Name" name="name" tabindex="0" value="" >
                                            </fieldset>
                                            <fieldset class="email mb-24">
                                                <div class="body-title mb-10" for="email">Email</div>
                                                <input class="flex-grow" type="email" id="email" placeholder="Email" name="email" tabindex="0" value="" aria-required="true" >
                                            </fieldset>
                                            <fieldset class="password mb-24">
                                                <div class="body-title mb-10">Password</div>
                                                <input class="password-input" type="password" id="password" placeholder="Password" name="password" tabindex="0" value="" aria-required="true" >
                                                <span class="show-pass">
                                                    <i class="icon-eye view"></i>
                                                    <i class="icon-eye-off hide"></i>
                                                </span>
                                            </fieldset>
                                            <fieldset class="address mb-24">
                                                <div for="address" class="body-title mb-10">Address</div>
                                                <input class="flex-grow" type="text" id="address" placeholder="Address" name="address" tabindex="0" value="" aria-required="true" >
                                            </fieldset>
                                            <fieldset class="phone mb-24">
                                                <div for="phone" class="body-title mb-10">Phone</div>
                                                <input class="flex-grow" type="text" id="phone" placeholder="Phone" name="phone" tabindex="0" value="" aria-required="true" >
                                            </fieldset>
                                            <fieldset class="image mb-24">
                                                <div for="image" class="body-title mb-10">Anh</div>
                                                <input class="flex-grow" type="file" id="image" name="image" tabindex="0" value="" aria-required="true" accept="image/*">
                                            </fieldset>
                                            <fieldset class="role mb-24">
                                                <div for="role" class="body-title mb-10">Role</div>
                                                <select name="role" id="role" class="form-control">
                                                    <option value="" hidden>Select Role</option>
                                                    <option value="1" >Admin</option>
                                                    <option value="2" >User</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                   
                                    <div class="bot">
                                        <button class="tf-button w180" type="submit">Thêm mới</button>
                                    </div>

                                </form>
                                <!-- /add-new-user -->
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


<!-- Mirrored from themesflat.co/html/ecomus/admin-ecomus/add-new-user.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2024 14:58:58 GMT -->
</html>