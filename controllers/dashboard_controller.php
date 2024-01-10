<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $Tag = Tags::create($firstname, $lastname, $email, $password, $file);
    header("location:index.php?page=dashboard");
} else {
    header("location:index.php?page=wiki");
}
