<?php 

// Delete User

if (isset($_GET['delete_id'])) {
    $userIdToDelete = $_GET['delete_id'];
    
    $deleted = User::deleteUser($userIdToDelete);

    if ($deleted) {
        header('location:index.php?page=dashboard');
    } else {
        echo "Error deleting user.";
    }
}

// Soft delete article

if (isset($_GET['softdelete_id'])) {
    $articleIdToDelete = $_GET['softdelete_id'];
    
    $deleted = Wiki::softDeleteArticle($articleIdToDelete);

    if ($deleted) {
        header('location:index.php?page=dashboard');
    } else {
        echo "Error deleting article.";
    }
}

// Delete Tag

if (isset($_GET['tagdelete_id'])) {
    $tagIdToDelete = $_GET['tagdelete_id'];
    
    $deleted = Tags::deleteTag($tagIdToDelete);

    if ($deleted) {
        header('location:index.php?page=dashboard');
    } else {
        // echo "Error deleting tag.";
    }
}

// Delete Category

if (isset($_GET['catdelete_id'])) {
    $catIdToDelete = $_GET['catdelete_id'];
    
    $deleted = Category::deleteCat($catIdToDelete);

    if ($deleted) {
        header('location:index.php?page=dashboard');
    } else {
        // echo "Error deleting category.";
    }
}

// if (isset($_GET['article_delete_id'])) {
//     $articleIdToDelete = $_GET['article_delete_id'];

//     $article = Wiki::getArticleById($articleIdToDelete);
//     $userId = $_SESSION['id'];
//     $isAdmin = User::getAdmin($userId);

//     if ($article['user_id'] == $userId || $isAdmin) {

//         $deleted = Wiki::softDeleteArticle($articleIdToDelete);

//         if ($deleted) {
//             header('location:index.php?page=dashboard');
//         } else {
//         }
//     } else {
//         header('location:unauthorized.php');
//     }
// }

?>