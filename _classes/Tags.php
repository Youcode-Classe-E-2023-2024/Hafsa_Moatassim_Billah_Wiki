`<?php

class Tags
{
    public $tag_id;
    public $tag;


    public function __construct()
    {

    }

    public function getTags(){
        global $db;
        $tags = $db->query('SELECT * FROM tags');
        return $tags->fetchAll(PDO::FETCH_ASSOC);
    }

    static function create($tag){
        global $db;
        $stmt = $db->prepare('INSERT INTO tags (tag) VALUES (:tag)');
        $stmt->bindValue(':tag', $tag, PDO::PARAM_STR);
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


    public function delete($tag_id){
        global $db;
        $stmt = $db->prepare('DELETE FROM tags WHERE tag_id = :tag_id');
        $stmt->bindValue(':tag_id', $tag_id);
        $stmt->execute();
    }

}