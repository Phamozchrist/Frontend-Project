<?php
include "../includes/session.php";

if (isset($_POST['id'], $_POST['name'], $_POST['price'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $price = floatval($_POST['price']);
    $qty = 1;

    // SESSION CART LOGIC
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $id) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'quantity' => $qty
        ];
    }

    // DATABASE CART LOGIC
    $user_id = $_SESSION['user_id'] ?? null; // get from login system
    if ($user_id) {
        // Check if product already exists in DB cart
        $check = $conn->prepare("SELECT * FROM cart WHERE user_id=? AND product_id=?");
        $check->bind_param("ii", $user_id, $id);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $newQty = $row['quantity'] + 1;

            $update = $conn->prepare("UPDATE cart SET quantity=? WHERE user_id=? AND product_id=?");
            $update->bind_param("iii", $newQty, $user_id, $id);
            $update->execute();
        } else {
            $insert = $conn->prepare("INSERT INTO cart (user_id, product_id, product_name, price, quantity) VALUES (?, ?, ?, ?, ?)");
            $insert->bind_param("iisdi", $user_id, $id, $name, $price, $qty);
            $insert->execute();
        }
    }

    echo "✅ $name added to cart!";
} else {
    echo "❌ Invalid request";
}
