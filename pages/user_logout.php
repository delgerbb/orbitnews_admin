<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$past = time() - 3600;
foreach ($_COOKIE as $key => $value) {
    setcookie($key, $value, $past, '/');
}

$helper = array_keys($_SESSION);
foreach ($helper as $key) {
    unset($_SESSION[$key]);
}

header('location: ' . WEBROOT);

