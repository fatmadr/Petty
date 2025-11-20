<?php
if (!isset($_SESSION)) session_start();
if (!isset($appointment)) die("Not found");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Appointment</title>
    <link rel="stylesheet" href="/petty/View/FrontOffice/assets/css/reservation.css">

     <link rel="shortcut icon" type="image/x-icon" href="/petty/View/FrontOffice/assets/img/favicon.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="/petty/View/FrontOffice/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/petty/View/FrontOffice/assets/css/animate.min.css">
    <link rel="stylesheet" href="/petty/View/FrontOffice/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/petty/View/FrontOffice/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/petty/View/FrontOffice/assets/css/flaticon_pet_care.css">
    <link rel="stylesheet" href="/petty/View/FrontOffice/assets/css/odometer.css">
    <link rel="stylesheet" href="/petty/View/FrontOffice/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/petty/View/FrontOffice/assets/css/select2.min.css">
    <link rel="stylesheet" href="/petty/View/FrontOffice/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="/petty/View/FrontOffice/assets/css/aos.css">
    <link rel="stylesheet" href="/petty/View/FrontOffice/assets/css/default.css">
    <link rel="stylesheet" href="/petty/View/FrontOffice/assets/css/main.css">
    
</head>

<body>

<!--Preloader-->
    <div id="preloader">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="/petty/View/FrontOffice/assets/img/logo/preloader.svg" alt="Preloader"></div>
            </div>
        </div>
    </div>
    <!--Preloader-end -->

    <!-- Scroll-top -->
    <button class="scroll__top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    <header>
        <div id="header-fixed-height"></div>
        <div id="sticky-header" class="tg-header__area tg-header__area-three">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tgmenu__wrap">
                            <div class="row align-items-center">
                                <div class="col-xl-5">
                                    <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex">
                                        <ul class="navigation">
                                            <li class="menu-item-has-children"><a href="#">Home</a>
                                                <ul class="sub-menu">
                                                    <li><a href="index.html">Pet Care & Veterinary</a></li>
                                                    <li><a href="index-2.html">Pet Breed</a></li>
                                                    <li><a href="index-3.html">Pet Adopt</a></li>
                                                    <li><a href="index-4.html">pet Woocommerce</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="about.html">About</a></li>
                                            <li class="menu-item-has-children"><a href="#">Shop</a>
                                                <ul class="sub-menu">
                                                    <li><a href="product.html">Our Shop</a></li>
                                                    <li><a href="product-details.html">Shop Details</a></li>
                                                </ul>
                                            </li>
                                            <li class="active menu-item-has-children"><a href="#">Pages</a>
                                                <ul class="sub-menu">
                                                    <li><a href="animal.html">All Pets</a></li>
                                                    <li><a href="animal-details.html">Pet Details</a></li>
                                                    <li><a href="gallery.html">Gallery</a></li>
                                                    <li><a href="faq.html">Faq Page</a></li>
                                                    <li><a href="pricing.html">Pricing Page</a></li>
                                                    <li class="active"><a href="reservation.php">Reservation Page</a></li>
                                                    <li><a href="team.html">Our Team</a></li>
                                                    <li><a href="team-details.html">Team Details</a></li>
                                                    <li><a href="blog.html">Our Blog</a></li>
                                                    <li><a href="blog-details.html">Blog Details</a></li>
                                                    <li><a href="error.html">404 Error Page</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contact.html">contacts</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-4">
                                    <div class="logo text-center">
                                        <a href="index.html"><img src="/petty/View/FrontOffice/assets/img/logo/w_logo.png" alt="Logo"></a>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-md-8">
                                    <div class="tgmenu__action tgmenu__action-two d-none d-md-block">
                                        <ul class="list-wrap">
                                            <li class="header-search">
                                                <a href="javascript:void(0)" class="search-open-btn">
                                                    <i class="flaticon-loupe"></i>
                                                </a>
                                            </li>
                                            <li class="header-cart">
                                                <a href="javascript:void(0)">
                                                    <i class="flaticon-shopping-bag"></i>
                                                    <span>0</span>
                                                </a>
                                            </li>
                                            <li class="header-btn login-btn"><a href="contact.html" class="btn"><i
                                                        class="flaticon-locked"></i>Login</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mobile-nav-toggler">
                                <i class="flaticon-layout"></i>
                            </div>
                        </div>

                        <!-- Mobile Menu  -->
                        <div class="tgmobile__menu">
                            <nav class="tgmobile__menu-box">
                                <div class="close-btn"><i class="fas fa-times"></i></div>
                                <div class="nav-logo">
                                    <a href="index.html"><img src="/petty/View/FrontOffice/assets/img/logo/logo.png" alt="Logo"></a>
                                </div>
                                <div class="tgmobile__search">
                                    <form action="#">
                                        <input type="text" placeholder="Search here...">
                                        <button><i class="fas fa-search"></i></button>
                                    </form>
                                </div>
                                <div class="tgmobile__menu-outer"></div>
                                <div class="social-links">
                                    <ul class="list-wrap">
                                        <li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="https://www.whatsapp.com/" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                        <li><a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="tgmobile__menu-backdrop"></div>
                        <!-- End Mobile Menu -->
                    </div>
                </div>
            </div>
        </div>

        <!-- header-search -->
        <div class="search__popup">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="search__wrapper">
                            <div class="search__close">
                                <button type="button" class="search-close-btn">
                                    ✕
                                </button>
                            </div>
                            <div class="search__form">
                                <form action="#">
                                    <div class="search__input">
                                        <input class="search-input-field" type="text" placeholder="Type keywords here">
                                        <span class="search-focus-border"></span>
                                        <button>Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-popup-overlay"></div>
        <!-- header-search-end -->

    </header>
    <!-- header-area-end -->

     <!-- main-area -->
    <main class="fix">

        <!-- breadcrumb-area -->
        <section class="breadcrumb__area fix">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="breadcrumb__content">
                            <h3 class="title">Book your Slot</h3>
                            <nav class="breadcrumb">
                                <span><a href="index.html">Home</a></span>
                                <span class="breadcrumb-separator"><i class="flaticon-right-arrow-angle"></i></span>
                                <span>Reservation</span>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="breadcrumb__img">
                            <img src="/petty/View/FrontOffice/assets/img/images/breadcrumb_img.png" alt="img" data-aos="fade-left" data-aos-delay="800">
                        </div>
                    </div>
                </div>
            </div>
            <div class="breadcrumb__shape-wrap">
                <img src="/petty/View/FrontOffice/assets/img/images/breadcrumb_shape01.png" alt="img" data-aos="fade-down-right" data-aos-delay="400">
                <img src="/petty/View/FrontOffice/assets/img/images/breadcrumb_shape02.png" alt="img" data-aos="fade-up-left" data-aos-delay="400">
            </div>
        </section>
        <!-- breadcrumb-area-end -->

