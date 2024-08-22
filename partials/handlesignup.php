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

        $exists_user_email = "SELECT * FROM users WHERE user_email = '$user_email'";
        $exists_user_name = "SELECT * FROM users WHERE user_name = '$user_name'";
        $result_email = mysqli_query($conn, $exists_user_email);
        $result_name = mysqli_query($conn, $exists_user_name);
        $numRow_email = mysqli_num_rows($result_email);
        $numRow_name = mysqli_num_rows($result_name);
        if ($numRow_email > 0 && $numRow_name > 0) {
            $_SESSION['signup_repeat'] = true;
            header('Location: ' . $_SERVER['REQUEST_URI']);
        } else {
            if ($user_pass == $user_cpass) {
                $hash = password_hash($user_pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`user_name` , `user_email`, `user_pass`,`timestamp`) VALUES ('$user_name' , '$user_email', '$hash' , current_timestamp());";
                $result = mysqli_query($conn, $sql);
                $myalert = true;
                if ($result) {
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['signup_success'] = true;
                    $_SESSION['useremail'] = $user_email;
                    $myalert = "Signup Process is Successfull";
                    header('Location: /forums/');
                } else {
                    if(!session_start()){
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
