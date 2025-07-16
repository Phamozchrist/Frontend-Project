<?php
// logout Admin
session_start();
session_destroy();
header("Location: login.php");