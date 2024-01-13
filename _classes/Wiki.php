<?php

class Wiki
{
    public $id;

    public function __construct()
    {

    }

    // ************************************************** NEW ARTICLE

    static function NewWiki($title, $content, $file, $category, $id_user): bool
    {
        global $db;

        $user_id = 1;
        $category_id = 4;
        $query = "INSERT INTO articles (title, content, file, id_user, id_category) VALUES (:title, :content, :file, :id_user, :id_category)";
        $stm = $db->prepare($query);
        $stm->bindValue(':title', $title, PDO::PARAM_STR);
        $stm->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $stm->bindValue(':id_category', $category, PDO::PARAM_INT);
        $stm->bindValue(':content', $content, PDO::PARAM_STR);
        $stm->bindValue(':file', $file, PDO::PARAM_STR);
        $stm->execute();

        return true;
    }

    // ************************************************** GET ALL ARTICLES

    static function getAllarticles(): array
    {
        global $db;
        
        $result = $db->query("SELECT articles.*, users.firstname
        FROM articles
        JOIN users ON articles.id_user = users.id
        WHERE articles.status = 'published'
        ORDER BY create_at DESC;
        ");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // ************************************************** GET ONLY THE LAST 5 ARTICLES


    static function getTheLatestWiki(): array
    {
        global $db;
        
        $result = $db->query("SELECT articles.*, users.firstname
        FROM articles
        JOIN users ON articles.id_user = users.id
        WHERE articles.status = 'published'
        ORDER BY create_at DESC
        LIMIT 5;
        ");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }


    // ************************************************** GET ARTICLE BY ID

    static function getArticleById($articleId): ?array
    {
    global $db;
    $query = "SELECT * FROM articles WHERE id = :id";
    $stm = $db->prepare($query);
    $stm->bindValue(':id', $articleId, PDO::PARAM_INT);
    $exe = $stm->execute();

    if ($exe) {
        $result = $stm->fetch(PDO::FETCH_ASSOC);

        return $result !== false ? $result : null;
    } else {
        return null;
    }
    }


    // ************************************************** SOFT DELETE

    static function softDeleteArticle($id): bool
    {
        global $db;
    
        try {
            $stmt = $db->prepare("UPDATE articles SET status = 'archived' WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            $rowCount = $stmt->rowCount();
            
            return $rowCount > 0; 
        } catch (PDOException $e) {
            error_log("Error during soft delete: " . $e->getMessage());
            return false;
        }
    }
}