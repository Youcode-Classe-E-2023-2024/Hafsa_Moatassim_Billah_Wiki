`<?php

class Category
{
    public $cat_id;
    public $cat;


    public function __construct()
    {

    }

    static function CreateCat($cat){
        global $db;
        $stmt = $db->prepare('INSERT INTO categories (name) VALUES (:catName)');
        $stmt->bindValue(':catName', $cat, PDO::PARAM_STR);
        $stmt->execute();
    }

    static function getAllCats(): array
    {
        global $db;
        
        $result = $db->query("SELECT * FROM categories ORDER BY id DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getCatById($catId): ?array
    {
    global $db;
    $query = "SELECT * FROM categories WHERE id = :id";
    $stm = $db->prepare($query);
    $stm->bindValue(':id', $catId, PDO::PARAM_INT);
    $exe = $stm->execute();

    if ($exe) {
        $result = $stm->fetch(PDO::FETCH_ASSOC);

        return $result !== false ? $result : null;
    } else {
        return null;
    }
    }
    
    static function deleteCat($id) : bool
    {
        global $db;
        $query = "delete from categories WHERE id = :id";
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $id, PDO::PARAM_INT);

        return $stm->execute();
    }

    static function updateCat($id, $newName) : bool
    {
        global $db;
        $query = "UPDATE categories SET name = :newName WHERE id = :id";
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $id, PDO::PARAM_INT);
        $stm->bindValue(':newName', $newName, PDO::PARAM_STR);

        return $stm->execute();
    }
}
