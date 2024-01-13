<?php 
if (!isset($_SESSION['id'])) {
    header("location: index.php?page=login");
}

if(isset($_POST['submit']) && isset($_FILES['img']['name'])) {
 
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    // $tags = $_POST['tags[]'];
    $file = $_FILES['img']['name'];

    $uploadDir = 'assets/image/';
    $originalFileName = $_FILES['img']['name'];
    $uploadFile = $uploadDir . basename($originalFileName);

    move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile);
        $id= $_SESSION['id'];
        $Wiki = Wiki::NewWiki($title, $content, $file, $category, $id);
        header("location:index.php?page=wiki");

    }
?>