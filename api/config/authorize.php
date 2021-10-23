<?php
    $auth = $_SESSION['authorize'] = 1;
    if ($auth == 0){
        exit();
    }
?>