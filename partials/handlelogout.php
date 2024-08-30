<?php
session_status() === PHP_SESSION_NONE ? session_start() : null;
$method = $_SERVER['REQUEST_METHOD'];
$redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/forums/'; // Get the previous page URL or default to /forums/

if ($method == "POST") {

  session_unset();

  $_SESSION['logout_success'] = true;

  session_destroy();

  header("location: " . $redirect_url);
  exit();
}
