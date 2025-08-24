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
?>
