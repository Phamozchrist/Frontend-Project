<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/pc logo.png" type="image/x-icon">
    <link rel="stylesheet" href="Fonts/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <title>Prefix</title>
</head>
<body>
    <section class="f-body">
        <!-- Navbar starts here -->
       <?php include 'includes/navbar.php'; ?>
        <!-- Navbar ends here -->

        <!-- Loader starts here -->
        <div id="loader-wrapper">
            <div class="img"></div>
            <div class="loader"></div>
        </div>
        <!-- Loader ends here -->
        <!-- Progess bar starts here -->
        <div id="progress-circle">
            <svg width="80" height="80">
                <circle cx="40" cy="40" r="35" stroke="#ddd" stroke-width="5" fill="none"></circle>
                <circle id="progress" cx="40" cy="40" r="35" stroke="aqua" stroke-width="5" fill="none" stroke-dasharray="220" stroke-dashoffset="220"></circle>
            </svg>
        </div>
        <div class="back-to-top">
            <a href="#"><i class="fa-solid fa-arrow-up"></i></a>
        </div>
        <!-- Progress bar ends here -->
        <!-- Onscroll Header starts here -->
        <?php include 'includes/onscrollnavbar.php'; ?>
        <!-- Onscroll Header ends here -->
        <section class="main-wrapper">
            <!-- Section 1 start here -->
            <section class="section-1">
                <!-- Banner wrapper starts here -->
                <div class="wrapper">
                    <div class="container-1" data-aos="fade-left">
                        <h1>
                            SELL EVERY OLD THINGS &
                            <span>BUY NEW</span> 
                        </h1>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                        
                        <p class="read-more-btn"><a href="#">READ MORE</a></p>
                        <div class="play-button">
                            <img src="images/play-icon.png" alt="" class="play-anime">
                            <img src="images/dark-mode-play-icon.png" alt="" class="play-dark-icon">
                        </div>
                    </div>
                    <div class="container-2">
                        <div class="slider-container" data-aos="fade-right">
                            <div class="slider-track">
                                <div class="slide"><img src="images/banner-img.png" alt=""></div>
                                <div class="slide"><img src="images/banner-img.png" alt=""></div>
                                <div class="slide"><img src="images/banner-img.png" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Banner wrapper ends here -->
            </section>
            <!-- Section 1 ends here -->
            <!-- Search box starts here  -->
            <div class="search-box" data-aos="fade-up">
                <form>
                    <div>
                        <input type="text" placeholder="Enter Keywords">
                    </div>
                    <div>
                        <select name="category" id="category-input">
                            <option value="" selected disabled>All Category</option>
                            <option value="option">Option 1</option>
                            <option value="option">Option 2</option>
                            <option value="option">Option 3</option>
                        </select>
                    </div>
                    <div>
                        <select name="location" id="location-input">
                            <option value="" selected disabled>Your Location</option>
                            <option value="option">Option 1</option>
                            <option value="option">Option 2</option>
                            <option value="option">Option 3</option>
                        </select>
                    </div>
                </form>
                <div class="search-button">
                    <button type="submit">SEARCH NOW</button>
                </div>
            </div>
            <!-- Search box ends here -->
            <!-- Ads services starts here -->
            <section class="section-2"data-aos="fade-up">
                <div class="ads-text">
                    <h1>ADS SERVICES</h1>
                    <p>Page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to</p>
                    <p class="read-more-btn"><a href="#">READ MORE</a></p>
                </div>
                <div class="ads-visuals">
                    <div class="ads-con">
                        <div class="ads-1">
                            <h1>AUTOMATIVE</h1>
                            <img src="images/icon-1.png" alt="">
                        </div>
                        <div class="ads-1">
                            <h1>FASHION</h1>
                            <img src="images/icon-2.png" alt="">
                        </div>
                    </div>
                    <div class="ads-con">
                        <div class="ads-1">
                            <h1>AUTOMATIVE</h1>
                            <img src="images/icon-3.png" alt="">
                        </div>
                        <div class="ads-1">
                            <h1>FASHION</h1>
                            <img src="images/icon-4.png" alt="">
                        </div>
                    </div>
                </div>
            </section>
            <!-- Ads services ends here -->
            <!-- Premium Ads -->
            <section class="section-3" data-aos="fade-up">
                <div class="premium-title">
                    <h1>PREMIUM ADVERTISEMENT</h1>
                </div>
                <div class="slider-container-1">
                    <div class="slider-track-1">
                        <div class="slide-1">
                            <div>
                                <img src="images/blog-img.png" alt="Slide1">
                                <div>
                                <a href="#">Chat Now</a>
                                <a href="#">Call Now</a> 
                                </div>
                                <span>01</span>
                            </div>
                            <div>
                                <img src="images/blog-img1.png" alt="Slide2">
                                <div>
                                    <a href="#">Chat Now</a>
                                    <a href="#">Call Now</a>
                                </div>
                                <span>02</span>
                            </div>
                            <div>
                                <img src="images/blog-img2.png" alt="Slide3">
                                <div>
                                    <a href="#">Chat Now</a>
                                    <a href="#">Call Now</a>
                                </div>
                                <span>03</span>
                            </div>
                        </div>
                        <div class="slide-1">
                            <div>
                                <img src="images/blog-img.png" alt="Slide1">
                                <div>
                                <a href="#">Chat Now</a>
                                <a href="#">Call Now</a> 
                                </div>
                                <span>01</span>
                            </div>
                            <div>
                                <img src="images/blog-img1.png" alt="Slide2">
                                <div>
                                    <a href="#">Chat Now</a>
                                    <a href="#">Call Now</a>
                                </div>
                                <span>02</span>
                            </div>
                            <div>
                                <img src="images/blog-img2.png" alt="Slide3">
                                <div>
                                    <a href="#">Chat Now</a>
                                    <a href="#">Call Now</a>
                                </div>
                                <span>03</span>
                            </div>
                        </div>
                    </div>
                    <div class="slide-nav-2">
                        <i class="fa-solid fa-angle-left prev-btn-1"></i>
                        <i class="fa-solid fa-angle-right next-btn-1"></i>
                    </div>
                </div>
            </section>
            <!-- Premium Ads ends here -->
            <!-- AboutUS starts here -->
            <section class="section-4" data-aos="fade-up">
                <div class="about-us">
                    <div class="about-us-content">
                        <h1>About Us</h1>
                        <p>ARE YOU READY FOR THE POSTING YOUR ADS</p>
                        <div>
                            <a href="#">GET STARTED</a>
                            <a href="#">BUY NOW</a>
                        </div>
                    </div>
                    
                </div>
                <div class="about-img">
                    <img src="images/about-img.png" alt="">
                </div>
            </section>
            <!-- AboutUs ends here -->
            <!-- Pricing Plan starts here-->
            <section class="section-5" data-aos="fade-up">
                <div class="price-title">
                    <h1>FIND A PRICE PLAN</h1>
                </div>
                <div class="price-container">
                    <div class="price-list">
                        <h2>REGULAR</h2>
                        <div>
                            <h3>$</h3>
                            <h1>30</h1>
                            <p>/PER MONTH</p>
                        </div>
                        <ul>
                            <li><i class="fa-solid fa-check"></i> Basic Features</li>
                            <li><i class="fa-solid fa-check"></i> 10GB Storage</li>
                            <li><i class="fa-solid fa-check"></i> Email Support</li>
                            <li><i class="fa-solid fa-xmark"></i> No Custom Domain</li>
                        </ul>   
                        <p class="read-more-btn"><a href="#">READ MORE</a></p>
                        
                    </div>
                    <div class="price-list">
                        <h2>STANDARD</h2>
                        <div>
                            <h3>$</h3>
                            <h1>50</h1>
                            <p>/PER MONTH</p>
                        </div>
                        
                        <ul>
                            <li><i class="fa-solid fa-check"></i> All Regular Features</li>
                            <li><i class="fa-solid fa-check"></i> 50GB Storage</li>
                            <li><i class="fa-solid fa-check"></i> Priority Support</li>
                            <li><i class="fa-solid fa-check"></i> Custom Domain</li>
                        </ul>
                        <p class="read-more-btn"><a href="#">READ MORE</a></p>
                        
                    </div>
                    <div class="price-list">
                        <h2>PREMIUM</h2>
                        <div>
                            <h3>$</h3>
                            <h1>90</h1>
                            <p>/PER MONTH</p>
                        </div>
                        <ul>
                            <li><i class="fa-solid fa-check"></i> All Standard Features</li>
                            <li><i class="fa-solid fa-check"></i> Unlimited Storage</li>
                            <li><i class="fa-solid fa-check"></i> 24/7 Support</li>
                            <li><i class="fa-solid fa-check"></i> Advanced Analytics</li>
                        </ul>
                        <p class="read-more-btn"><a href="#">READ MORE</a></p>
                        
                    </div>
                    
                </div>
            </section>
            <!-- Pricing Plan ends here -->
            <!-- Customer Says starts here -->
            <section class="section-6" data-aos="fade-up">
                <div class="cus-title">
                    <h1>WHAT SAYS OUR CUSTOMERS</h1>
                </div>
                <div class="slider-container-2">
                    <div class="slider-track-2">
                        <div class="slide-2">
                            <p>
                                Has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors
                            </p>
                            <div class="cus-cus">
                                <div class="cus-img">
                                    <img src="images/customer-img.png" alt="">
                                </div>
                                <div class="cus-flex">
                                    <h3>CONTENT</h3>
                                    <p>And web page</p>
                                </div>
                            </div>
                        </div>
                        <div class="cus-container slide-2">
                            <p>
                                Has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors
                            </p>
                            <div class="cus-cus">
                                <div class="cus-img">
                                    <img src="images/customer-img.png" alt="">
                                </div>
                                <div class="cus-flex">
                                    <h3>CONTENT</h3>
                                    <p>And web page</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide-nav-3">
                        <i class="fa-solid fa-angle-left prev-btn-2"></i>
                        <i class="fa-solid fa-angle-right next-btn-2"></i>
                    </div>
                </div>
            </section>
            <!-- Customer says ends here -->
            <!-- Contact Us starts here -->
            <section class="section-7" data-aos="fade-up">
                <div class="contact-container">
                    <div class="contact-title">
                        <h1>CONTACT</h1>
                    </div>
                    <form class="contact-form">
                        <div class="contact-input">
                            <input type="text" name="fullname" placeholder="Your Name" >
                        </div>      
                        <div class="contact-input">
                            <input type="email" name="email" placeholder="Email">
                        </div>                 
                        <div class="contact-textarea">
                            <textarea name="message" id="textarea" placeholder="Message"></textarea>
                        </div>                  
                        <div class="contact-buttons">
                            <button><a href="#">SEND</a></button>
                            <button><a href="#">MAP</a></button>
                        </div>
                    </form>
                </div>
            </section>
            <!-- Contact Us ends here -->
            <!-- Footer starts here -->
             <?php include 'includes/footer.php'; ?>
            <!-- Footer ends here -->
             </section>
    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="script.js"></script>
    <script>
       
    </script>
</body>
</html>