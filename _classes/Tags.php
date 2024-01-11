`<?php

class Tags
{
    public $tag_id;
    public $tag;


    public function __construct()
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

    static public function deleteTag($tag_id){
        global $db;
        $stmt = $db->prepare('DELETE FROM tags WHERE tag_id = :tag_id');
        $stmt->bindValue(':tag_id', $tag_id);
        $stmt->execute();
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
}