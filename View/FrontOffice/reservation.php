<?php
session_start();

// Example vet id – in real app this comes from vet profile page or selection
$vetId = 1;

// Fake logged-in pet owner for demo
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 2;
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Petpal - Book Appointment</title>
    <meta name="description" content="Petpal - Pet Care and Pet Shop HTML Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Template CSS -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/flaticon_pet_care.css">
    <link rel="stylesheet" href="assets/css/odometer.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/aos.css">
    <link rel="stylesheet" href="assets/css/default.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <!-- NEW reservation CSS -->
    <link rel="stylesheet" href="assets/css/reservation.css">
</head>

<body>

    <!--Preloader-->
    <div id="preloader">
      <div id="loader" class="loader">
        <div class="loader-container">
          <div class="loader-icon">
            <img src="assets/img/logo/preloader.svg" alt="Preloader" />
          </div>
        </div>
      </div>
    </div>
    <!--Preloader-end -->

    <!-- Scroll-top -->
    <button class="scroll__top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>

    
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
                    <div
                      class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex"
                    >
                      <ul class="navigation">
                        <li class="menu-item-has-children">
                          <a href="#">Home</a>
                          <ul class="sub-menu">
                            <li>
                              <a href="index.html">Pet Care & Veterinary</a>
                            </li>
                            <li><a href="index-2.html">Pet Breed</a></li>
                            <li><a href="index-3.html">Pet Adopt</a></li>
                            <li><a href="index-4.html">pet Woocommerce</a></li>
                          </ul>
                        </li>
                        <li><a href="about.html">About</a></li>
                        <li class="menu-item-has-children">
                          <a href="#">Shop</a>
                          <ul class="sub-menu">
                            <li><a href="product.html">Our Shop</a></li>
                            <li>
                              <a href="product-details.html">Shop Details</a>
                            </li>
                          </ul>
                        </li>
                        <li class="active menu-item-has-children">
                          <a href="#">Pages</a>
                          <ul class="sub-menu">
                            <li><a href="animal.html">All Pets</a></li>
                            <li>
                              <a href="animal-details.html">Pet Details</a>
                            </li>
                            <li><a href="gallery.html">Gallery</a></li>
                            <li><a href="faq.html">Faq Page</a></li>
                            <li><a href="pricing.html">Pricing Page</a></li>
                            <li class="active">
                              <a href="reservation.php  ">Reservation Page</a>
                            </li>
                            <li><a href="team.html">Our Team</a></li>
                            <li>
                              <a href="team-details.html">Team Details</a>
                            </li>
                            <li><a href="blog.html">Our Blog</a></li>
                            <li>
                              <a href="blog-details.html">Blog Details</a>
                            </li>
                            <li><a href="error.html">404 Error Page</a></li>
                          </ul>
                        </li>
                        <li><a href="contact.html">contacts</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-xl-2 col-md-4">
                    <div class="logo text-center">
                      <a href="index.html"
                        ><img src="assets/img/logo/w_logo.png" alt="Logo"
                      /></a>
                    </div>
                  </div>
                  <div class="col-xl-5 col-md-8">
                    <div
                      class="tgmenu__action tgmenu__action-two d-none d-md-block"
                    >
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
                        <li class="header-btn login-btn">
                          <a href="contact.html" class="btn"
                            ><i class="flaticon-locked"></i>Login</a
                          >
                        </li>
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
                    <a href="index.html"
                      ><img src="assets/img/logo/logo.png" alt="Logo"
                    /></a>
                  </div>
                  <div class="tgmobile__search">
                    <form action="#">
                      <input type="text" placeholder="Search here..." />
                      <button><i class="fas fa-search"></i></button>
                    </form>
                  </div>
                  <div class="tgmobile__menu-outer">
                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                  </div>
                  <div class="social-links">
                    <ul class="list-wrap">
                      <li>
                        <a href="https://www.facebook.com/" target="_blank"
                          ><i class="fab fa-facebook-f"></i
                        ></a>
                      </li>
                      <li>
                        <a href="https://twitter.com" target="_blank"
                          ><i class="fab fa-twitter"></i
                        ></a>
                      </li>
                      <li>
                        <a href="https://www.whatsapp.com/" target="_blank"
                          ><i class="fab fa-whatsapp"></i
                        ></a>
                      </li>
                      <li>
                        <a href="https://www.instagram.com/" target="_blank"
                          ><i class="fab fa-instagram"></i
                        ></a>
                      </li>
                      <li>
                        <a href="https://www.youtube.com/" target="_blank"
                          ><i class="fab fa-youtube"></i
                        ></a>
                      </li>
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
                    <svg
                      width="18"
                      height="18"
                      viewBox="0 0 18 18"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M17 1L1 17"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      ></path>
                      <path
                        d="M1 1L17 17"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      ></path>
                    </svg>
                  </button>
                </div>
                <div class="search__form">
                  <form action="#">
                    <div class="search__input">
                      <input
                        class="search-input-field"
                        type="text"
                        placeholder="Type keywords here"
                      />
                      <span class="search-focus-border"></span>
                      <button>
                        <svg
                          width="20"
                          height="20"
                          viewBox="0 0 20 20"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          ></path>
                          <path
                            d="M19.0002 19.0002L17.2002 17.2002"
                            stroke="currentcolor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          ></path>
                        </svg>
                      </button>
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
                            <img src="assets/img/images/breadcrumb_img.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- registration-area -->
        <section class="registration__area-two">
            <div class="container">
                <div class="registration__inner-wrap-two">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="registration__form-wrap">

                                <!-- FORM START -->
                                <form action="app/controllers/AppointmentController.php?action=store"
                                      method="POST"
                                      id="appointmentForm"
                                      class="registration__form">

                                    <h3 class="title">Request a Schedule</h3>
                                    <span>Your email address will not be published. Required fields are marked *</span>

                                    <!-- Hidden -->
                                    <input type="hidden" name="vet_id" value="<?php echo $vetId; ?>">
                                    <input type="hidden" name="appointment_date" id="appointment_date">
                                    <input type="hidden" name="timeslot_id" id="timeslot_id">

                                    <div class="row gutter-20">

                                        <!-- Full name -->
                                        <div class="col-md-6">
                                            <div class="form-grp">
                                                <label>Full Name *</label>
                                                <input type="text" name="patient_name" id="patient_name" placeholder="Your full name">
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="col-md-6">
                                            <div class="form-grp">
                                                <label>Phone Number *</label>
                                                <input type="text" name="patient_phone" id="patient_phone" placeholder="+216 00 000 000">
                                            </div>
                                        </div>

                                        <!-- Species -->
                                        <div class="col-md-6">
                                            <div class="form-grp select-grp">
                                                <label>Animal Type *</label>
                                                <select name="species" id="species" class="orderby">
                                                    <option value="">Select species</option>
                                                    <option>Dog</option>
                                                    <option>Cat</option>
                                                    <option>Bird</option>
                                                    <option>Small Mammal</option>
                                                    <option>Reptile</option>
                                                    <option>Fish</option>
                                                    <option>Cow</option>
                                                    <option>Sheep</option>
                                                    <option>Goat</option>
                                                    <option>Pig</option>
                                                    <option>Chicken</option>
                                                    <option>Horse</option>
                                                    <option>Duck</option>
                                                    <option>Rabbit</option>
                                                    <option>Bee</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- First visit -->
                                        <div class="col-md-6">
                                            <div class="form-grp">
                                                <label>First time visiting this vet? *</label><br>
                                                <label><input type="radio" name="first_visit" value="1"> Yes</label>
                                                <label style="margin-left: 15px;">
                                                    <input type="radio" name="first_visit" value="0" checked> No
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Emergency -->
                                        <div class="col-md-6">
                                            <div class="form-grp">
                                                <label>Is it an emergency? *</label><br>
                                                <label><input type="radio" name="is_emergency" value="1"> Yes</label>
                                                <label style="margin-left: 15px;">
                                                    <input type="radio" name="is_emergency" value="0" checked> No
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Notify earlier -->
                                        <div class="col-md-6">
                                            <div class="form-grp">
                                                <label>
                                                    <input type="checkbox" name="notify_if_earlier" value="1">
                                                    Notify me if an earlier slot becomes free
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Reason -->
                                        <div class="col-md-12">
                                            <div class="form-grp">
                                                <label>Reason for appointment *</label>
                                                <textarea name="visit_reason" id="visit_reason" placeholder="Describe the problem..."></textarea>
                                            </div>
                                        </div>

                                        <!-- Calendar -->
                                        <div class="col-md-12">
                                            <div class="form-grp">
                                                <label>Select date *</label>
                                                <div id="date-strip" class="date-strip"></div>
                                            </div>
                                        </div>

                                        <!-- Timeslots -->
                                        <div class="col-md-12">
                                            <div class="form-grp">
                                                <label>Select time slot *</label>

                                                <div class="timeslot-group">
                                                    <h5>Morning Slots</h5>
                                                    <div id="morning-slots" class="slots-row"></div>
                                                </div>

                                                <div class="timeslot-group">
                                                    <h5>Afternoon Slots</h5>
                                                    <div id="afternoon-slots" class="slots-row"></div>
                                                </div>

                                                <div class="timeslot-group">
                                                    <h5>Evening Slots</h5>
                                                    <div id="evening-slots" class="slots-row"></div>
                                                </div>

                                                <p id="slot-helper" class="slot-helper">
                                                    Choose a date to see available slots.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn">
                                        Confirm Appointment
                                        <img src="assets/img/icon/right_arrow.svg" alt="" class="injectable">
                                    </button>

                                </form>
                                <!-- END FORM -->

                            </div>
                        </div>

                        <!-- Image -->
                        <div class="col-lg-4">
                            <div class="registration__img">
                                <img src="assets/img/images/registration_img.png" alt="">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER (unchanged) -->
    <footer>
        <!-- (Same footer as your template) -->
    </footer>

    <!-- Scripts -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/svg-inject.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!-- Calendar & Timeslot Logic -->
    <script>
        /* SAME JS YOU ALREADY HAD — cleaned and kept outside CSS */
        function generateDateStrip() {
            var strip = document.getElementById('date-strip');
            var today = new Date();

            for (var i = 0; i < 7; i++) {
                var d = new Date();
                d.setDate(today.getDate() + i);

                var item = document.createElement('div');
                item.className = 'date-item';
                item.setAttribute('data-date', d.toISOString().slice(0, 10));
                item.innerHTML =
                    '<div>' + d.toLocaleDateString('en-US', { weekday: 'short' }) +
                    '</div><div>' + d.getDate() + ' ' + d.toLocaleDateString('en-US', { month: 'short' }) +
                    '</div>';
                item.onclick = function () { selectDate(this); };
                strip.appendChild(item);
            }
        }

        function selectDate(el) {
            document.querySelectorAll('.date-item').forEach(e => e.classList.remove('selected'));
            el.classList.add('selected');
            document.getElementById('appointment_date').value = el.getAttribute('data-date');
            loadTimeSlots(el.getAttribute('data-date'));
        }

        function loadTimeSlots(date) {
            clearSlots();

            var xhr = new XMLHttpRequest();
            xhr.open(
                'GET',
                'app/controllers/TimeslotController.php?action=byDate&vet_id=<?php echo $vetId; ?>&date=' + date,
                true
            );
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var slots = JSON.parse(xhr.responseText);
                    renderSlots(slots);
                }
            };
            xhr.send();
        }

        function clearSlots() {
            document.getElementById('morning-slots').innerHTML = '';
            document.getElementById('afternoon-slots').innerHTML = '';
            document.getElementById('evening-slots').innerHTML = '';
            document.getElementById('slot-helper').innerHTML = 'Select a time slot.';
        }

        function renderSlots(slots) {
            if (!slots || slots.length === 0) {
                document.getElementById('slot-helper').innerHTML = 'No slots available.';
                return;
            }

            slots.forEach(s => {
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'slot-btn';
                btn.innerHTML = s.start_time + ' - ' + s.end_time;
                btn.dataset.id = s.id;

                if (s.status === 'booked' || s.is_available == 0) {
                    btn.classList.add('booked');
                    btn.disabled = true;
                } else {
                    btn.onclick = () => selectSlot(btn);
                }

                if (s.period === 'morning') document.getElementById('morning-slots').appendChild(btn);
                if (s.period === 'afternoon') document.getElementById('afternoon-slots').appendChild(btn);
                if (s.period === 'evening') document.getElementById('evening-slots').appendChild(btn);
            });
        }

        function selectSlot(btn) {
            document.querySelectorAll('.slot-btn').forEach(e => e.classList.remove('selected'));
            btn.classList.add('selected');
            document.getElementById('timeslot_id').value = btn.dataset.id;
        }

        // Validation
        document.getElementById('appointmentForm').onsubmit = function (e) {
            var errors = [];

            if (!patient_name.value) errors.push("Full name is required");
            if (!patient_phone.value) errors.push("Phone number is required");
            if (!species.value) errors.push("Species is required");
            if (!visit_reason.value) errors.push("Reason is required");
            if (!appointment_date.value) errors.push("Date is required");
            if (!timeslot_id.value) errors.push("Time slot is required");

            if (errors.length > 0) {
                alert(errors.join("\n"));
                e.preventDefault();
            }
        };

        generateDateStrip();
    </script>

</body>

</html>
