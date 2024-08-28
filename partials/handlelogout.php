<?php

session_status() === PHP_SESSION_NONE ? session_start() : null;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  session_unset();
  session_destroy();
  $myalert = true;
  $myalert = "logged out successfully ";
  if ($myalert) {
    echo '<div class=" alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success : </strong> ' . $myalert . '.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  !headers_sent() ? header("location: /forums/") : null;
}