`<?php

class Category
{
    public $cat_id;
    public $cat;


    public function __construct()
    {

    }

    public function getTags(){
        global $db;
        $tags = $db->query('SELECT * FROM tags');
        return $tags->fetchAll(PDO::FETCH_ASSOC);
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
        
        $result = $db->query("SELECT * FROM categories");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function edit($tag_id, $tag){
    //     $this->getTags();
    //     foreach ($tags as $tag) {
    //             $tag = $tag['tag'];
    //     }

    //     $this->query("UPDATE tags 
    //                         SET tag = :tag, 
    //                         WHERE tag_id = :tag_id");
    //     $this->bind(':tag', tag_id);
    //     $this->bind(':tag_id', $tag_id);

    //     $this->execute();
    // }


    static public function deleteCat($tag_id){
        global $db;
        $stmt = $db->prepare('DELETE FROM categories WHERE cat_id = :cat_id');
        $stmt->bindValue(':tag_id', $tag_id);
        $stmt->execute();
    }

}