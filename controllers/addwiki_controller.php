<?php 
if (!isset($_SESSION['id'])) {
    header("location: index.php?page=login");
}

if(isset($_POST['submit']) && isset($_FILES['img']['name'])) {
 
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $tags = $_POST['tags']; 
    $id = $_SESSION['id'];
    $file = $_FILES['img']['name'];

    $sanitizedIds = array_map('intval', $tags);
    $commaSeparatedIds = implode(',', $sanitizedIds);


    $uploadDir = 'assets/image/';
    $originalFileName = $_FILES['img']['name'];
    $uploadFile = $uploadDir . basename($originalFileName);

    move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile);
    
    $Wiki = Wiki::NewWiki($title, $content, $file, $category, $id);
    
    if ($Wiki !== null) {
        $tags = Wiki::InsertTags($Wiki, $commaSeparatedIds);
        
        if ($tags == true) {
            header("location:index.php?page=wiki");
        }
    }
}
?>
