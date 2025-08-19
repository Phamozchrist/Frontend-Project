<?php
require '../includes/session.php';
$title = $price = $desc = $image = $phone_num = $msg = $confirmPassword = '';
$passwordErr = $newPasswordErr = $confirmPasswordErr = $user_id = '';
// Handle new post creation
if (isset($_POST['create_post'])) {
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $price = floatval($_POST['price']);
    $phone_num = $_POST['phone_num'];
    $desc = mysqli_real_escape_string($connect, $_POST['description']);
    $user_id = intval($_SESSION['user']);
    // Handle image upload if needed
    if (!empty($_FILES['image']['name'])) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = rand(1000,9999) . "." . $ext;
        $target = "../admin/uploads/" . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $image = $filename;
    }
    $sql = "INSERT INTO p2p_posts (user_id, title, price, description, image, phone_number) VALUES ('$user_id', '$title', '$price', '$desc', '$image', '$phone_num')";
    mysqli_query($connect, $sql);
}

if (isset($_GET['edit_post'])) {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $phone_num = isset($_POST['phone_num']) ? $_POST['phone_num'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $post_id = intval($_GET['edit_post']);

    $image = '';
    if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = rand(1000, 9999) . "." . $ext;
        $image = $filename;
        $target_file = "../admin/uploads/" . $image;
        move_uploaded_file($image_tmp, $target_file);
    }
    

    // Select Post and compare with the current post
    $stmt = "SELECT * FROM p2p_posts WHERE id = $post_id";
    $result = mysqli_query($connect, $stmt);
    $post = mysqli_fetch_assoc($result);
    $current_post_image = $post['image'];

    if (empty($title) || empty($price) || empty($desc) || empty($phone_num)) {
        $msg = "<div class='alert alert-danger'>All fields are required</div>";
    }elseif ($title == $post['title'] && $price == $post['price'] && $desc == $post['description'] && $phone_num == $post['phone_number'] && empty($image)) {
        $msg = "<div class='alert alert-info'>No changes made to the product</div>";
    }else{
        // Move the uploaded file to the desired directory
        if (!empty($image)) {
            if (!in_array($ext, $allowed_ext)) {
                $msg = "<div class='alert alert-danger'>Invalid file type. Only JPG, JPEG, and PNG are allowed</div>";
            }elseif ($product_image_error !== 0) {
                $msg = "<div class='alert alert-danger'>Error uploading file</div>";
            }else{
                $target_dir = "../admin/uploads/";
                $filename = rand(1000, 9999) . ".". $ext;
                $image = $filename;
                $target_file = $target_dir . basename($image);
                move_uploaded_file($image_tmp, $target_file);      
            }
               
                // Update product details in the database
                $stmt = $connect->prepare("UPDATE p2p_posts SET title=?, price=?, description=?, image=?, phone_number=? WHERE id=?");
                $stmt->bind_param("sdssdi", $title, $price, $description, $image, $phone_num, $post_id);
        } else {
            // Update product details in the database without changing the image
            $stmt = $connect->prepare("UPDATE p2p_posts SET title=?, price=?, description=?, phone_number=? WHERE id=?");
            $stmt->bind_param("sdsdi", $title, $price, $description, $phone_num, $post_id);
        }
        $result = $stmt->execute();
        if ($result) {
            $msg = "<div class='alert alert-success'>Product updated successfully</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Error updating post: " . mysqli_error($connect) . "</div>";
        }
    }
}

if (isset($_GET['save'])) {
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $newPassword = isset($_POST['new_password']) ? $_POST['new_password'] : '';
    $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $user_id = intval($_SESSION['user']);

    // Validate New Password
    if (empty($newPassword)) {
        $newPasswordErr = '<i class="fa-regular fa-circle-xmark"></i> Password is required';
    } else if(!preg_match('/^(?=.*[A-Za-z])(?=.*[\d])(?=.*[!@#$%?])[A-Za-z\d!@#$%?]*$/',$password)){
        $newPasswordErr = '<i class="fa-regular fa-circle-xmark"></i> Password must include an uppercase, number, symbol e.g P@ssw0rd';
    } elseif (strlen($newPassword < 8)) {
        $newPasswordErr = '<i class="fa-regular fa-circle-xmark"></i> Password must be at least 8 characters';
    }else {
        $newPasswordErr = '';
    }
    // Validate Confirm Password
    if (empty($confirmPassword)) {
        $confirmPasswordErr = '<i class="fa-regular fa-circle-xmark"></i> Password not confirmed';
    } elseif ($confirmPassword !== $password) {
        $confirmPasswordErr = '<i class="fa-regular fa-circle-xmark"></i> Password do not match';
    } else {
        $confirmPasswordErr = '';
    }

    if(empty($newPassword) || empty($password) || empty($confirmPassword)){
        $msg = '<p class="msg=error"><i class="fa-regular fa-circle-xmark"></i> Please fill in all fields;</p>'; 
    }
    // Display Success Message
    $error = $passwordErr . $newPasswordErr .  $confirmPasswordErr;
    
        // Verify the Old password
        
    if(empty($error)){
        $stmt = $connect->prepare('SELECT * FROM user WHERE id = ?');
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $passwordHash = $row["password"];
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                if (!password_verify($password, $passwordHash)) {
                    $msg = '<p class="msg-error"><i class="fa-regular fa-circle-xmark"></i> Incorrect password</p>';
                }elseif (password_verify($newpassword, $passwordHash))  {
                    $msg = '<p class="msg-error"><i class="fa-regular fa-checked"></i> No changes made.</p>"';
                }else {
                    $msg = '<p class="msg-error"><i class="fa-regular fa-checked"></i> No changes made.</p>"';
                }
                
            }
        }
        if (empty($error)) {
            $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT);
            $updatestmt = $connect->prepare("UPDATE user SET password=?, WHERE id=?");
            $stmt->bind_param("si", $newPassword, $user_id);;
            
            if ($updateStmt->execute()) {
                header("Location: ../user/settings.php");
            }else {
                $msg = '<i class="fa-regular fa-circle-xmark"></i> Error: ' . mysqli_error($insertStmt);
            }
        }
            
    }
}

?>