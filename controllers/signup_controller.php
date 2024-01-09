<?php 

if(isset($_POST['submit']) && isset($_FILES['pp']['name'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $file = $_FILES['pp']['name'];

    $uploadDir = 'assets/image/';
    $originalFileName = $_FILES['pp']['name'];
    $uploadFile = $uploadDir . basename($originalFileName);

    move_uploaded_file($_FILES['pp']['tmp_name'], $uploadFile);
        $User = User::NewUser($firstname, $lastname, $email, $password, $file);
        header("location:index.php?page=login");

    }
?>