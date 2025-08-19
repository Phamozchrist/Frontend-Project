# Project: User Profile Page with Cover (PHP + MySQL)

This is a minimal, production‑ready starter that lets a logged‑in user view and update their **profile picture**, **cover photo**, and **basic info** (name, bio). It also includes headers to prevent cached access after logout (fixes the back‑button issue you mentioned).

> Folder structure (you can copy these into your project root):

```
/ (project root)
├─ config.php
├─ helpers.php
├─ middleware_auth.php
├─ profile.php
├─ update_profile.php           # handles name/bio updates
├─ update_media.php             # handles profile/cover uploads
├─ logout.php                   # destroys session and prevents back cache
├─ uploads/                     # auto-created; stores user images
└─ schema.sql
```

---

## schema.sql (MySQL)

```sql
CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  bio VARCHAR(255) DEFAULT NULL,
  profile_pic VARCHAR(255) DEFAULT NULL,
  cover_pic VARCHAR(255) DEFAULT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

> Assumes you already have user records + login. Ensure the session stores the logged‑in user id under `$_SESSION['user']`.

---

## config.php

```php
<?php
// Database connection
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'your_database_name';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    die('DB connection failed: ' . $conn->connect_error);
}

// Set strict error reporting in dev only
// error_reporting(E_ALL); ini_set('display_errors', 1);
?>
```

---

## helpers.php

```php
<?php
// Start session if not started
if (session_status() === PHP_SESSION_NONE) session_start();

function csrf_token() {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['csrf'];
}

function verify_csrf($token) {
    return isset($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token ?? '');
}

function e($str) { return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8'); }

function ensure_upload_dir($path) {
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }
}

function valid_image_upload(array $file, int $maxMB = 5) {
    if (!isset($file['error']) || is_array($file['error'])) return 'Invalid upload params';
    if ($file['error'] !== UPLOAD_ERR_OK) return 'Upload error code: '.$file['error'];
    if ($file['size'] > $maxMB * 1024 * 1024) return 'File too large (max '.$maxMB.'MB)';

    // Verify MIME via finfo
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp'
    ];
    if (!isset($allowed[$mime])) return 'Only JPG, PNG, or WEBP allowed';

    // Extra check using getimagesize
    if (!@getimagesize($file['tmp_name'])) return 'Invalid image file';

    return ['ext' => $allowed[$mime], 'mime' => $mime];
}

function nocache_headers() {
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
}

require_once __DIR__.'/config.php';
require_once __DIR__.'/helpers.php';
if (session_status() === PHP_SESSION_NONE) session_start();

