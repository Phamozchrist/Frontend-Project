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
$first_name = $last_name = $email = $password = "";

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
            $msg = "<div class='alert alert-danger'>Category already exists</div>";
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
            $msg = "<div class='alert alert-danger'>Category already exists</div>";
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

// Add Product
if (isset($_POST['add_product'])) {
    $product_name = test_input($_POST['product_name']);
    $product_price = floatval($_POST['product_price']);
    $product_discount = !empty($_POST['product_discount']) ? floatval($_POST['product_discount']) : 0;
    $product_details = $_POST['product_details'];
    $category = intval($_POST['category']);

    // Image
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];
    $product_image_error = $_FILES['product_image']['error'];
    $ext = strtolower(pathinfo($product_image, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png'];

    if (empty($product_name) || empty($product_price) || empty($product_details) || empty($category) || empty($product_image)) {
        $msg = "<div class='alert alert-danger'>All required fields must be filled</div>";
    } elseif (!in_array($ext, $allowed_ext)) {
        $msg = "<div class='alert alert-danger'>Invalid file type. Only JPG, JPEG, PNG allowed</div>";
    } elseif ($product_image_error !== 0) {
        $msg = "<div class='alert alert-danger'>Error uploading file</div>";
    } else {
        $target_dir = "uploads/";
        $filename = uniqid("prod_", true) . "." . $ext;
        $target_file = $target_dir . $filename;

        if (move_uploaded_file($product_image_tmp, $target_file)) {
            $stmt = $connect->prepare("INSERT INTO products 
                (product_name, product_price, product_discount, product_details, product_image, product_category) 
                VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sddssi", $product_name, $product_price, $product_discount, $product_details, $filename, $category);
            
            if ($stmt->execute()) {
                $msg = "<div class='alert alert-success'>Product added successfully</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Error adding product: " . $stmt->error . "</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Error moving uploaded file</div>";
        }
    }
}



// Edit Product
if (isset($_POST['edit_product'])) {
    $product_name     = test_input($_POST['product_name']);
    $product_price    = (float)test_input($_POST['product_price']);
    $product_discount = (int)test_input($_POST['product_discount']);
    $product_details  = $_POST['product_details'];
    $category         = test_input($_POST['category']);
    $product_id       = (int)$_GET['edit'];

    // Image
    $product_image     = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];
    $product_image_err = $_FILES['product_image']['error'];
    $ext               = strtolower(pathinfo($product_image, PATHINFO_EXTENSION));
    $allowed_ext       = ['jpg', 'jpeg', 'png'];

    // Fetch current product
    $stmt   = $connect->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result  = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    // Validation
    if ($product_name === '' || $product_price === '' || $product_discount === '' || $product_details === '' || $category === '') {
        $msg = "<div class='alert alert-danger'>All fields are required</div>";
    } elseif (
        $product_name == $product['product_name'] &&
        $product_price == $product['product_price'] &&
        $product_discount == $product['product_discount'] &&
        $product_details == $product['product_details'] &&
        $category == $product['product_category'] &&
        empty($product_image)
    ) {
        $msg = "<div class='alert alert-info'>No changes made to the product</div>";
    } else {
        // If new image uploaded
        if (!empty($product_image)) {
            if (!in_array($ext, $allowed_ext)) {
                $msg = "<div class='alert alert-danger'>Invalid file type. Only JPG, JPEG, and PNG are allowed</div>";
            } elseif ($product_image_err !== 0) {
                $msg = "<div class='alert alert-danger'>Error uploading file</div>";
            } else {
                $target_dir = "uploads/";
                if (!empty($product['product_image']) && file_exists($target_dir . $product['product_image'])) {
                    unlink($target_dir . $product['product_image']);
                }
                $filename = rand(1000, 9999) . "." . $ext;
                move_uploaded_file($product_image_tmp, $target_dir . $filename);
                $product_image = $filename;

                $stmt = $connect->prepare("UPDATE products 
                    SET product_name=?, product_price=?, product_discount=?, product_details=?, product_image=?, product_category=? 
                    WHERE id=?");
                $stmt->bind_param("sddsssi", $product_name, $product_price, $product_discount, $product_details, $product_image, $category, $product_id);
            }
        } else {
            // Update without changing image
            $stmt = $connect->prepare("UPDATE products 
                SET product_name=?, product_price=?, product_discount=?, product_details=?, product_category=? 
                WHERE id=?");
            $stmt->bind_param("sddssi", $product_name, $product_price, $product_discount, $product_details, $category, $product_id);
        }

        if ($stmt->execute()) {
            $msg = "<div class='alert alert-success'>Product updated successfully</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Error updating product: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }
}



// Add Admin
if (isset($_POST['add_admin'])) {
    $first_name = test_input($_POST['first_name']);
    $last_name = test_input($_POST['last_name']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);

    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $msg = "<div class='alert alert-danger'>All fields are required</div>";
    } else {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $connect->prepare("SELECT * FROM admin WHERE email = ? ");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) {
            $msg = "<div class='alert alert-danger'>Email already registered</div>";
        } else {
            // Insert the new category into the database
            $stmt = "INSERT INTO admin (firstname, lastname, email, password) VALUES ('$first_name','$last_name','$email','$password')";
            if (mysqli_query($connect, $stmt)) {
                $msg = "<div class='alert alert-success'>Admin added successfully</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Error creating admin: " . mysqli_error($connect) . "</div>";
            }
        }
    }
}

// Edit Admin
if (isset($_POST['edit_admin'])) {
    $first_name = test_input($_POST['first_name']);
    $last_name = test_input($_POST['last_name']);
    $email = test_input($_POST['email']);
    $admin_id = (int)$_GET['edit'];

    // Validate the fields
    if(empty($first_name) || empty($last_name) || empty($email)){
        $msg = "<div class='alert alert-danger'>All fields are required</div>";
    }else{
        // Check if the admin already exists in the database
        $stmt = $connect->prepare("SELECT * FROM admin");
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                if($email == $row['email'] && $first_name == $row['firstname'] && $last_name == $row['lastname']){
                    $msg = "<div class='alert alert-danger'>No changes made to the admin</div>";
                } else {
                    // Update the admin in the database
                    $stmt = "UPDATE admin SET firstname='$first_name', lastname='$last_name', email='$email' WHERE id=$admin_id";
                    if (mysqli_query($connect, $stmt)) {
                        $msg = "<div class='alert alert-success'>Admin's Info updated successfully</div>";
                    } else {
                        $msg = "<div class='alert alert-danger'>Error updating admin: " . mysqli_error($connect) . "</div>";
                    }
                }
            }
        } else {
            $msg = "Admin's Info updated successfully";
        }
    }
}
?>