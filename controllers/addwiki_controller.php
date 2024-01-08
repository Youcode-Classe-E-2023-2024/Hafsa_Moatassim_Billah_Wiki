<?php 

if(isset($_POST['submit']) && isset($_FILES['img']['name'])) {
    $username = $_POST['title'];
    $email = $_POST['content'];
    $file = $_FILES['img']['name'];

    $uploadDir = 'assets/image/';
    $originalFileName = $_FILES['img']['name'];
    $uploadFile = $uploadDir . basename($originalFileName);

    move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile);
        $User = User::NewWiki($title, $content, $file);
        header("location:index.php?page=wiki");

    }
?>