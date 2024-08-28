<?php
require("partials/dbconnect.php");
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <?php include("links/script.php"); ?>
</head>

<body>
    <?php include("components/navbar.php") ?>
    <?php include("partials/alerterror.php") ?>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
    }
    ?>

<?php
    $myalert = false;
    $id = $_GET['threadid'];
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        // Insert in to comment db
        $comment = $_POST['comment'];
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `comments` (`comment_content`, `comment_by`, `thread_id`, `comment_time`) VALUES ('$comment', '$sno', '$id', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $myalert = true;
        if ($result) {
            $myalert = "Your comment will be added successfully";
            if ($myalert) {
                echo '<div class=" alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong>Success : </strong> ' . $myalert . '.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
        }
    }
    ?>

    <div class="container w-75 " style="min-height: 63.5vh;">
        <div class="container my-4 bg-dark-subtle p-4">
            <h2 class="display-5 text-center"><?php echo $title ?></h2>
            <p class="lead  ">
                <?php echo $desc ?>
            </p>
            <hr class="my-3">
            <p><b>Notes: </b>Users are entitled to choose not to enter into debate with you. Don't post or link to inappropriate, offensive or illegal material. Inappropriate content is anything that may offend or is not relevant to the forum. Don't post any advertisements or solicitations, however much you believe in the service or product.</p>
            <p class="text-end mb-0">Post by<span class="fw-bold "> Stephen</span></p>
        </div>

        <!-- Threads part start here -->
        <div class="container-lg">
            <div class="media-part mt-5">
                <h3 class="">Post Your Comment</h3>
                <hr class="mt-0 mb-4">
            </div>
            <?php
            
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '
            <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                <div class="mb-3">
                    <label for="comment" class="form-label">Enter your comment</label>
                    <textarea class="bg-secondary-subtle form-control" name="comment" id="comment" rows="3"></textarea>
                    <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                    <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                    </div>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
            ';
            }
            else{
                echo'
                <p class="fw-bold fs-5">Are you want to join this comment section then you should finish the Signup process </p>
                ';
            }
            ?>
            
        </div>

        <div class="media-part mt-5">
            <h3 class="">Discussion </h3>
            <hr class="mt-0 mb-4">
        </div>

        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $time = $row['comment_time'];
            $thread_user_id = $row['comment_by'];
            $sql_user = "SELECT user_name FROM `users` WHERE sno='$thread_user_id'";
            $result_user = mysqli_query($conn , $sql_user);
            $row2 = mysqli_fetch_assoc($result_user);
            $username = $row2['user_name'];
            echo '<div class="media d-flex mt-4">
                        <img src="images/user.png" class="me-3" style="width: 40px; height: 40px;" alt="...">
                        <div class="media-body">
                            <p class="fw-bold my-0">'.$username.' <small class="text-secondary">'.$time.'</small></p>
                            <p class="my-0">"' . $content . '"</p>
                        </div>
                    </div>
                ';
        }
        if ($noResult) {
            echo '
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h3 class="display-6">No Comment Found</h3>
                        <p class="lead">Get the chance to be the first person to write the comment.</p>
                    </div>
                </div>';
        }
        ?>
    </div>
    </div>
    <?php include("components/footer.php") ?>
</body>

</html>