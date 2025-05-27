<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="shortcut icon" href="images/pc logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="Fonts/css/all.min.css"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
    />
    <title>Prefix - Services</title>
  </head>
  <body>
    <!-- Navbar starts here -->
    <?php include 'includes/navbar.php'; ?>
    <!-- Navbar ends here -->

    <!-- Modal begins here -->
    <?php include 'includes/modals.php'; ?>
    <!-- Modal ends here -->

    <!-- Loader starts here -->
    <div id="loader-wrapper">
      <div class="img"></div>
      <div class="loader"></div>
    </div>
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
    <?php include 'includes/onscrollnavbar.php'; ?>
    <!-- Onscroll Header ends here -->
    <section class="main-wrapper">
      <div class="video-container">
        <video autoplay muted loop playsinline class="bg-video">
          <source
            src="images/istockphoto-980371916-640_adpp_is.mp4"
            type="video/mp4"
          />
          Your browser does not support the video tag.
        </video>

        <div class="content">
          <p><a href="index.php">Home</a> / Services</p>
        </div>
      </div>
      <!-- Ads services starts here -->
      <section class="section-2 Services-section-2" data-aos="fade-up">
        <div class="ads-text">
          <h1>ADS SERVICES</h1>
          <p>
            Page when looking at its layout. The point of using Lorem Ipsum is
            that it has a more-or-less normal distribution of letters, as
            opposed to
          </p>
          <p class="read-more-btn"><a href="#">READ MORE</a></p>
        </div>
        <div class="ads-visuals">
          <div class="ads-con">
            <div class="ads-1">
              <h1>AUTOMATIVE</h1>
              <img src="images/icon-1.png" alt="" />
            </div>
            <div class="ads-1">
              <h1>FASHION</h1>
              <img src="images/icon-2.png" alt="" />
            </div>
          </div>
          <div class="ads-con">
            <div class="ads-1">
              <h1>AUTOMATIVE</h1>
              <img src="images/icon-3.png" alt="" />
            </div>
            <div class="ads-1">
              <h1>FASHION</h1>
              <img src="images/icon-4.png" alt="" />
            </div>
          </div>
        </div>
      </section>
      <!-- Ads services ends here -->
      <!-- Footer starts here -->
      <?php include 'includes/footer.php'; ?>
      <!-- Footer ends here -->
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="script.js"></script>
  </body>
</html>
