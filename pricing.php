<!DOCTYPE html>
<html lang="en" loading="lazy">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/style.css" />
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="Fonts/css/all.min.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
    />
    <title>Prefix - Pricing</title>
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
    <!-- Onscroll header  -->
    <?php include 'includes/onscrollnavbar.php'; ?>
    <!-- Onscroll header ends here -->
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
            <span>/ Shop</span> / Pricing Plan
          </p>
        </div>
      </div>
      <!-- Pricing Plan starts here-->
      <section class="section-5 Pricing-section-5" data-aos="fade-up">
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
      <!-- Footer starts here -->
      <?php include 'includes/footer.php'; ?>
      <!-- Footer ends here -->
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="javascript/script.js"></script>
  </body>
</html>
