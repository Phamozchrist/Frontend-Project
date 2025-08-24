<?php
require '../includes/session.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_uinfo'])) {
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $user_id = intval($_SESSION['user']); 
    $profile_image = isset($_FILES['profile_pics']['name']) ? $_FILES['profile_pics']['name'] : '';
    $profile_image_tmp = isset($_FILES['profile_pics']['tmp_name']) ? $_FILES['profile_pics']['tmp_name'] : '';
    $profile_image_size = isset($_FILES['profile_pics']['size']) ? $_FILES['profile_pics']['size'] : '';
    $profile_image_error = isset($_FILES['profile_pics']['error']) ? $_FILES['profile_pics']['error'] :'';
    $ext = strtolower(pathinfo($profile_image, PATHINFO_EXTENSION));
    $cover_image = isset($_FILES['cover_pics']['name']) ? $_FILES['cover_pics']['name'] : '';
    $cover_image_tmp = isset($_FILES['cover_pics']['tmp_name']) ? $_FILES['cover_pics']['tmp_name'] : '';
    $cover_image_size = isset($_FILES['cover_pics']['size']) ? $_FILES['cover_pics']['size'] : '';
    $cover_image_error = isset($_FILES['cover_pics']['error']) ? $_FILES['cover_pics']['error'] : '';
    $cover_ext = strtolower(pathinfo($cover_image, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png'];
    
    
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

    // ====== 2. FETCH OLD USER INFO ======
    $stmt = $connect->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($address)) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>All fields are required </div>';
    }
    if ($firstname == $user['firstname'] && $lastname == $user['lastname'] && $username == $user['username'] && $email == $user['email'] && $address == $user['address'] && $profile_image == $user['profile_pics'] && $cover_image == $user['cover_pics']) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>No changes made to user info </div>';
    }else{
        // Check if profile image or cover image is being uploaded
        if (!empty($profile_image)) {
            if (!in_array($ext, $allowed_ext)) {
                $msg = "<div class='alert alert-danger'>Invalid file type. Only JPG, JPEG, and PNG are allowed</div>";
            }elseif ($profile_image_error !== 0) {
                $msg = "<div class='alert alert-danger'>Error uploading file</div>";
            }else{
                $target_dir = "../admin/uploads/";
                $filename = rand(1000, 9999) . ".". $ext;
                $profile_image = $filename;
                $target_file = $target_dir . basename($profile_image);
                move_uploaded_file($profile_image_tmp, $target_file);
            }
            $stmt = $connect->prepare(
                "UPDATE user 
                SET firstname = ?, lastname = ?, username = ?, email = ?, address = ?, profile_pics = ?, cover_pics = ?
                WHERE id = ?"
            );
            $stmt->bind_param("sssssssi", $firstname, $lastname, $username, $email, $address, $profile_image, $cover_image, $user_id);
        }elseif (!empty($cover_image)) {
            if (!in_array($cover_ext, $allowed_ext)) {
                $msg = "<div class='alert alert-danger'>Invalid file type. Only JPG, JPEG, and PNG are allowed</div>";
            } elseif ($cover_image_error !== 0) {
                $msg = "<div class='alert alert-danger'>Error uploading file</div>";
            } else {
                $target_dir = "../admin/uploads/";
                $filename = rand(1000, 9999) . "." . $cover_ext;
                $cover_image = $filename;
                $target_file = $target_dir . basename($cover_image);
                move_uploaded_file($cover_image_tmp, $target_file);
            }
            $stmt = $connect->prepare(
                "UPDATE user 
                SET firstname = ?, lastname = ?, username = ?, email = ?, address = ?,profile_pics = ? cover_pics = ?
                WHERE id = ?"
            );
            $stmt->bind_param("sssssssi", $firstname, $lastname, $username, $email, $address, $profile_image, $cover_image, $user_id);
        } elseif (!empty($profile_image) && !empty($cover_image)) {
            if (!in_array($ext, $allowed_ext) && !in_array($cover_ext, $allowed_ext)) {
                $msg = "<div class='alert alert-danger'>Invalid file type. Only JPG, JPEG, and PNG are allowed</div>";
            } elseif ($profile_image_error !== 0 && $cover_image_error !== 0) {
                $msg = "<div class='alert alert-danger'>Error uploading file</div>";
            } else {
                $target_dir = "../admin/uploads/";
                $profile_filename = rand(1000, 9999) . "." . $ext;
                $cover_filename = rand(1000, 9999) . "." . $cover_ext;
                move_uploaded_file($profile_image_tmp, $target_dir . basename($profile_filename));
                move_uploaded_file($cover_image_tmp, $target_dir . basename($cover_filename));
            }
            $stmt = $connect->prepare(
                "UPDATE user 
                SET firstname = ?, lastname = ?, username = ?, email = ?, address = ?, profile_pics = ?, cover_pics = ?
                WHERE id = ?"
            );
            $stmt->bind_param("sssssssi", $firstname, $lastname, $username, $email, $address, $profile_image, $cover_image, $user_id);
        } else {

            $stmt = $connect->prepare(
                "UPDATE user 
                SET firstname = ?, lastname = ?, username = ?, email = ?, address = ?
                WHERE id = ?"
            );
            $stmt->bind_param("sssssi", $firstname, $lastname, $username, $email, $address, $user_id);
        }
        
        if ($stmt->execute()) {
            $msg = '<div class="msg-success"><i class="fa-regular fa-circle-xmark"></i>User Info updated successfully</div>';
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