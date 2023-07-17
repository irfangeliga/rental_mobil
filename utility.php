<?php

function getApp($link)
{
    $auth = '&user=' . $_SESSION['user'] . '&pass=' . $_SESSION['pass'];
    $links = "http://localhost/mobil/rest/api.php?function=" . $link . $auth;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $links);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $output = json_decode($output);
    // echo $links;
    return $output;
}

function getAdmin($link)
{
    // $auth = '&user=' . $_SESSION['user'] . '&pass=' . $_SESSION['pass'];
    $links = "http://localhost/mobil/rest/api.php?function=" . $link ;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $links);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $output = json_decode($output);
    // echo $links;
    return $output;
}
