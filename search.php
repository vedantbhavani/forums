<?php
session_start();
require("partials/dbconnect.php");
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
    <div class="container w-75" style="min-height: 65.5vh;">
        <div class="search">
            <h1 class="mb-4">Search is <span class="fst-italic">"<?php if ($_GET["search"]){echo $_GET["search"];} else{echo "";}?>"</span></h1>
            <?php
            if ($_SESSION['loggedin']) {
                $query = $_GET['search'];
                if ($query) {
                    $noResult = true;
                    $sql = "SELECT * FROM threads WHERE CONCAT(thread_title,thread_desc) LIKE '%$query%'";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $noResult = false;
                        $title = $row['thread_title'];
                        $desc = $row['thread_desc'];
                        $thread_id = $row['thread_id'];
                        $desc = str_replace("<", "&lt;", $desc);
                        $desc = str_replace(">", "&gt;", $desc);
                        $title = str_replace("<", "&lt;", $title);
                        $title = str_replace(">", "&gt;", $title);
                        $url = "thread.php?threadid=" . $thread_id;
                        echo '
                    <div class="result">
                        <h3><a href="' . $url . '" class="text-dark">' . $title . '</a></h3>
                            <p>' . $desc . '</p>
                    </div>';
                    }
                    if ($noResult) {
                        echo '
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h3 class="display-6">No Result Found</h3>
                            <p class="lead">Suggestions:
                                <li class="mx-5">Make sure that all words are spelled correctly.</li>
                                <li class="mx-5">Try different keywords.</li>
                                <li class="mx-5">Try more general keywords.</p></li>
                        </div>
                    </div>';
                    }
                } else {
                    echo '<p class="fw-bold fs-5">No search found </p>';
                }
            } else {
                echo '<p class="fw-bold fs-5">Are you want to join this Search section then you should finish the Signup process </p>';
            }
            ?>
        </div>

    </div>
    <?php include("components/footer.php") ?>
</body>

</html>