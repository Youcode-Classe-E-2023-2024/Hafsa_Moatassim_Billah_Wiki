<?php

// Tag add
if (isset($_POST['tagSubmit'])) {
    $tagName = $_POST['tagName'];
    $Tage = Tags::create($tagName);
    header("location:index.php?page=dashboard");
}

// Tag cat
if (isset($_POST['submite'])) {
    $name = $_POST['namee'];
    $cat = Category::CreateCat($name);
    header("location:index.php?page=dashboard");
}