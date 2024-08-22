<?php
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST") {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } 
    session_unset();
    session_destroy();
    // session_start();
    $_SESSION['logout_success'] = true;

    
    if (!headers_sent()) {
        header("Location: /forums");
        exit();
    }
}
?>