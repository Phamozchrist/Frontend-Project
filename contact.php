<!DOCTYPE html>
<html lang="en">
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
    <title>Prefix</title>
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
        <video autoplay muted loop playsinline class="bg-video" loading="lazy">
          <source
            src="images/istockphoto-980371916-640_adpp_is.mp4"
            type="video/mp4"
          />
          Your browser does not support the video tag.
        </video>

        <div class="content">
          <p><a href="index.php">Home</a> / Contact Us</p>
        </div>
      </div>
      <!-- Contact Us starts here -->
      <section class="section-7" data-aos="fade-up">
        <div class="contact-container">
          <div class="contact-title">
            <h1>CONTACT</h1>
          </div>
          <form class="contact-form">
            <div class="contact-input">
              <input type="text" name="fullname" placeholder="Your Name" />
            </div>
            <div class="contact-input">
              <input type="email" name="email" placeholder="Email" />
            </div>
            <div class="contact-textarea">
              <textarea
                name="message"
                id="textarea"
                placeholder="Message"
              ></textarea>
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
      <?php include_once 'includes/footer.php'; ?>
      <!-- Footer ends here -->
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="javascriptscript.js"></script>
  </body>
</html>
