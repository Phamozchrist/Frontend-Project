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
    <title>Prefix - About-us</title>
    <style></style>
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
    <!-- Onscroll header starts here -->
    <?php include_once 'includes/onscrollnavbar.php'; ?>
    <!-- Onscroll header ends here -->
    <section class="main-wrapper">
      <div class="video-container">
        <video autoplay muted loop playsinline class="bg-video" loading="lazy" >
          <source
            src="images/istockphoto-980371916-640_adpp_is.mp4"
            type="video/mp4"
          />
          Your browser does not support the video tag.
        </video>
        <div class="content">
          <p><a href="index.php">Home</a> / About</p>
        </div>
      </div>
      <!-- AboutUS starts here -->
      <section class="section-4 About-us-section-4" data-aos="fade-up">
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
          <img src="images/about-img.png" alt="" />
        </div>
      </section>
      <!-- AboutUs ends here -->
      <!-- Footer starts here -->
      <?php include_once 'includes/footer.php'; ?>
      <!-- Footer ends here -->
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="javascript/script.js"></script>
  </body>
</html>
