<?php

//----------------------logout-------------------------------//
if (isset($_GET['logout'])) {
    session_destroy();
    session_unset();
    header('location: ../index.php');
    exit();
}

?>
