<?php
require '../includes/session.php';
$msg = " ";
$user_id = $_SESSION['user'];

// Get cart items for the logged-in user
$stmt = $connect->prepare(
    "SELECT c.quantity, p.product_name, p.product_price, p.product_discount, p.product_image
    FROM cart_table c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
$subtotal = 0;
$item_count = 0;
$delivery_fee = 5.8;

while ($row = $result->fetch_assoc()) {
    $price = $row['product_discount'] > 0 
             ? $row['product_price'] - ($row['product_price'] * $row['product_discount'] / 100) 
             : $row['product_price'];
    
    $subtotal += $price * $row['quantity'];
    $item_count += $row['quantity'];
    $cart_items[] = $row;
}

$total = $subtotal + $delivery_fee;

if (isset($_POST['crt-order'])) {
    $user_id = $_SESSION['user'];
    $status = "pending";

    $sql = $connect->prepare("SELECT * FROM user WHERE id = ?");
    $sql->bind_param("i", $user_id);
    $sql->execute();
    $result = $sql->get_result();
    $user = $result->fetch_assoc();
    if (empty($user['address']) || empty($user['city']) || empty($user['phone_number'])) {
        $msg = '<div class="msg-error"><i class="fa-regular
    fa-circle-xmark"></i> Please update your address details before placing an order.<a href="edit_address.php" style="color:#28292a; text-decoration:underline;">Update now</a></div>';
       
    }else{
        // Fetch cart items from DB
        $cartQuery = $connect->prepare("SELECT c.*, p.product_price 
                                        FROM cart_table c 
                                        JOIN products p ON c.product_id = p.id
                                        WHERE c.user_id = ?");
        $cartQuery->bind_param("i", $user_id);
        $cartQuery->execute();
        $cartResult = $cartQuery->get_result();
        $cart_items = $cartResult->fetch_all(MYSQLI_ASSOC);
    
        if (empty($cart_items)) {
            $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i> Your cart is empty</div>';
        } else {
            // Calculate total
            $total = 0;
            foreach ($cart_items as $item) {
                $total += $item['product_price'] * $item['quantity'];
            }
    
            // 1️⃣ Create order record
            $stmt = $connect->prepare("INSERT INTO orders (user_id, status, total) VALUES (?, ?, ?)");
            $stmt->bind_param("isd", $user_id, $status, $total);
            $stmt->execute();
            $order_id = $stmt->insert_id; // get the new order id
    
            // 2️⃣ Insert order items
            $stmtItem = $connect->prepare("INSERT INTO order_items (order_id, product_id, qty, price) VALUES (?, ?, ?, ?)");
            foreach ($cart_items as $item) {
                $price = $item['product_price'];
                $stmtItem->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $price);
                $stmtItem->execute();
            }
    
            // 3️⃣ Clear cart
            $stmt = $connect->prepare("DELETE FROM cart_table WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
    
            $msg = '<div class="msg-success"><i class="fa-regular fa-circle-check"></i> Order placed successfully</div>';
        }
    }

}



?>
