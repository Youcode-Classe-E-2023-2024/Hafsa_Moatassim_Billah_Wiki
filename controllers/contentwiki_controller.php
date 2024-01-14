<?php 
        $ID = $_GET['id'];

        $wiki = Wiki::getArticleById($ID);

        $getTagById = Tags::getTag($wiki['id']);

        $tagIdsArray = explode(',', $getTagById[0]['id_tag']);
        $newTagsArray = [];

         foreach($tagIdsArray as $key => $value){       
           $getsametags = Tags::getAllTagsById($value);

                foreach ($getsametags as $tag) {
                array_push($newTagsArray, $tag['name']);
                }
        }
       
?>