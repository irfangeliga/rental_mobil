<?php
if (isset($_GET['url'])) {
    $url = $_GET['url'];

    switch ($url) {

        case 'data-mobil';
            include 'data-mobil.php';
            break;

        case 'data-user';
            include 'data-user.php';
            break;

        default:
            include 'read.php';
            break;
    }
}
?>