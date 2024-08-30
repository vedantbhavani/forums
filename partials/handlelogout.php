<?php
session_status() === PHP_SESSION_NONE ? session_start() : null;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  session_unset();
  $myalert = true;
  $_SESSION['logout_success'] = true;
  !headers_sent() ? header("location: /forums/") : null;
  session_destroy();
}