nocache_headers();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Load current user row for convenience
$user_id = (int) $_SESSION['user'];
$stmt = $conn->prepare('SELECT id, name, email, bio, profile_pic, cover_pic FROM users WHERE id = ? LIMIT 1');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
if (!$user) {
    // session invalid, user not found
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
```

---

## profile.php (UI + Live preview + forms)

```php
<?php require_once __DIR__.'/middleware_auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile</title>
  <style>
    :root { --card:#fff; --muted:#666; --bg:#f4f4f4; --primary:#0d6efd; }
    *{box-sizing:border-box} body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto; background:var(--bg)}
    .cover{position:relative;height:260px;background:#ddd url('<?php echo e($user['cover_pic'] ?: ""); ?>') center/cover no-repeat}
    .cover::after{content:"";position:absolute;inset:0;background:rgba(0,0,0,.25)}
    .wrap{max-width:900px;margin:auto}
    .card{background:var(--card);border-radius:14px;box-shadow:0 4px 18px rgba(0,0,0,.06)}
    .profile-box{position:relative;margin-top:-70px;padding:20px}
    .row{display:flex;gap:20px;align-items:flex-end;flex-wrap:wrap}
    .avatar{width:140px;height:140px;border-radius:50%;border:5px solid #fff;object-fit:cover;background:#eee}
    .meta{flex:1}
    .name{font-size:1.4rem;font-weight:700}
    .bio{color:var(--muted);margin-top:6px}
    .btn{appearance:none;border:0;border-radius:20px;padding:10px 16px;cursor:pointer}
    .btn.primary{background:var(--primary);color:#fff}
    .grid{display:grid;grid-template-columns:1fr;gap:16px;padding:20px}
    .section{padding:20px}
    .muted{color:var(--muted)}
    form.inline{display:flex;gap:10px;align-items:center}
    input[type=file]{display:none}
    .pill{border:1px solid #ddd;border-radius:999px;padding:8px 12px;background:#fff;cursor:pointer}
    .alert{margin:16px 0;padding:10px 14px;border-radius:10px;background:#eaf4ff;border:1px solid #cfe5ff}
  </style>
</head>
<body>
  <div class="cover" id="cover" ></div>
  <div class="wrap">
    <div class="card profile-box">
      <?php if(isset($_GET['msg'])): ?><div class="alert"><?php echo e($_GET['msg']); ?></div><?php endif; ?>
      <div class="row">
        <img class="avatar" id="avatar" src="<?php echo e($user['profile_pic'] ?: ''); ?>" alt="Profile">
        <div class="meta">
          <div class="name" id="nameText"><?php echo e($user['name']); ?></div>
          <div class="bio" id="bioText"><?php echo e($user['bio']); ?></div>
          <div class="muted">Email: <?php echo e($user['email']); ?></div>
        </div>
        <div>
          <!-- Change Profile Picture -->
          <form class="inline" action="update_media.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
            <input type="file" name="profile_pic" id="profileInput" accept="image/*">
            <label class="pill" for="profileInput">Change Photo</label>
            <button class="btn primary" type="submit">Save</button>
          </form>
          <div style="height:8px"></div>
          <!-- Change Cover Photo -->
          <form class="inline" action="update_media.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
            <input type="file" name="cover_pic" id="coverInput" accept="image/*">
            <label class="pill" for="coverInput">Change Cover</label>
            <button class="btn primary" type="submit">Save</button>
          </form>
        </div>
      </div>
    </div>

    <div class="card grid">
      <div class="section">
        <h3>Edit Basic Info</h3>
        <form action="update_profile.php" method="post">
          <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
          <div style="margin:8px 0">
            <label>Name</label><br>
            <input name="name" value="<?php echo e($user['name']); ?>" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:10px">
          </div>
          <div style="margin:8px 0">
            <label>Bio</label><br>
            <textarea name="bio" rows="3" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:10px"><?php echo e($user['bio']); ?></textarea>
          </div>
          <button class="btn primary">Update</button>
        </form>
      </div>
    </div>

    <div class="section muted">
      <a href="logout.php">Logout</a>
    </div>
  </div>

<script>
// Live preview for profile & cover
const profileInput = document.getElementById('profileInput');
const coverInput = document.getElementById('coverInput');
const avatar = document.getElementById('avatar');
const cover = document.getElementById('cover');

function preview(input, target, isCover=false){
  input.addEventListener('change', () => {
    const f = input.files[0];
    if (!f) return;
    const url = URL.createObjectURL(f);
    if (isCover) {
      cover.style.backgroundImage = `url('${url}')`;
    } else {
      target.src = url;
    }
  });
}

preview(profileInput, avatar);
preview(coverInput, null, true);
</script>
</body>
</html>
```

---

## update\_media.php (handles both profile & cover uploads securely)

```php
<?php
require_once __DIR__.'/middleware_auth.php';
require_once __DIR__.'/helpers.php';

if (!verify_csrf($_POST['csrf'] ?? '')) { http_response_code(419); exit('CSRF failed'); }

$uploadBase = __DIR__.'/uploads/'.$user_id; // user-specific dir
ensure_upload_dir($uploadBase);

$fields = [
  'profile_pic' => 'profile_pic',
  'cover_pic'   => 'cover_pic'
];

$updated = [];
foreach ($fields as $formName => $dbColumn) {
    if (!empty($_FILES[$formName]['name'])) {
        $check = valid_image_upload($_FILES[$formName], 5);
        if (!is_array($check)) {
            header('Location: profile.php?msg='.urlencode($check)); exit;
        }
        $ext = $check['ext'];
        $fname = $dbColumn.'-'.time().'-'.bin2hex(random_bytes(4)).'.'.$ext;
        $destPath = $uploadBase.'/'.$fname;
        if (!move_uploaded_file($_FILES[$formName]['tmp_name'], $destPath)) {
            header('Location: profile.php?msg='.urlencode('Failed to save file')); exit;
        }
        // Save relative path for web use (adjust if your docroot differs)
        $webPath = 'uploads/'.$user_id.'/'.$fname;
        $updated[$dbColumn] = $webPath;
    }
}

if ($updated) {
    // Build dynamic UPDATE
    $cols = array_keys($updated);
    $set = implode(',', array_map(fn($c)=> "$c = ?", $cols));
    $types = str_repeat('s', count($cols)) . 'i';
    $params = array_values($updated);
    $params[] = $user_id;

    $stmt = $conn->prepare("UPDATE users SET $set WHERE id = ?");
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    header('Location: profile.php?msg='.urlencode('Images updated'));
} else {
    header('Location: profile.php?msg='.urlencode('No file selected'));
}
exit;
require_once __DIR__.'/middleware_auth.php';
require_once __DIR__.'/helpers.php';

if (!verify_csrf($_POST['csrf'] ?? '')) { http_response_code(419); exit('CSRF failed'); }

$name = trim($_POST['name'] ?? '');
$bio  = trim($_POST['bio'] ?? '');
if ($name === '') { header('Location: profile.php?msg='.urlencode('Name is required')); exit; }

$stmt = $conn->prepare('UPDATE users SET name = ?, bio = ? WHERE id = ?');
$stmt->bind_param('ssi', $name, $bio, $user_id);
$stmt->execute();

header('Location: profile.php?msg='.urlencode('Profile updated'));
exit;
require_once __DIR__.'/helpers.php';
if (session_status() === PHP_SESSION_NONE) session_start();

// Destroy session
$_SESSION = [];
session_destroy();

// Send strong no-cache headers & redirect
nocache_headers();
header('Location: login.php');
exit;