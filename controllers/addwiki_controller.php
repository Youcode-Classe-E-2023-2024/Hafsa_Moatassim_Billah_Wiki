<?php 
if (!isset($_SESSION['x'])) {
    header("location: index.php?page=login");
}

if(isset($_POST['submit']) && isset($_FILES['img']['name'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $file = $_FILES['img']['name'];

    $uploadDir = 'assets/image/';
    $originalFileName = $_FILES['img']['name'];
    $uploadFile = $uploadDir . basename($originalFileName);

    move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile);
        $Wiki = User::NewWiki($title, $content, $file);
        header("location:index.php?page=wiki");

    }
?>