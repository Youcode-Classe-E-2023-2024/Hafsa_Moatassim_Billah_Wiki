<?php

if (isset($_GET['logout'])) {
    session_destroy();
    header('location: index.php?page=home');
    exit(); 
}