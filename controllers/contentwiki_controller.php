<?php 
        // $id = $_SESSION['id'];
        $ID = $_GET['id'];

        $wiki = Wiki::getArticleById($ID);
    
        
?>