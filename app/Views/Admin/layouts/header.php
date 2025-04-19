<div class="header-dashboard">
                        <div class="wrap">
                            <div class="header-left">
                                <a href="index.html">
                                    <img class="" id="logo_header_mobile" alt="" src="https://themesflat.co/html/ecomus/assets/Admin/images/logo/logo.svg" data-light="../assets/Admin/images/logo/logo.svg" data-dark="https://themesflat.co/html/ecomus/assets/Admin/images/logo/logo-white.svg" >
                                </a>
                                <div class="button-show-hide">
                                    <i class="icon-chevron-left"></i>
                                </div>
                                
                            </div>
                            <div class="header-grid">
                               
                                <div class="popup-wrap user type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-user wg-user">
                                                <span class="image">
                                                    <img src="assets/Admin/images/avatar/user-1.png" alt="">
                                                </span>
                                                <span class="flex flex-column">
                                                    <span class="body-text text-main-dark"><?= $_SESSION['users']['name'] ?></span>
                                                    <span class="text-tiny"> Administrator</span>
                                                </span>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton3" >
                                            
                                        <a href="<?= BASE_URL ?>?role=admin&act=login" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-log-out"></i>
                                                    </div>
                                                    <div class="body-title-2">Log out</div>
                                                </a>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>