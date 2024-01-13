<?php

class Tags
{
    public $tag_id;
    public $tag;
    public $id;
    public $name;

    public function __construct($id)
    {
      
    }

    static function create($tag){
        global $db;
        $stmt = $db->prepare('INSERT INTO tags (name) VALUES (:tagName)');
        $stmt->bindValue(':tagName', $tag, PDO::PARAM_STR);
        $stmt->execute();
    }

    static function getAllTags() : array
    {
        global $db;
        
        $result = $db->query("select * from tags ORDER BY id DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getTagById($ID): ?array
    {
        global $db;
        $query = "SELECT * FROM tags WHERE id IN (SELECT id_tag FROM articles_tags WHERE id_article = :id)";
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $ID, PDO::PARAM_INT);
        $exe = $stm->execute();
    
        if ($exe) {
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    
            return $result !== false ? $result : null;
        } else {
            return null;
        }
    }
    

    static function deleteTag($id) : bool
    {
        global $db;
        $query = "delete from tags WHERE id = :id";
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $id, PDO::PARAM_INT);

        return $stm->execute();
    }

    static function updateTag($id, $newName) : bool
    {
        global $db;
        $query = "UPDATE tags SET name = :newName WHERE id = :id";
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $id, PDO::PARAM_INT);
        $stm->bindValue(':newName', $newName, PDO::PARAM_STR);

        return $stm->execute();
    }
    
     // ************************************************** Count Tags

     static function countAllTag(): int
     {
         global $db;

         $query = "SELECT COUNT(*) FROM tags";
         $result = $db->query($query);

         return $result->fetchColumn();
     }
}