<?php
$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_ainfo'])) {
    $address = trim($_POST['address'] ?? '');
    $phone_number = trim($_POST['phone_number'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $user_id = intval($_SESSION['user']); 

    $valid_states = [
        "Abia","Adamawa","Akwa Ibom","Anambra","Bauchi","Bayelsa","Benue",
        "Borno","Cross River","Delta","Ebonyi","Edo","Ekiti","Enugu",
        "FCT - Abuja","Gombe","Imo","Jigawa","Kaduna","Kano","Katsina",
        "Kebbi","Kogi","Kwara","Lagos","Nasarawa","Niger","Ogun","Ondo",
        "Osun","Oyo","Plateau","Rivers","Sokoto","Taraba","Yobe","Zamfara"
    ];

    // ====== 1. VALIDATE INPUT ======
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

    if (empty($address) || empty($phone_number) || empty($city)) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>All fields are required </div>';
    }
    if ($address == $user['address'] && $phone_number == $user['phone_number'] && $city == $user['city']) {
        $msg = '<div class="msg-error"><i class="fa-regular fa-circle-xmark"></i>No changes made to user info </div>';
    }else{
        // Run update query
        $stmt = $connect->prepare(
            "UPDATE user 
            SET address = ?, phone_number = ?, city = ?
            WHERE id = ?"
        );
        $stmt->bind_param("sdsi", $address, $phone_number, $city, $user_id);

        if ($stmt->execute()) {
            $msg = '<div class="msg-success"><i class="fa-regular fa-circle-check"></i> User Address updated successfully</div>';
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