<?php
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST") {
    if (isset($_POST['loginemail']) && isset($_POST['loginpassword'])) {
        include("dbconnect.php");
        $user_email = $_POST['loginemail'];
        $user_pass = $_POST['loginpassword'];
        $sql = "SELECT * FROM users WHERE user_email = '$user_email'";
        $result = mysqli_query($conn, $sql);
        $numrow = mysqli_num_rows($result);
        if ($numrow == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($user_pass, $row['user_pass'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['sno'] = $row['sno'];
                $_SESSION['login_success'] = true;
                $_SESSION['useremail'] = $user_email;
                echo "Yes you can login ";
                header('Location: /forums/');
            } else {
                echo "no you can't login";
                header("location: /forums/");
            }
        }
        else{
            header("location: /forums/");
        }
    }
}
?>