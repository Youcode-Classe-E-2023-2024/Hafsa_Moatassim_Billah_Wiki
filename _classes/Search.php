<?php

class Search
{

    /**
     * @param $title
     * @return mixed
     * this function searches for titles of the same keyword entered by user
     */
    static function searchForTitles($title)
    {
        global $db;
        // % means 0 or more characters before or after the entered keyword
        $sql = "SELECT * FROM articles WHERE (title LIKE :title AND status = 'published')";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $title = '%' . $title . '%';  // Add % to the title variable
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $res;
    }
    

    /**
     * @param $tag
     * @return mixed
     * this function searches for tags of the same keyword entered by user
     */
    static function searchForTags($tag)
    {
        global $db;
    
        // % means 0 or more char before or after entered keyword
        $tag = "%" . "$tag" . "%";
        $sql = "SELECT tags.*, articles.* FROM articles_tags
                JOIN tags ON articles_tags.id_tag = tags.id
                JOIN articles ON articles_tags.id_article = articles.id
                WHERE tags.name LIKE :tag";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":tag", $tag, PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $res;
    }
    
    static function searchForCat($cat)
    {
        global $db;
    
        // % means 0 or more char before or after entered keyword
        $cat = "%" . "$cat" . "%";
        $sql = "SELECT categories.*, articles.* FROM articles
                JOIN categories ON categories.id = articles.id_category
                WHERE categories.name LIKE :cat";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":cat", $cat, PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $res;
    }
}