<div class="appointments-container">

    <h2 class="appointments-title">Edit Appointment</h2>

    <form action="/petty/Controllers/appointmentcontroller.php?action=update" method="POST" class="edit-form">

        <input type="hidden" name="appointment_id" value="<?= $appointment['appointment_id'] ?>">

        <label>New Date *</label>
        <input type="date" name="appointment_date" value="<?= $appointment['appointment_date'] ?>" required>

        <label>New Time *</label>
        <input type="time" name="appointment_time" value="<?= $appointment['appointment_time'] ?>" required>

        <label>Reason *</label>
        <select name="visit_reason" required class="select-input">
            <?php
            $reasons = [
                "Check-up / Wellness",
                "Vaccination",
                "Skin or Ear Issue",
                "Digestive Issue",
                "Injury",
                "Pain / Limping",
                "Follow-up",
                "Surgery Consultation",
                "Dental Care",
                "Other"
            ];
            foreach ($reasons as $reason) {
                $selected = ($appointment['visit_reason'] === $reason) ? "selected" : "";
                echo "<option value=\"$reason\" $selected>$reason</option>";
            }
            ?>
        </select>


        <button type="submit" class="appt-btn-edit">Save Changes</button>
    </form>

    <a href="/petty/Controllers/appointmentcontroller.php?action=index" class="appointments-back-btn">← Back to list</a>


</div>


