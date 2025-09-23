<!DOCTYPE html>
<html lang="en" loading="lazy">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/style.css" />
    <link rel="shortcut icon" href="images/pc logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="fonts/css/all.min.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
    />
    <title>Prefix - Other Products</title>
  </head>
  <body>
    <!-- Navbar starts here -->
    <?php include_once 'includes/navbar.php'; ?>
    <!-- Navbar ends here -->
     
    <!-- Loader starts here -->
    <?php include_once 'includes/loader.php';?>
    <!-- Loader ends here -->
    <!-- Progess bar starts here -->
    <div id="progress-circle">
      <svg width="80" height="80">
        <circle
          cx="40"
          cy="40"
          r="35"
          stroke="#ddd"
          stroke-width="5"
          fill="none"
        ></circle>
        <circle
          id="progress"
          cx="40"
          cy="40"
          r="35"
          stroke="aqua"
          stroke-width="5"
          fill="none"
          stroke-dasharray="220"
          stroke-dashoffset="220"
        ></circle>
      </svg>
    </div>
    <div class="back-to-top">
      <a href="#"><i class="fa-solid fa-arrow-up"></i></a>
    </div>
    <!-- Progress bar ends here -->
    <!-- Onscroll Header starts here -->
    <?php include_once 'includes/onscrollnavbar.php'; ?>
    <!-- Onscroll Header ends here -->
    <section class="main-wrapper">
      <div class="video-container">
        <video autoplay muted loop playsinline class="bg-video">
          <source
            src="../images/istockphoto-980371916-640_adpp_is.mp4"
            type="video/mp4"
          />
          Your browser does not support the video tag.
        </video>

        <div class="content">
          <p>
            <a href="index.php">Home</a>
            <span>/ Shop</span> / Other Products
          </p>
        </div>
      </div>
      <!-- Other Products starts here -->
      <!-- Premium Ads starts here -->
      <section class="section-3 products-section-3" data-aos="fade-up">
        <div class="premium-title">
          <h1>PREMIUM ADVERTISEMENT</h1>
        </div>
        <div class="slider-container-1">
          <div class="slider-track-1">
            <div class="slide-1">
              <div>
                <img src="../images/blog-img.png" alt="Slide1" />
                <div>
                  <a href="#">Chat Now</a>
                  <a href="#">Call Now</a>
                </div>
                <span>01</span>
              </div>
              <div>
                <img src="../images/blog-img1.png" alt="Slide2" />
                <div>
                  <a href="#">Chat Now</a>
                  <a href="#">Call Now</a>
                </div>
                <span>02</span>
              </div>
              <div>
                <img src="../images/blog-img2.png" alt="Slide3" />
                <div>
                  <a href="#">Chat Now</a>
                  <a href="#">Call Now</a>
                </div>
                <span>03</span>
              </div>
            </div>
            <div class="slide-1">
              <div>
                <img src="../images/blog-img.png" alt="Slide1" />
                <div>
                  <a href="#">Chat Now</a>
                  <a href="#">Call Now</a>
                </div>
                <span>01</span>
              </div>
              <div>
                <img src="../images/blog-img1.png" alt="Slide2" />
                <div>
                  <a href="#">Chat Now</a>
                  <a href="#">Call Now</a>
                </div>
                <span>02</span>
              </div>
              <div>
                <img src="../images/blog-img2.png" alt="Slide3" />
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
      <!-- Other Products ends here -->
      <!-- Footer starts here -->
      <?php include_once 'includes/footer.php'; ?>
      <!-- Footer ends here -->
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="javascript/script.js"></script>
  </body>
</html>
