<?php 
require_once 'includes/verify_script.php'; 
// Fetch expiry time from database for this user
$email = $_SESSION['verify_email'];
$stmt = $connect->prepare("SELECT verification_code_expires FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

// If no expiry found, fallback to 0 (expired)
$expiryTimestamp = $row ? strtotime($row['verification_code_expires']) * 1000 : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Verification | Prefix</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body { background: #f5f7fa; display: flex; align-items: center; justify-content: center; height: 100vh; }
    .card { border-radius: 15px; box-shadow: 0 6px 20px rgba(0,0,0,0.1); }
    .verification-inputs input {
      width: 50px; height: 60px; text-align: center; font-size: 1.5rem;
      margin: 0 5px; border-radius: 8px;
    }
    .btn-verify {
      background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
      border: none;
      padding: 15px;
      font-size: 1.1rem;
      font-weight: bold;
      border-radius: 8px;
      width: 100%;
      border: 1px solid red;
      margin-top: 10px;
    }
    
    .btn-verify:hover {
      background: linear-gradient(45deg, var(--secondary-color), var(--primary-color));
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
    }
    .countdown { font-weight: bold; color: #e74c3c; }
  </style>
</head>
<body>
  <div class="container">
    <div class="card p-4 col-md-6 mx-auto">
      <h3 class="text-center mb-3"><i class="fas fa-envelope"></i> Verify Your Email</h3>

      <!-- Alerts -->
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center">
                <?= $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success text-center">
                <?= $_SESSION['success']; ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>


      <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success text-center"><?= $_SESSION['success']; ?></div>
        <?php unset($_SESSION['success']); ?>
      <?php endif; ?>

      <p class="text-muted text-center">We sent a 6-digit code to <strong><?= $_SESSION['verify_email'] ?? '' ?></strong></p>

      <!-- Countdown -->
      <div class="countdown text-center mb-3">
        <i class="fas fa-clock"></i> Code expires in: <span id="timer">15:00</span>
      </div>

      <!-- Verification Form -->
      <form id="emailVerificationForm" method="post">
        <div class="d-flex justify-content-between mb-3" style="gap:10px;">
          <input type="text" class="form-control text-center code-input" maxlength="1" name="code[]" required>
          <input type="text" class="form-control text-center code-input" maxlength="1" name="code[]" required>
          <input type="text" class="form-control text-center code-input" maxlength="1" name="code[]" required>
          <input type="text" class="form-control text-center code-input" maxlength="1" name="code[]" required>
          <input type="text" class="form-control text-center code-input" maxlength="1" name="code[]" required>
          <input type="text" class="form-control text-center code-input" maxlength="1" name="code[]" required>
        </div>

        <button type="submit" class="btn btn-verify" name="verify_code">
          <i class="fas fa-check-circle me-1"></i> Verify Email
        </button>
      </form>


      <!-- Resend -->
      <div class="text-center mt-3">
        <form method="POST">
          <button type="submit" name="resend_code" class="btn btn-outline-secondary">
            <i class="fas fa-paper-plane"></i> Resend Code
          </button>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Expiry timestamp injected from PHP
    const expiryTime = <?php echo $expiryTimestamp; ?>;
    const timerEl = document.getElementById("timer");

    // Timer logic
    function updateTimer() {
      const now = new Date().getTime();
      const distance = expiryTime - now;

      if (distance > 0) {
        const min = Math.floor((distance / 1000) / 60);
        const sec = Math.floor((distance / 1000) % 60);
        timerEl.textContent = `${String(min).padStart(2,'0')}:${String(sec).padStart(2,'0')}`;
        setTimeout(updateTimer, 1000);
      } else {
        timerEl.textContent = "Expired!";
        timerEl.classList.add("text-danger");
      }
    }
    updateTimer();

    // Verification code inputs
    const inputs = document.querySelectorAll(".code-input");

    inputs.forEach((input, index) => {
      // Auto move
      input.addEventListener("input", () => {
        if (input.value.length === 1 && index < inputs.length - 1) {
          inputs[index + 1].focus();
        }
      });

      // Backspace move back
      input.addEventListener("keydown", (e) => {
        if (e.key === "Backspace" && input.value === "" && index > 0) {
          inputs[index - 1].focus();
        }
      });

      // Paste entire code
      input.addEventListener("paste", (e) => {
        e.preventDefault();
        const paste = (e.clipboardData || window.clipboardData).getData("text").trim();
        if (/^\d{6}$/.test(paste)) { // 6 digits only
          paste.split("").forEach((char, i) => {
            if (inputs[i]) inputs[i].value = char;
          });
          inputs[inputs.length - 1].focus();
        }
      });
    });
  </script>

</body>
</html>
