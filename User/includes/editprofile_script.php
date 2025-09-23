<?php
require '../includes/session.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_uinfo'])) {
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $phone_number = trim($_POST['phone_number'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $user_id = intval($_SESSION['user']); 
    $profile_image = isset($_FILES['profile_pics']['name']) ? $_FILES['profile_pics']['name'] : '';
    $profile_image_tmp = isset($_FILES['profile_pics']['tmp_name']) ? $_FILES['profile_pics']['tmp_name'] : '';
    $profile_image_size = isset($_FILES['profile_pics']['size']) ? $_FILES['profile_pics']['size'] : '';
    $profile_image_err = isset($_FILES['profile_pics']['error']) ? $_FILES['profile_pics']['error'] :'';
    $profile_ext = strtolower(pathinfo($profile_image, PATHINFO_EXTENSION));
    $cover_image = isset($_FILES['cover_pics']['name']) ? $_FILES['cover_pics']['name'] : '';
    $cover_image_tmp = isset($_FILES['cover_pics']['tmp_name']) ? $_FILES['cover_pics']['tmp_name'] : '';
    $cover_image_size = isset($_FILES['cover_pics']['size']) ? $_FILES['cover_pics']['size'] : '';
    $cover_image_err = isset($_FILES['cover_pics']['error']) ? $_FILES['cover_pics']['error'] : '';
    $cover_ext = strtolower(pathinfo($cover_image, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png'];

    $valid_states = [
        "Abia","Adamawa","Akwa Ibom","Anambra","Bauchi","Bayelsa","Benue",
        "Borno","Cross River","Delta","Ebonyi","Edo","Ekiti","Enugu",
        "FCT - Abuja","Gombe","Imo","Jigawa","Kaduna","Kano","Katsina",
        "Kebbi","Kogi","Kwara","Lagos","Nasarawa","Niger","Ogun","Ondo",
        "Osun","Oyo","Plateau","Rivers","Sokoto","Taraba","Yobe","Zamfara"
    ];

    // ====== 1. VALIDATE INPUT ======
    if (!preg_match('/^[a-zA-Z]+$/', $firstname)) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>Firstname can only contain letters </div>';
    } elseif (strlen($firstname) < 3) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>Firstname must be at least 3 characters </div>';
    }

    if (!preg_match('/^[a-zA-Z]+$/', $lastname)) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>Lastname can only contain letters </div>';
    } elseif (strlen($lastname) < 3) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>Lastname must be at least 3 characters </div>';
    }

    if (!preg_match('/^[A-Za-z0-9@#$%!?.]+$/', $username)) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>Username may only contain letters, numbers, or @#$%!? </div>';
    } elseif (strlen($username) < 3) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>Username must be at least 3 characters </div>';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>Invalid email format </div>';
    }

    if (empty($address)) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>Address cannot be empty </div>';
    }

    if (empty($city) || !in_array($city, $valid_states)) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>Invalid city/state selected.</div>';
    }
    if (empty($phone_number) || !preg_match('/^\d{11}$/', $phone_number)) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>Phone number must be 11 digits (e.g., 08123456789) </div>';
    }

    // ====== 2. FETCH OLD USER INFO ======
    $stmt = $connect->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($address) || empty($phone_number) || empty($city)) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>All fields are required </div>';
    }
    if ($firstname == $user['firstname'] && $lastname == $user['lastname'] && $username == $user['username'] && $email == $user['email'] && $address == $user['address'] && $profile_image == $user['profile_pics'] && $cover_image == $user['cover_pics'] && $phone_number == $user['phone_number'] && $city == $user['city']) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>No changes made to user info </div>';
    }else{
        // Check if profile image or cover image is being uploaded
        $target_dir = "../admin/uploads/";
        $newProfileImage = $user['profile_pics']; // keep old by default
        $newCoverImage   = $user['cover_pics'];   // keep old by default

        // Profile image
        if (!empty($profile_image)) {
            if (!in_array($profile_ext, $allowed_ext)) {
                $msg = "<div class='msg-error'>Invalid profile image type</div>";
            } elseif ($profile_image_err === 0) {
                // Delete old file (if not default and exists)
                if (!empty($user['profile_pics']) && $user['profile_pics'] !== 'default-profile.png') {
                    $oldPath = $target_dir . $user['profile_pics'];
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                // Save new file
                $profile_filename = rand(1000, 9999) . "." . $profile_ext;
                move_uploaded_file($profile_image_tmp, $target_dir . $profile_filename);
                $newProfileImage = $profile_filename;
            }
        }

        // Cover image
        if (!empty($cover_image)) {
            if (!in_array($cover_ext, $allowed_ext)) {
                $msg = "<div class='msg-error'>Invalid cover image type</div>";
            } elseif ($cover_image_err === 0) {
                // Delete old file (if not default and exists)
                if (!empty($user['cover_pics']) && $user['cover_pics'] !== 'default-profile.png') {
                    $oldPath = $target_dir . $user['cover_pics'];
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                // Save new file
                $cover_filename = rand(1000, 9999) . "." . $cover_ext;
                move_uploaded_file($cover_image_tmp, $target_dir . $cover_filename);
                $newCoverImage = $cover_filename;
            }
        }

        // Run update query
        $stmt = $connect->prepare(
            "UPDATE user 
            SET firstname = ?, lastname = ?, username = ?, email = ?, address = ?, profile_pics = ?, cover_pics = ?, phone_number = ?, city = ?
            WHERE id = ?"
        );
        $stmt->bind_param("sssssssdsi", $firstname, $lastname, $username, $email, $address, $newProfileImage, $newCoverImage, $phone_number, $city, $user_id);

        if ($stmt->execute()) {
            $msg = '<div class="msg-success"><i class="fa-regular fa-circle-check"></i> User info updated successfully</div>';
        } else {
            $msg = '<div class="msg-error">Error updating user: ' . $stmt->error . '</div>';
        }
    }
}

$users_id = intval($_SESSION['user']);
$stmt = $connect->prepare("SELECT * FROM user WHERE id = ?");
$stmt->bind_param("i", $users_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

?>