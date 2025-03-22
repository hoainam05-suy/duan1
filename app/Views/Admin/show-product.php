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
                                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                                    <h3>Show product</h3>
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
                                            <div class="text-tiny">Show product</div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- add-new-user -->
                                <form action="" class="form-add-new-user form-style-2" method="post" >
                                    <div class="wg-box">
                                        
                                        <div class="right flex-grow">
                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10" for="name">Name</div>
                                                <input class="flex-grow" type="text" id="name" placeholder="Name" name="name" value="<?= $product->name?>" readonly>
                                            </fieldset>

                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10" for="category">Danh muc</div>
                                                <select name="category" id="category">
                                                    <?php foreach ($listCategory as $key => $value): ?>
                                                        <option value="<?= $value->id ?>"
                                                            <?php 
                                                                if($product->category_id == $value->id):?> selected
                                                        
                                                            <?php endif?>><?= $value->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </fieldset>

                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10" for="price">Price</div>
                                                <input class="flex-grow" type="text" id="price" placeholder="Price" name="price" value="<?= $product->price?>" readonly>
                                            </fieldset>

                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10" for="price-sale">Price Sale</div>
                                                <input class="flex-grow" type="text" id="price-sale" placeholder="Price Sale" name="price-sale" value="<?= $product->price_sale?>" readonly>
                                            </fieldset>

                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10" for="stock">Stock</div>
                                                <input class="flex-grow" type="text" id="stock" placeholder="Stock" name="stock" value="<?= $product->stock ?>" readonly>
                                            </fieldset>

                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10" for="image_main">Image Main</div>
                                                <img src="<?= $product->image_main ?>" alt="" srcset="" width="50px">
                                                <input class="flex-grow" type="file" id="image_main" placeholder="Image Main" name="image_main"  accept="image./*" readonly>
                                            </fieldset>

                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10" for="description">Description</div>
                                                <textarea id="description" placeholder="Description" name="description" class="flex-grow" readonly><?= $product->description ?></textarea>
                                            </fieldset>
                                            
                                            <fieldset class="name mb-24">
                                                <h4> List image</h4>
                                                <button type="" class="btn-sm btn btn-primary" id="btnAddImage">Add image</button>
                                                <div class="block-image">
                                                    
                                                </div>
                                            </fieldset>
                                            <hr>

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
    <script>
        $(".block-image").empty();
        <?php if(count($listProductImage)> 0): ?>
            let UI = "";
            <?php foreach ($listProductImage as $key => $value): ?>
                UI = `
                <div class="mt-5 mb-8">
                    <p>Hinh anh</p>
                    <img src="<?= $value->image ?>" width="50px">
                    <div class="d-flex">
                        <input type="file" class="form-control" name ="image[]" accept="image/*">
                        <button class = "btn-sm btn btn-danger btn -delete">Xoa</button>
                    </div>             
                </div>
            `;
            $(".block-image").append(UI)
            <?php endforeach; ?>
        <?php endif ?>
        $("#btnAddImage").click(function(e){
            e.preventDefault();
            let UI = `
                <div class="mt-5 mb-8">
                    <p>Hinh anh</p>
                    <div class="d-flex">
                        <input type="file" class="form-control" name ="image[]" accept="image/*">
                        <button class = "btn-sm btn btn-danger btn -delete">Xoa</button>
                    </div>             
                </div>
            `;
            $(".block-image").append(UI)

        })

        $(".block-image").on('click', '.btn-delete', function(){
            $(this).parent().parent().remove()
        })
    </script>

</body>


<!-- Mirrored from themesflat.co/html/ecomus/admin-ecomus/add-new-user.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2024 14:58:58 GMT -->
</html>