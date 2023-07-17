<?php
if (isset($_GET['url'])) {
    $url = $_GET['url'];

    switch ($url) {
        case 'input';
            include 'input.php';
            break;

        case 'read-mobil';
            include 'read-mobil.php';
            break;

        default:
            include 'read.php';
            break;
    }
}
?>