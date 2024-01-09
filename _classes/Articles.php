<?php

// class ArticleManager {
//     private $db;

//     public function __construct($db) {
//         $this->db = $db;
//     }

//     public static function NewWiki($title, $content, $file) {
//         $query = "INSERT INTO articles (title, content, file) VALUES (?, ?, ?)";
        
//         $stmt = $this->db->prepare($query);
//         $stmt->bind_param("sss", $title, $content, $file);

//         if ($stmt->execute()) {
//             return true;
//         } else {
//             // Handle the error appropriately, e.g., log it or return false
//             return false;
//         }
//     }
// }