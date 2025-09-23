<?php
ini_set('display_errors', 0); // hide errors from being sent to JSON
error_reporting(E_ALL);

session_start();
include_once "../includes/config.php"; // database connection

header("Content-Type: application/json");

$user_id = $_SESSION['user'] ?? null;
if (!$user_id) {
    echo json_encode(["success" => false, "message" => "Not logged in"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true) ?? [];
$action = $data['action'] ?? "";
$product_id = intval($data['product_id'] ?? 0);
$qty = intval($data['qty'] ?? 1);

$response = ["success" => false];

switch ($action) {
    case "add":
        // check if exists
        $check = $connect->prepare("SELECT id, quantity FROM cart_table WHERE user_id = ? AND product_id = ?");
        $check->bind_param("ii", $user_id, $product_id);
        $check->execute();
        $result = $check->get_result();

        if ($row = $result->fetch_assoc()) {
            $newQty = $row['quantity'] + $qty;
            $update = $connect->prepare("UPDATE cart_table SET quantity = ? WHERE id = ?");
            $update->bind_param("ii", $newQty, $row['id']);
            $update->execute();
        } else {
            $insert = $connect->prepare("INSERT INTO cart_table (user_id, product_id, quantity) VALUES (?, ?, ?)");
            $insert->bind_param("iii", $user_id, $product_id, $qty);
            $insert->execute();
        }
        $response["success"] = true;
        break;

    case "update":
        $update = $connect->prepare("UPDATE cart_table SET quantity=? WHERE user_id = ? AND product_id = ?");
        $update->bind_param("iii", $qty, $user_id, $product_id);
        $update->execute();
        $response["success"] = true;
        break;

    case "remove":
        $delete = $connect->prepare("DELETE FROM cart_table WHERE user_id = ? AND product_id = ?");
        $delete->bind_param("ii", $user_id, $product_id);
        $delete->execute();
        $response["success"] = true;
        break;
    
    case "count":
        $stmt = $connect->prepare("SELECT SUM(quantity) as total FROM cart_table WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $response["count"] = (int)$result['total'];
        break;
        
    case "empty":
        $stmt = $connect->prepare("DELETE FROM cart_table WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            // After emptying, return count = 0
            echo json_encode([
                "success" => true,
                "count" => 0
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "error" => $stmt->error
            ]);
        }
        break;
        
    case "fetch":
        $items = [];
        $query = $connect->prepare(
            "SELECT c.product_id, c.quantity, p.product_name, p.product_price, p.product_discount, p.product_image,p.product_price - (p.product_price * p.product_discount / 100) AS product_discount_price
            FROM cart_table c
            JOIN products p ON c.product_id = p.id
            WHERE c.user_id = ?"
        );
        $query->bind_param("i", $user_id);  
        $query->execute();
        $result = $query->get_result();

        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        $response["success"] = true;
        $response["items"] = $items;
        break;
}
echo json_encode($response);
