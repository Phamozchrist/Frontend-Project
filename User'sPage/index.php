<?php require ' ../includes/session.php';
session_start();
if (isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id'])) {
        $_SESSION['user_id'] = $_COOKIE['user_id'];
    } else {
        header("Location: ../login.php");
        exit();
    }
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Prefix - User</title>
</head>
<body>
    <section>
        <header>
            <nav>

            </nav>
            <aside>
                <ul>
                    <li><a href="">Dashboard</a></li>
                    <li><a href="">Account</a></li>
                    <li><a href="">Categories</a></li>
                    <li><a href="">Settings</a></li>
                    <li><a href="">P2P</a></li>
                </ul>
            </aside>
        </header>
    </section>
</body>
</html>