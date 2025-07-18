<?php
// Include the database connection file and session
require 'session.php';

// test input function
function test_input($data) {
    global $connect;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($connect, $data);
    return $data;
}

// set required variables
$product_name = $product_discount = $product_image = $product_details = $category = $msg = "";
$errproduct_category = "";

// Add category

if (isset($_POST['add_category'])) {
    $category = test_input($_POST['category']);

    // Validate the category name
    if (empty($category)) {
        $errpost_category = "Category name is required";
    } else {
        // Check if the category already exists in the database
        $stmt = $connect->prepare("SELECT * FROM categories WHERE category_name= ?");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) {
            $errproduct_category = "Category already exists";
        } else {
            // Insert the new category into the database
            $stmt = "INSERT INTO categories (category_name) VALUES ('$category')";
            if (mysqli_query($connect, $stmt)) {
                $msg = "<div class='alert alert-success'>Category added successfully</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Error adding category: " . mysqli_error($connect) . "</div>";
            }
        }
    }
}

// Edit category
if (isset($_POST['edit_category'])) {
    $category = test_input($_POST['category']);
    $cat_name = test_input($_POST['cat_name']);
    $cat_id = (int)$_GET['edit'];

    // Validate the category name
    if(empty($category)){
        $msg = "<div class='alert alert-danger'>Category name is required</div>";
    }
    elseif ($category == $cat_name) {
        $msg = "<div class='alert alert-info'>No changes made to the category</div>";
    }
    else{
        // Check if the category already exists in the database
        $stmt = $connect->prepare("SELECT * FROM categories WHERE category_name= ? AND id != ?");
        $stmt->bind_param('si', $category, $cat_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) {
            $errpost_category = "Category already exists";
        } else {
            // Update the category in the database
            $stmt = "UPDATE categories SET category_name='$category' WHERE id=$cat_id";
            if (mysqli_query($connect, $stmt)) {
                $msg = "<div class='alert alert-success'>Category updated successfully</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Error updating category: " . mysqli_error($connect) . "</div>";
            }
        }
    }
}

// Add Post
if(isset($_POST['add_product'])){
    $product_name = test_input($_POST['product_name']);
    $product_discount = test_input($_POST['product_discount']);
    $product_details = $_POST['product_details'];
    $category = test_input($_POST['category']);
    // Post Image
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];
    $product_image_size = $_FILES['product_image']['size'];
    $product_image_error = $_FILES['product_image']['error'];
    $ext = strtolower(pathinfo($product_image, PATHINFO_EXTENSION));
    $allowed_ext = array('jpg', 'jpeg', 'png');

    if (empty($product_name) || empty($product_discount) || empty($product_details) || empty($category) || empty($product_image)) {
        $msg = "<div class='alert alert-danger'>All fields are required</div>";
    }elseif (!in_array($ext, $allowed_ext)) {
        $msg = "<div class='alert alert-danger'>Invalid file type. Only JPG, JPEG, and PNG are allowed</div>";
    }elseif ($product_image_error !== 0) {
        $msg = "<div class='alert alert-danger'>Error uploading file</div>";
    }
    else{
        // Move the uploaded file to the desired directory
        $target_dir = "uploads/";
        $filename = rand(1000, 9999) . ".". $ext;
        $product_image = $filename;
        $target_file = $target_dir . basename($product_image);
        if (move_uploaded_file($product_image_tmp, $target_file)) {
            // Insert product details into the database
            $stmt = "INSERT INTO products (product_name, product_discount, product_details, product_image, product_category) VALUES ('$product_name', '$product_discount', '$product_details', '$product_image', '$category')";
            if (mysqli_query($connect, $stmt)) {
                $msg = "<div class='alert alert-success'>Product added successfully</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Error adding product: " . mysqli_error($connect) . "</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Error moving uploaded file</div>";
        }
    }
}


// Edit Post
if (isset($_POST['edit_product'])) {
    $product_name = test_input($_POST['product_name']);
    $product_discount = test_input($_POST['product_discount']);
    $product_details = $_POST['product_details'];
    $category = test_input($_POST['category']);
    $product_id = (int)$_GET['edit'];
    // Post Image
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];
    $product_image_size = $_FILES['product_image']['size'];
    $product_image_error = $_FILES['product_image']['error'];
    $ext = strtolower(pathinfo($product_image, PATHINFO_EXTENSION));
    $allowed_ext = array('jpg', 'jpeg', 'png');

    // Select Post and compare with the current post
    $stmt = "SELECT * FROM products WHERE id=$product_id";
    $result = mysqli_query($connect, $stmt);
    $product = mysqli_fetch_assoc($result);
    $current_product_image = $product['product_image'];

    if (empty($product_name) || empty($product_discount) || empty($product_details) || empty($category)) {
        $msg = "<div class='alert alert-danger'>All fields are required</div>";
    }elseif ($product_name == $product['product_name'] && $product_discount == $product['product_subtitle'] && $product_details == $product['product_details'] && $category == $product['product_category'] && empty($product_image)) {
        $msg = "<div class='alert alert-info'>No changes made to the product</div>";
    }else{
            // Move the uploaded file to the desired directory
            if (!empty($product_image)) {
                if (!in_array($ext, $allowed_ext)) {
                    $msg = "<div class='alert alert-danger'>Invalid file type. Only JPG, JPEG, and PNG are allowed</div>";
                }elseif ($product_image_error !== 0) {
                    $msg = "<div class='alert alert-danger'>Error uploading file</div>";
                }else{
                    $target_dir = "uploads/";
                    $filename = rand(1000, 9999) . ".". $ext;
                    $product_image = $filename;
                    $target_file = $target_dir . basename($product_image);
                    move_uploaded_file($product_image_tmp, $target_file);      
                }
                 // Update product details in the database
                 $stmt = "UPDATE products SET product_name='$product_name', product_discount='$product_discount', product_details='$product_details', product_image='$product_image', product_category='$category' WHERE id=$product_id";
            } else {
                // Update product details in the database without changing the image
                $stmt = "UPDATE posts SET post_name='$product_name', product_discount='$product_discount', post_details='$product_details', post_category='$category' WHERE id=$product_id";
            }
            if (mysqli_query($connect, $stmt)) {
                $msg = "<div class='alert alert-success'>Product updated successfully</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Error updating post: " . mysqli_error($connect) . "</div>";
            }
        }
    }

?>