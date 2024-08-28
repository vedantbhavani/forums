<?php
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST") {
    if (isset($_POST['loginemail']) && isset($_POST['loginPassword'])) {
        session_start();
        include "dbconnect.php";
        $user_email = $_POST['loginemail'];
        $user_password = $_POST['loginPassword'];
        $sql = "SELECT * FROM users WHERE user_email='$user_email'";
        $result = mysqli_query($conn, $sql);
        $numRow = mysqli_num_rows($result);
        if ($numRow == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($user_password , $row["user_pass"])){
                session_status() === PHP_SESSION_NONE ? session_start() : null;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['loggedin'] = true;
                $_SESSION['sno'] = $row['sno'];
                $_SESSION['login_success'] = true;
                $_SESSION['useremail'] = $user_email;
                header("location: /forums/?login=true");
            } else {
                header("location: /forums/?login=false");
            }
        } else {
            header("location: /forums/?thisisnot=true");
        }
    }
}
