<?php
$myalert = false;
$myerror = false;
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    if (isset($_POST['signupEmail'], $_POST['signupPassword'], $_POST['signupcPassword'])) {
        include("dbconnect.php");
        $user_email = $_POST['signupEmail'];
        $user_name = $_POST['signupName'];
        $user_pass = $_POST['signupPassword'];
        $user_cpass = $_POST['signupcPassword'];
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $exists_user = "SELECT * FROM users WHERE user_email = '$user_email' OR user_name = '$user_name'";
        $result = mysqli_query($conn, $exists_user);
        if ($row = mysqli_fetch_assoc($result)) {
            if ($row['user_email'] == $user_email) {
                header('Location: /forums?useremail=false');
                $_SESSION['signup_repeat'] = true;
            }
            if ($row['user_name'] == $user_name) {
                header('Location: /forums?username=false');
                $_SESSION['signup_repeat'] = true;
            }
        } else {
            if ($user_pass == $user_cpass) {
                $hash = password_hash($user_pass, PASSWORD_DEFAULT);
                // $hash = $user_pass;
                $sql = "INSERT INTO `users` (`user_name` , `user_email`, `user_pass`,`timestamp`) VALUES ('$user_name' , '$user_email', '$hash' , current_timestamp());";
                $result = mysqli_query($conn, $sql);
                $myalert = true;
                if ($result) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['signup_success'] = true;
                    $_SESSION['sno'] = $row['sno'];
                    $_SESSION['useremail'] = $user_email;
                    $myalert = "Signup Process is Successfull";
                    header('Location: /forums/');
                } else {
                    if (!session_start()) {
                        session_start();
                    }
                    $_SESSION['signup_notmatch'] = true;
                    header('Location: /forums/');
                }
            } else {
                header('Location: /forums/');
            }
        }
    }
}
