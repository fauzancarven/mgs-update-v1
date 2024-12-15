<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Mobile Web-app fullscreen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

    <!-- Meta tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= base_url()?>assets/images/logo/logo.svg">

    <!--Title-->
    <title><?= $title; ?></title>

    <!--CSS styles-->
    <link rel="stylesheet" media="all" href="<?= base_url()?>assets/css/bootstrap.css" />
    <link rel="stylesheet" media="all" href="<?= base_url()?>assets/css/animate.css" />
    <link rel="stylesheet" media="all" href="<?= base_url()?>assets/css/font-awesome.css" />
    <link rel="stylesheet" media="all" href="<?= base_url()?>assets/css/furniture-icons.css" />
    <link rel="stylesheet" media="all" href="<?= base_url()?>assets/css/linear-icons.css" />
    <link rel="stylesheet" media="all" href="<?= base_url()?>assets/css/magnific-popup.css" />
    <link rel="stylesheet" media="all" href="<?= base_url()?>assets/css/owl.carousel.css" />
    <link rel="stylesheet" media="all" href="<?= base_url()?>assets/css/ion-range-slider.css" />
    <link rel="stylesheet" media="all" href="<?= base_url()?>assets/css/theme.css" />

    <!--Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    
<div class="page-loader">
    <div class="loading-spinner">
        </div>
    </div>

    <div class="wrapper">

        <!--Use class "navbar-fixed" or "navbar-default" -->
        <!--If you use "navbar-fixed" it will be sticky menu on scroll (only for large screens)-->
        <!-- ======================== Navigation ======================== -->

        <nav class="navbar-fixed bg-white">

            <div class="container">

                <!-- ==========  Top navigation ========== -->

                <div class="navigation navigation-top clearfix">
                    <ul>
                        <!--add active class for current page-->

                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>


                        <!-- 
                        <li><a href="javascript:void(0);" class="open-login"><i class="icon icon-user"></i></a></li> -->
                        <li><a href="javascript:void(0);" class="open-search"><i class="icon icon-magnifier"></i></a></li>
                        <!-- <li><a href="javascript:void(0);" class="open-cart"><i class="icon icon-cart"></i> <span>3</span></a></li> -->
                    </ul>
                </div> <!--/navigation-top-->

                <!-- ==========  Main navigation ========== -->

                <div class="navigation navigation-main">

                    <!-- Setup your logo here-->

                    <a href="<?= base_url(); ?>" class="logo"><img src="<?= base_url()?>assets/images/logo/logo-nav-white.png" alt="" /></a>

                    <!-- Mobile toggle menu -->

                    <a href="#" class="open-menu"><i class="icon icon-menu"></i></a>

                    <!-- Convertible menu (mobile/desktop)-->

                    <div class="floating-menu">

                        <!-- Mobile toggle menu trigger-->

                        <div class="close-menu-wrapper">
                            <span class="close-menu"><i class="icon icon-cross"></i></span>
                        </div>

                        <ul>
                            <li><a href="<?= base_url(); ?>">Home</a></li> 
                            <li><a href="#product">Products</a></li>
                            <li><a href="#interior">Interior</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="#blog">Blog</a></li>
                        </ul>
                    </div> <!--/floating-menu-->
                </div> <!--/navigation-main-->

                <!-- ==========  Search wrapper ========== -->

                <div class="search-wrapper">

                    <!-- Search form -->
                    <input class="form-control" placeholder="Search..." />
                    <button class="btn btn-main btn-search">Go!</button>

                    <!-- Search results - live search -->
                    <div class="search-results">
                        <div class="search-result-items">
                            <div class="title h4">Products <a href="#" class="btn btn-clean-dark btn-xs">View all</a></div>
                            <ul>
                                <li><a href="#"><span class="id">42563</span> <span class="name">Green corner</span> <span class="category">Sofa</span></a></li>
                                <li><a href="#"><span class="id">42563</span> <span class="name">Laura</span> <span class="category">Armchairs</span></a></li>
                                <li><a href="#"><span class="id">42563</span> <span class="name">Nude</span> <span class="category">Dining tables</span></a></li>
                                <li><a href="#"><span class="id">42563</span> <span class="name">Aurora</span> <span class="category">Nightstands</span></a></li>
                                <li><a href="#"><span class="id">42563</span> <span class="name">Dining set</span> <span class="category">Kitchen</span></a></li>
                                <li><a href="#"><span class="id">42563</span> <span class="name">Seat chair</span> <span class="category">Bar sets</span></a></li>
                            </ul>
                        </div> <!--/search-result-items-->
                        <div class="search-result-items">
                            <div class="title h4">Blog <a href="#" class="btn btn-clean-dark btn-xs">View all</a></div>
                            <ul>
                                <li><a href="#"><span class="id">01 Jan</span> <span class="name">Creating the Perfect Gallery Wall </span> <span class="category">Interior ideas</span></a></li>
                                <li><a href="#"><span class="id">12 Jan</span> <span class="name">Making the Most Out of Your Kids Old Bedroom</span> <span class="category">Interior ideas</span></a></li>
                                <li><a href="#"><span class="id">28 Dec</span> <span class="name">Have a look at our new projects!</span> <span class="category">Modern design</span></a></li>
                                <li><a href="#"><span class="id">31 Sep</span> <span class="name">Decorating When You're Starting Out or Starting Over</span> <span class="category">Best of 2017</span></a></li>
                                <li><a href="#"><span class="id">22 Sep</span> <span class="name">The 3 Tricks that Quickly Became Rules</span> <span class="category">Tips for you</span></a></li>
                            </ul>
                        </div> <!--/search-result-items-->
                    </div> <!--/search-results-->
                </div>

                <!-- ==========  Login wrapper ========== -->

                <div class="login-wrapper">
                    <form>
                        <div class="h4">Sign in</div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <a href="#forgotpassword" class="open-popup">Forgot password?</a>
                            <a href="#createaccount" class="open-popup">Don't have an account?</a>
                        </div>
                        <button type="submit" class="btn btn-block btn-main">Submit</button>
                    </form>
                </div>

                <!-- ==========  Cart wrapper ========== -->

                <!-- <div class="cart-wrapper">
                    <div class="checkout">
                        <div class="clearfix">
 
                            <div class="row"> 
                                <div class="cart-block cart-block-item clearfix">
                                    <div class="image">
                                        <a href="#"><img src="<?= base_url()?>assets/images/product/product-1.png" alt="" /></a>
                                    </div>
                                    <div class="title">
                                        <div><a href="#">Green corner</a></div>
                                        <small>Green corner</small>
                                    </div>
                                    <div class="quantity">
                                        <input type="number" value="2" class="form-control form-quantity" />
                                    </div>
                                    <div class="price">
                                        <span class="final">$ 1.998</span>
                                        <span class="discount">$ 2.666</span>
                                    </div> 
                                    <span class="icon icon-cross icon-delete"></span>
                                </div>
 

                                <div class="cart-block cart-block-item clearfix">
                                    <div class="image">
                                        <a href="#"><img src="<?= base_url()?>assets/images/product/product-2.png" alt="" /></a>
                                    </div>
                                    <div class="title">
                                        <div><a href="#">Green corner</a></div>
                                        <small>Green corner</small>
                                    </div>
                                    <div class="quantity">
                                        <input type="number" value="2" class="form-control form-quantity" />
                                    </div>
                                    <div class="price">
                                        <span class="final">$ 1.998</span>
                                        <span class="discount">$ 2.666</span>
                                    </div> 
                                    <span class="icon icon-cross icon-delete"></span>
                                </div> 

                                <div class="cart-block cart-block-item clearfix">
                                    <div class="image">
                                        <a href="#"><img src="<?= base_url()?>assets/images/product/product-3.png" alt="" /></a>
                                    </div>
                                    <div class="title">
                                        <div><a href="#">Green corner</a></div>
                                        <small>Green corner</small>
                                    </div>
                                    <div class="quantity">
                                        <input type="number" value="2" class="form-control form-quantity" />
                                    </div>
                                    <div class="price">
                                        <span class="final">$ 1.998</span>
                                        <span class="discount">$ 2.666</span>
                                    </div> 
                                    <span class="icon icon-cross icon-delete"></span>
                                </div>
 

                                <div class="cart-block cart-block-item clearfix">
                                    <div class="image">
                                        <a href="#"><img src="<?= base_url()?>assets/images/product/product-4.png" alt="" /></a>
                                    </div>
                                    <div class="title">
                                        <div><a href="#">Green corner</a></div>
                                        <small>Green corner</small>
                                    </div>
                                    <div class="quantity">
                                        <input type="number" value="2" class="form-control form-quantity" />
                                    </div>
                                    <div class="price">
                                        <span class="final">$ 1.998</span>
                                        <span class="discount">$ 2.666</span>
                                    </div> 
                                    <span class="icon icon-cross icon-delete"></span>
                                </div>
                            </div>

                            <hr />
 

                            <div class="clearfix">
                                <div class="cart-block cart-block-footer clearfix">
                                    <div>
                                        <strong>Discount 15%</strong>
                                    </div>
                                    <div>
                                        <span>$ 159,00</span>
                                    </div>
                                </div>

                                <div class="cart-block cart-block-footer clearfix">
                                    <div>
                                        <strong>Shipping</strong>
                                    </div>
                                    <div>
                                        <span>$ 30,00</span>
                                    </div>
                                </div>

                                <div class="cart-block cart-block-footer clearfix">
                                    <div>
                                        <strong>VAT</strong>
                                    </div>
                                    <div>
                                        <span>$ 59,00</span>
                                    </div>
                                </div>
                            </div>

                            <hr />
 
                            <div class="clearfix">
                                <div class="cart-block cart-block-footer clearfix">
                                    <div>
                                        <strong>Total</strong>
                                    </div>
                                    <div>
                                        <div class="h4 title">$ 1259,00</div>
                                    </div>
                                </div>
                            </div>

 

                            <div class="cart-block-buttons clearfix">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <a href="products-grid.html" class="btn btn-clean-dark">Continue shopping</a>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <a href="checkout-1.html" class="btn btn-main"><span class="icon icon-cart"></span> Checkout</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>  
                </div>  -->
                <!--/cart-wrapper-->
            </div> <!--/container-->
        </nav>

        <?= $this->renderSection('content') ?>




        <!-- ================== Footer  ================== -->

        <footer>
            <div class="container bg-white">

                <!--footer showroom-->
                <div class="footer-showroom ">
                    <div class="row">
                        <div class="col-sm-8"> 
                            <h2 style="color:#fff;">CV. Mahiera Global Solution</h2>
                            <p>Jl. Nuri Raya, Bakti Jaya, Kec. Setu, Kota Tangerang Selatan, Banten 15315</p>
                            <p>Mon - Sat: 8 am - 6 pm &nbsp; &nbsp; | &nbsp; &nbsp; Sun: Closed</p>
                        </div>
                        <div class="col-sm-4 text-center">
                            <a target="_blank" href="https://maps.app.goo.gl/mKXTpQnJRmskC5UQA" class="btn btn-clean" style="color:#fff;"><span class="icon icon-map-marker"></span> Get directions</a><br>
                            <div  class="call-us h4" style="color:#fff;"><span class="icon icon-phone-handset"><a href="tel:6285217952625" target="_blank"></span> +62 852-1795-2625</a></div>
                        </div>
                    </div>
                </div>

                <!--footer links-->
                <div class="footer-links">
                    <div class="row">
                        <div class="col-sm-4 col-md-2" style="display:none">
                            <h5 style="color:#fff;">Browse by</h5>
                            <ul>
                                <li><a href="#">Brand</a></li>
                                <li><a href="#">Product</a></li>
                                <li><a href="#">Category</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-2" style="display:none">
                            <h5 style="color:#fff;">Recources</h5>
                            <ul>
                                <li><a href="#">Design</a></li>
                                <li><a href="#">Projects</a></li>
                                <li><a href="#">Sales</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-2" style="display:none">
                            <h5 style="color:#fff;">Our company</h5>
                            <ul>
                                <li><a href="#">About</a></li>
                                <li><a href="#">News</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-12 col-md-6 col-md-offset-6">
                            <h5 style="color:#fff;">Sign up for our newsletter</h5>
                            <p><i>Add your email address to sign up for our monthly emails and to receive promotional offers.</i></p>
                            <div class="form-group form-newsletter">
                                <input class="form-control" type="text" name="email" value="" placeholder="Email address" />
                                <input type="submit" class="btn btn-clean btn-sm" value="Subscribe" />
                            </div>
                        </div>
                    </div>
                </div>

                <!--footer social-->

                <div class="footer-social" style="display:none">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="https://themeforest.net/item/mobel-furniture-website-template/20382155" target="_blank"><i class="fa fa-download"></i> Download Mobel</a> &nbsp; | <a href="#">Sitemap</a> &nbsp; | &nbsp; <a href="#">Privacy policy</a>
                        </div>
                        <div class="col-sm-6 links">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div> 
    <!--/wrapper-->

    <!--JS files-->
    <script src="<?= base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url()?>assets/js/jquery.bootstrap.js"></script>
    <script src="<?= base_url()?>assets/js/jquery.magnific-popup.js"></script>
    <script src="<?= base_url()?>assets/js/jquery.owl.carousel.js"></script>
    <script src="<?= base_url()?>assets/js/jquery.ion.rangeSlider.js"></script>
    <script src="<?= base_url()?>assets/js/jquery.isotope.pkgd.js"></script>
    <script src="<?= base_url()?>assets/js/main.js"></script>
</body>

</html>