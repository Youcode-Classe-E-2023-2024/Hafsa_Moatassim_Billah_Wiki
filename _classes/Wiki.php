<?php

class Wiki
{
    public $id;

    public function __construct()
    {

    }

    // ************************************************** NEW ARTICLE

    static function NewWiki($title, $content, $file, $category, $id_user): int
    {
        global $db;

        $query = "INSERT INTO articles (title, content, file, id_user, id_category) VALUES (:title, :content, :file, :id_user, :id_category)";
        $stm = $db->prepare($query);
        $stm->bindValue(':title', $title, PDO::PARAM_STR);
        $stm->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $stm->bindValue(':id_category', $category, PDO::PARAM_INT);
        $stm->bindValue(':content', $content, PDO::PARAM_STR);
        $stm->bindValue(':file', $file, PDO::PARAM_STR);
        $stm->execute();

        return $db->lastInsertId();    
    }

    // ************************************************** UPDATE ARTICLE

    static function updateWiki($articleId, $title, $content, $file, $category, $id_user): bool
    {
        global $db;
    
        $query = "UPDATE articles SET title = :title, content = :content, file = :file, id_user = :id_user, id_category = :id_category WHERE id = :articleId";
        $stm = $db->prepare($query);
        $stm->bindValue(':title', $title, PDO::PARAM_STR);
        $stm->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $stm->bindValue(':id_category', $category, PDO::PARAM_INT);
        $stm->bindValue(':content', $content, PDO::PARAM_STR);
        $stm->bindValue(':file', $file, PDO::PARAM_STR);
        $stm->bindValue(':articleId', $articleId, PDO::PARAM_INT);
    
        return $stm->execute();
    }
    
    // ************************************************** Users Articles

    static function getUserArticles($userId) {
        global $db;

        $query = "SELECT * FROM articles WHERE id_user = :user_id and status = 'published'";
        $stm = $db->prepare($query);
        $stm->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    // ************************************************** Insert to artciles_tag

    static function InsertTags($id_article , $id_tag): bool
        {
            global $db;
    
            $query = "INSERT INTO articles_tags (id_article, id_tag) VALUES (:id_article , :id_tag)";
            $stm = $db->prepare($query);
            $stm->bindValue(':id_article', $id_article, PDO::PARAM_STR);
            $stm->bindValue(':id_tag', $id_tag, PDO::PARAM_STR);
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
        ;
        ");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // ************************************************** Count the articles

    static function countAllArticles(): int
    {
        global $db;

        $query = "SELECT COUNT(*) FROM articles WHERE status = 'published'";
        $result = $db->query($query);

        return $result->fetchColumn();
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

        return $result;
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