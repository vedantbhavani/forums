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

    <?php include("partials/alerterror.php") ?>
    
    <?php include("components/slider.php") ?>
    <div class="container w-75" style="min-height: 63.5vh;">

        <!-- cards login start -->
        <?php include("components/cards.php") ?>

    </div>
    <?php include("components/footer.php") ?>
</body>

</html>