<!--integration reservation.php template-->
 <!-- footer-area -->
    <footer>
        <div class="footer__area">
            <div class="footer__newsletter-three">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="footer__newsletter-content">
                                <h2 class="title">Sign Up For Newsletter!</h2>
                            </div>
                        </div>
                        
                        <div class="col-lg-7">
                            <form action="#" class="footer__newsletter-form-two">
                                <input type="email" placeholder="Type Your E-mail">
                                <button type="submit">Subscribe <img src="/petty/View/FrontOffice/assets/img/icon/right_arrow04.svg" alt="" class="injectable"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__top footer__top-three fix">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="footer__widget">
                                <div class="footer__logo">
                                    <a href="index.html"><img src="/petty/View/FrontOffice/assets/img/logo/w_logo.png" alt=""></a>
                                </div>
                                <div class="footer__content footer__content-two">
                                    <p>Duis aute irure dolor in repreerit in voluptate velitesse We understand that your furry friend tred member</p>
                                </div>
                                <div class="footer__social">
                                    <h6 class="title">Follow Us On:</h6>
                                    <ul class="list-wrap">
                                        <li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="https://www.whatsapp.com/" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                        <li><a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="footer__widget">
                                <h4 class="footer__widget-title">Quick Links</h4>
                                <div class="footer__link">
                                    <ul class="list-wrap">
                                        <li><a href="animal.html">Animal Rescue</a></li>
                                        <li><a href="contact.html">Humane Education</a></li>
                                        <li><a href="contact.html">Caregivers</a></li>
                                        <li><a href="blog.html">New & Blog</a></li>
                                        <li><a href="gallery.html">Gallery</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="footer__widget">
                                <h4 class="footer__widget-title">Support</h4>
                                <div class="footer__link">
                                    <ul class="list-wrap">
                                        <li><a href="about.html">About us</a></li>
                                        <li><a href="contact.html">Contact us</a></li>
                                        <li><a href="reservation.php">Book Appointment</a></li>
                                        <li><a href="faq.html">FAQ</a></li>
                                        <li><a href="contact.html">Locations</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="footer__widget">
                                <h4 class="footer__widget-title">Contact</h4>
                                <div class="footer__contact">
                                    <ul class="list-wrap">
                                        <li>555 A, East Manster Street, Ready Halley Neon, Uk 4512</li>
                                        <li><a href="tel:0123456789">+00 123 45678 44</a></li>
                                        <li><a href="mailto:Supportinfo@gmail.com">Supportinfo@gmail.com</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer__shape-wrap">
                    <img src="/petty/View/FrontOffice/assets/img/images/footer_shape01.png" alt="img" data-aos="fade-up-right" data-aos-delay="400">
                    <img src="/petty/View/FrontOffice/assets/img/images/footer_shape02.png" alt="img" data-aos="fade-up-left" data-aos-delay="400">
                </div>
            </div>
            <div class="footer__bottom footer__bottom-two">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="copyright-text copyright-text-three">
                                <p>Copyright © 2024. All Rights Reserved.</p>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="footer__bottom-menu footer__bottom-menu-two">
                                <ul class="list-wrap">
                                    <li><a href="contact.html">Support</a></li>
                                    <li><a href="contact.html">Terms & Conditions</a></li>
                                    <li><a href="contact.html">Privacy Policy</a></li>
                                    <li><a href="contact.html">Career</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-area-end -->

    <!-- JS here -->
    <script src="/petty/View/FrontOffice/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="/petty/View/FrontOffice/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/petty/View/FrontOffice/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/petty/View/FrontOffice/assets/js/jquery.odometer.min.js"></script>
    <script src="/petty/View/FrontOffice/assets/js/jquery.appear.js"></script>
    <script src="/petty/View/FrontOffice/assets/js/swiper-bundle.min.js"></script>
    <script src="/petty/View/FrontOffice/assets/js/jquery.countdown.min.js"></script>
    <script src="/petty/View/FrontOffice/assets/js/svg-inject.min.js"></script>
    <script src="/petty/View/FrontOffice/assets/js/select2.min.js"></script>
    <script src="/petty/View/FrontOffice/assets/js/jquery-ui.min.js"></script>
    <script src="/petty/View/FrontOffice/assets/js/ajax-form.js"></script>
    <script src="/petty/View/FrontOffice/assets/js/wow.min.js"></script>
    <script src="/petty/View/FrontOffice/assets/js/aos.js"></script>
    <script src="/petty/View/FrontOffice/assets/js/main.js"></script>
    <!-- Your reservation logic -->
    <script src="/petty/View/FrontOffice/assets/js/reservation.js"></script>
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>


</body>
</html>
