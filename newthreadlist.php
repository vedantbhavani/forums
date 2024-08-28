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
    <?php require("partials/alerterror.php") ?>
    <?php
    $gid = $_GET['catid'];
    $catsql = "SELECT * FROM `categories` WHERE category_id=$gid";
    $catresult = mysqli_query($conn, $catsql);
    while ($row = mysqli_fetch_assoc($catresult)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>

    <?php
    $myalert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        if (isset($_POST['title']) && isset($_POST['desc'])) {
            // Insert in to threads db
            $th_title = mysqli_real_escape_string($conn, $_POST['title']);
            $th_desc = mysqli_real_escape_string($conn, $_POST['desc']);
            $sno = $_POST['sno'];
            
            $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `posted_at`) VALUES ('$th_title', '$th_desc', '$gid', '$sno', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            $myalert = true;
            if ($result) {
                $myalert = "Your thread will be added successfully, please wait for community responds.";
                if ($myalert) {
                    echo '<div class=" alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong>Success : </strong> ' . $myalert . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
                }
            }
        }
    }
    ?>
    <div class="container w-75 " style="min-height: 63.5vh;">
        <div class="container my-4 bg-dark-subtle p-4">
            <h1 class="display-4 text-center">Welcome to <?php echo $catname ?> forums</h1>
            <p class="lead  ">
                <?php echo $catdesc ?>
            </p>
            <hr class="my-3">
            <p><b>Notes: </b>Users are entitled to choose not to enter into debate with you. Dont post or link to inappropriate, offensive or illegal material. Inappropriate content is anything that may offend or is not relevant to the forum. Dont post any advertisements or solicitations, however much you believe in the service or product.</p>
            <a href="#" class="btn btn-lg btn-primary">Learn more</a>
        </div>
    </div>

    <div class="container w-75 " style="min-height: 63.5vh;">
        <div class="container-lg">
            <div class="media-part mt-5">
                <h3 class="">Start a Discussion</h3>
                <hr class="mt-0 mb-4">
            </div>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '
                <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                    <div class="mb-3">
                        <label for="title" class="form-label">Problem title</label>
                        <input type="text" class="bg-secondary-subtle form-control" name="title" id="title">
                        </div>
                        <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                    <div class="mb-3">
                        <label for="desc" class="form-label">Elaborate your concern</label>
                        <textarea class="bg-secondary-subtle form-control" name="desc" id="desc" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>';
            }
            else{
                echo'
                <p class="fw-bold">Are you want to join this discussion then you should finish the Signup process </p>
                ';
            }
            ?>
        </div>

        <!-- Threads part start here -->

        <div class="media-part mt-5">
            <h3 class="">Browse Questions</h3>
            <hr class="mt-0 mb-4">

            <?php
            $catid = $_GET['catid'];
            $gsql = "SELECT * FROM `threads` WHERE thread_cat_id='$catid'";
            $result = mysqli_query($conn, $gsql);
            $noResult = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $id = $row['thread_id'];
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $time = $row['posted_at'];
                $thread_user_id = $row['thread_user_id'];
                $sql2 = "SELECT user_name FROM `users` WHERE sno='$thread_user_id'";
                $result2 = mysqli_query($conn , $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $username = $row2['user_name'];
                echo '<div class="media d-flex mt-4">
                        <img src="images/user.png" class="me-3" style="width: 40px; height: 40px;" alt="...">
                        <div class="media-body">
                        <p class="fw-bold my-0">'.$username.' <small class="text-secondary">' . $time . '</small></p>
                            <h5 class="mt-0"> <a class="text-primary-emphasis text-decoration-none" href="thread.php?threadid=' . $id . '"> ' . $title . '</a></h5>
                            <p class="my-0">' . $desc . '</p>
                        </div>
                    </div>
                ';
            }
            if ($noResult) {
                echo '
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h3 class="display-6">No Threads Found</h3>
                        <p class="lead">Get the chance to be the first person to ask the question.</p>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
    <?php include("components/footer.php") ?>

</body>

</html>