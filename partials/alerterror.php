<?php
    if ($myalert) {
        echo '<div class=" alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success : </strong> ' . $myalert . '.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if ($myerror) {
        echo '<div class=" alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error : </strong>' . $myerror . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
?>