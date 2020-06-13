<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <title>Osahan Eat - Online Food Ordering Website HTML Template</title>
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="img/favicon.png">
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="vendor/fontawesome/css/all.min.css" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="vendor/icofont/icofont.min.css" rel="stylesheet">
    <!-- Select2 CSS-->
    <link href="vendor/select2/css/select2.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/osahan.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light osahan-nav shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.html"><img alt="logo" src="img/logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="offers.html"><i class="icofont-sale-discount"></i> Offers <span class="badge badge-danger">New</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Restaurants
                     </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                            <a class="dropdown-item" href="listing.html">Listing</a>
                            <a class="dropdown-item" href="detail.html">Detail + Cart</a>
                            <a class="dropdown-item" href="checkout.html">Checkout</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Pages
                     </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                            <a class="dropdown-item" href="track-order.html">Track Order</a>
                            <a class="dropdown-item" href="invoice.html">Invoice</a>
                            <a class="dropdown-item" href="login.html">Login</a>
                            <a class="dropdown-item" href="register.html">Register</a>
                            <a class="dropdown-item" href="404.html">404</a>
                            <a class="dropdown-item" href="extra.html">Extra :)</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img alt="Generic placeholder image" src="img/user/4.png" class="nav-osahan-pic rounded-pill"> My Account
                     </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                            <a class="dropdown-item" href="orders.html#orders"><i class="icofont-food-cart"></i> Orders</a>
                            <a class="dropdown-item" href="orders.html#offers"><i class="icofont-sale-discount"></i> Offers</a>
                            <a class="dropdown-item" href="orders.html#favourites"><i class="icofont-heart"></i> Favourites</a>
                            <a class="dropdown-item" href="orders.html#payments"><i class="icofont-credit-card"></i> Payments</a>
                            <a class="dropdown-item" href="orders.html#addresses"><i class="icofont-location-pin"></i> Addresses</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-cart">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="fas fa-shopping-basket"></i> Cart
                     <span class="badge badge-success">5</span>
                     </a>
                        <div class="dropdown-menu dropdown-cart-top p-0 dropdown-menu-right shadow-sm border-0">
                            <div class="dropdown-cart-top-header p-4">
                                <img class="img-fluid mr-3" alt="osahan" src="img/cart.jpg">
                                <h6 class="mb-0">Gus's World Famous Chicken</h6>
                                <p class="text-secondary mb-0">310 S Front St, Memphis, USA</p>
                                <small><a class="text-primary font-weight-bold" href="#">View Full Menu</a></small>
                            </div>
                            <div class="dropdown-cart-top-body border-top p-4">
                                <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Chicken Tikka Sub 12" (30 cm) x 1 <span class="float-right text-secondary">$314</span></p>
                                <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> Corn & Peas Salad x 1 <span class="float-right text-secondary">$209</span></p>
                                <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> Veg Seekh Sub 6" (15 cm) x 1 <span class="float-right text-secondary">$133</span></p>
                                <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Chicken Tikka Sub 12" (30 cm) x 1 <span class="float-right text-secondary">$314</span></p>
                                <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Corn & Peas Salad x 1 <span class="float-right text-secondary">$209</span></p>
                            </div>
                            <div class="dropdown-cart-top-footer border-top p-4">
                                <p class="mb-0 font-weight-bold text-secondary">Sub Total <span class="float-right text-dark">$499</span></p>
                                <small class="text-info">Extra charges may apply</small>
                            </div>
                            <div class="dropdown-cart-top-footer border-top p-2">
                                <a class="btn btn-success btn-block btn-lg" href="checkout.html"> Checkout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="breadcrumb-osahan pt-5 pb-5 bg-dark position-relative text-center">
        <h1 class="text-white">Invoice</h1>
        <h6 class="text-white-50">Order #25102589748</h6>
    </section>
    <section class="section pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="p-5 osahan-invoice bg-white shadow-sm">
                        <div class="row mb-5 pb-3 ">
                            <div class="col-md-8 col-10">
                                <h3 class="mt-0">Thanks for choosing <strong class="text-secondary">Osahan Eat</strong>, Gurdeep ! Here are your order details: </h3>
                            </div>
                            <div class="col-md-4 col-2 pl-0 text-right">
                                <p class="mb-4 mt-2">
                                    <a class="text-primary font-weight-bold" href="#"><i class="icofont-print"></i> PRINT</a>
                                </p>
                                <img alt="logo" src="img/favicon.png">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1 text-black">Order No: <strong>#25102589748</strong></p>
                                <p class="mb-1">Order placed at: <strong>12/11/2018, 06:26 PM</strong></p>
                                <p class="mb-1">Order delivered at: <strong>12/11/2018, 07:18 PM</strong></p>
                                <p class="mb-1">Order Status: <strong class="text-success">Delivered</strong></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-black">Delivery To:</p>
                                <p class="mb-1 text-primary"><strong>Gurdeep Singh Osahan</strong></p>
                                <p class="mb-1">291/d/1, 291, Jawaddi Kalan, Ludhiana, Punjab 141002, India
                                </p>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <p class="mb-1">Ordered from:</p>
                                <h6 class="mb-1 text-black"><strong>Shahi Khansama</strong></h6>
                                <p class="mb-1">Shop 3, Model Town Extension, Model Town, Ludhiana</p>
                                <table class="table mt-3 mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-black font-weight-bold" scope="col">Item Name</th>
                                            <th class="text-right text-black font-weight-bold" scope="col">Quantity</th>
                                            <th class="text-right text-black font-weight-bold" scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Veg Masala Roll</td>
                                            <td class="text-right">01</td>
                                            <td class="text-right">$49</td>
                                        </tr>
                                        <tr>
                                            <td>Veg Burger</td>
                                            <td class="text-right">01</td>
                                            <td class="text-right">$45</td>
                                        </tr>
                                        <tr>
                                            <td>Veg Penne Pasta in Red Sauce</td>
                                            <td class="text-right">01</td>
                                            <td class="text-right">$135</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="2">Item Total:</td>
                                            <td class="text-right"> $229</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="2">GST:</td>
                                            <td class="text-right"> $9.6</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="2">Delivery Charges:</td>
                                            <td class="text-right"> $00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="2">Discount Applied (GURDEEP50):</td>
                                            <td class="text-right"> $141.97</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="2">
                                                <h6 class="text-success">Grand Total:</h6>
                                            </td>
                                            <td class="text-right">
                                                <h6 class="text-success"> $96</h6>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section pt-5 pb-5 text-center bg-white">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h5 class="m-0">Operate food store or restaurants? <a href="login.html">Work With Us</a></h5>
                </div>
            </div>
        </div>
    </section>
    <section class="footer pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-12 col-sm-12">
                    <h6 class="mb-3">Subscribe to our Newsletter</h6>
                    <form class="newsletter-form mb-1">
                        <div class="input-group">
                            <input type="text" placeholder="Please enter your email" class="form-control">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary">
                           Subscribe
                           </button>
                            </div>
                        </div>
                    </form>
                    <p><a class="text-info" href="register.html">Register now</a> to get updates on <a href="offers.html">Offers and Coupons</a></p>
                    <div class="app">
                        <p class="mb-2">DOWNLOAD APP</p>
                        <a href="#">
                     <img class="img-fluid" src="img/google.png">
                     </a>
                        <a href="#">
                     <img class="img-fluid" src="img/apple.png">
                     </a>
                    </div>
                </div>
                <div class="col-md-1 col-sm-6 mobile-none">
                </div>
                <div class="col-md-2 col-4 col-sm-4">
                    <h6 class="mb-3">About OE</h6>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Culture</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-4 col-sm-4">
                    <h6 class="mb-3">For Foodies</h6>
                    <ul>
                        <li><a href="#">Community</a></li>
                        <li><a href="#">Developers</a></li>
                        <li><a href="#">Blogger Help</a></li>
                        <li><a href="#">Verified Users</a></li>
                        <li><a href="#">Code of Conduct</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-4 col-sm-4">
                    <h6 class="mb-3">For Restaurants</h6>
                    <ul>
                        <li><a href="#">Advertise</a></li>
                        <li><a href="#">Add a Restaurant</a></li>
                        <li><a href="#">Claim your Listing</a></li>
                        <li><a href="#">For Businesses</a></li>
                        <li><a href="#">Owner Guidelines</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="footer-bottom-search pt-5 pb-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <p class="text-black">POPULAR COUNTRIES</p>
                    <div class="search-links">
                        <a href="#">Australia</a> | <a href="#">Brasil</a> | <a href="#">Canada</a> | <a href="#">Chile</a> | <a href="#">Czech Republic</a> | <a href="#">India</a> | <a href="#">Indonesia</a> | <a href="#">Ireland</a> | <a href="#">New Zealand</a>                        | <a href="#">United Kingdom</a> | <a href="#">Turkey</a> | <a href="#">Philippines</a> | <a href="#">Sri Lanka</a> | <a href="#">Australia</a> | <a href="#">Brasil</a> | <a href="#">Canada</a> | <a href="#">Chile</a> | <a href="#">Czech Republic</a>                        | <a href="#">India</a> | <a href="#">Indonesia</a> | <a href="#">Ireland</a> | <a href="#">New Zealand</a> | <a href="#">United Kingdom</a> | <a href="#">Turkey</a> | <a href="#">Philippines</a> | <a href="#">Sri Lanka</a><a href="#">Australia</a>                        | <a href="#">Brasil</a> | <a href="#">Canada</a> | <a href="#">Chile</a> | <a href="#">Czech Republic</a> | <a href="#">India</a> | <a href="#">Indonesia</a> | <a href="#">Ireland</a> | <a href="#">New Zealand</a> | <a href="#">United Kingdom</a>                        | <a href="#">Turkey</a> | <a href="#">Philippines</a> | <a href="#">Sri Lanka</a> | <a href="#">Australia</a> | <a href="#">Brasil</a> | <a href="#">Canada</a> | <a href="#">Chile</a> | <a href="#">Czech Republic</a> | <a href="#">India</a>                        | <a href="#">Indonesia</a> | <a href="#">Ireland</a> | <a href="#">New Zealand</a> | <a href="#">United Kingdom</a> | <a href="#">Turkey</a> | <a href="#">Philippines</a> | <a href="#">Sri Lanka</a>
                    </div>
                    <p class="mt-4 text-black">POPULAR FOOD</p>
                    <div class="search-links">
                        <a href="#">Fast Food</a> | <a href="#">Chinese</a> | <a href="#">Street Food</a> | <a href="#">Continental</a> | <a href="#">Mithai</a> | <a href="#">Cafe</a> | <a href="#">South Indian</a> | <a href="#">Punjabi Food</a> |
                        <a
                            href="#">Fast Food</a> | <a href="#">Chinese</a> | <a href="#">Street Food</a> | <a href="#">Continental</a> | <a href="#">Mithai</a> | <a href="#">Cafe</a> | <a href="#">South Indian</a> | <a href="#">Punjabi Food</a><a href="#">Fast Food</a>                            | <a href="#">Chinese</a> | <a href="#">Street Food</a> | <a href="#">Continental</a> | <a href="#">Mithai</a> | <a href="#">Cafe</a> | <a href="#">South Indian</a> | <a href="#">Punjabi Food</a> | <a href="#">Fast Food</a>                            | <a href="#">Chinese</a> | <a href="#">Street Food</a> | <a href="#">Continental</a> | <a href="#">Mithai</a> | <a href="#">Cafe</a> | <a href="#">South Indian</a> | <a href="#">Punjabi Food</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="pt-4 pb-4 text-center">
        <div class="container">
            <p class="mt-0 mb-0">© Copyright 2019 Osahan Eat. All Rights Reserved</p>
            <small class="mt-0 mb-0"> Made with <i class="fas fa-heart heart-icon text-danger"></i> by
            <a class="text-danger" target="_blank" href="https://www.instagram.com/iamgurdeeposahan/">Gurdeep Osahan</a> - <a class="text-primary" target="_blank" href="https://askbootstrap.com/">Ask Bootstrap</a>
            </small>
        </div>
    </footer>
    <!-- jQuery -->
    <script src="vendor/jquery/jquery-3.3.1.slim.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 JavaScript-->
    <script src="vendor/select2/js/select2.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/custom.js"></script>
</body>

</html>