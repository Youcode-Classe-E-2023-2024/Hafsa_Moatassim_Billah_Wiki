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
        // % means 0 or more char before or after entered keyword
        $title = "%" . "$title" . "%";
        $sql = "SELECT * FROM artciles WHERE title LIKE :title AND archived=0";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
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
        $sql = "SELECT tags.*, artciles.* FROM articles_tag
                JOIN tag ON wiki_tag.tag_id = tag.tag_id
                JOIN wiki ON wiki_tag.wiki_id = wiki.wiki_id
                WHERE tag LIKE :tag";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":tag", $tag, PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }
}