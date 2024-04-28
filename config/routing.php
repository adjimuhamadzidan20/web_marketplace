<?php 
    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'produk') {
            require 'pages/produk.php';
        } 
        else if ($_GET['page'] == 'keranjang') {
            require 'pages/keranjang.php';
        } 
        else if ($_GET['page'] == 'tokokami') {
            require 'pages/tokokami.php';
        } 
        else if ($_GET['page'] == 'login') {
            require 'pages/login.php';
        } 
        else if ($_GET['page'] == 'checkout') {
            require 'pages/checkout.php';
        } 
    } else {
        require 'pages/hero.php';
        require 'pages/produk.php';
    }

?>