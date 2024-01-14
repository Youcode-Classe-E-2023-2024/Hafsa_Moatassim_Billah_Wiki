<?php

if(isset($_POST["search_tag"])) {
    $input_value = $_POST["search_title"];
    $searchTag = $_POST["search_tag"];
    switch ($searchTag) {
        case "Tags":       
            $searchedData = Search::searchForTags($input_value);
            echo json_encode($searchedData);
            exit;
            break;

        case "Title":       
            $searchedData = Search::searchForTitles($input_value);
            echo json_encode($searchedData);
            exit;
            break;

        case "Category":       
            $searchedData = Search::searchForCat($input_value);
            echo json_encode($searchedData);
            exit;
            break;
    }
}
