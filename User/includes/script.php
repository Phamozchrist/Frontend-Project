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

if (isset($_POST['edit_post'])) {
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




?>
