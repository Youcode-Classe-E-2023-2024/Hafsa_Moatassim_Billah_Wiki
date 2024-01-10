<?php

class User
{

    public $id;
    public $email;
    public $username;
    public $image;
    public $role;
    private $password;

    public function __construct($id)
    {
        global $db;

        $query = "SELECT * FROM users WHERE id = :id";
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $id, PDO::PARAM_INT);
        $stm->execute();
        $user = $stm->fetch(PDO::FETCH_ASSOC);

        if ($user !== false > 0) {
            $this->id = $user['id'];
            $this->email = $user['email'];
            $this->username = $user['firstname'];
            $this->username = $user['lastname'];
            $this->password = $user['password'];
            $this->image = $user['pp'];
            $this->role = $user['role'];
        }
    }
    // ************************************************** GET USER

    static function getAll(): array
    {
        global $db;
        
        $result = $db->query("select * from users where role = 'author'");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    // ************************************************** GET ADMIN

    static function getAdmin(): array
    {
        global $db;
        
        $result = $db->query("select * from users where role = 'admin'");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // ************************************************** UPDATE USER

    function edit(): bool
    {
        global $db;
        $query = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, file = :pp WHERE id = :id";
        $stm = $db->prepare($query);
        $stm->bindValue(':firstname', $this->username, PDO::PARAM_STR);
        $stm->bindValue(':lastname', $this->username, PDO::PARAM_STR);
        $stm->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stm->bindValue(':file', $this->image, PDO::PARAM_STR);
        $stm->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stm->execute();
    }


    public function setPassword($pwd)
    {
        $this->password = password_hash($pwd, PASSWORD_DEFAULT);
    }

// ************************************************** NEW USER

    /**
     * @throws Exception
     */
    static function register($firstname, $lastname, $email, $password, $file): bool
    {
        global $db;

        if (self::checkIfUserExist($email)) {
            return false;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (firstname, lastname, email, password, file) VALUES (:firstname,:lastname, :email, :password, :file)";
        $stm = $db->prepare($query);
        $stm->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $stm->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $stm->bindValue(':email', $email, PDO::PARAM_STR);
        $stm->bindValue(':password', $hashed_password, PDO::PARAM_STR);
        $stm->bindValue(':file', $file, PDO::PARAM_STR);

        $execution = $stm->execute();

        return true;
    }

// ************************************************** CHEKING USER IF EXIST

    /**
     * @throws Exception
     */
    static function checkIfUserExist($email)
    {
        global $db;
        $query = "SELECT * FROM users WHERE email = :email";
        $stm = $db->prepare($query);
        $stm->bindValue(':email', $email, PDO::PARAM_STR);
        $exe = $stm->execute();

        if ($exe) {
            return $stm->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }


    // ************************************************** LOGIN
    /**
     * @throws Exception
     */
    static function login($email, $password)
    {
        $user = self::checkIfUserExist($email);
        if ($user !== false) {
            if (password_verify($password, $user['password'])) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // ************************************************** NEW ARTICLE

    static function NewWiki($title, $content, $file): bool
    {
        global $db;

        $user_id = 1;
        $category_id = 1;
        $query = "INSERT INTO articles (title, content, file, id_user, id_category) VALUES (:title, :content, :file, :id_user, :id_category)";
        $stm = $db->prepare($query);
        $stm->bindValue(':title', $title, PDO::PARAM_STR);
        $stm->bindValue(':id_user', $user_id, PDO::PARAM_INT);
        $stm->bindValue(':id_category', $category_id, PDO::PARAM_INT);
        $stm->bindValue(':content', $content, PDO::PARAM_STR);
        $stm->bindValue(':file', $file, PDO::PARAM_STR);
        $execution = $stm->execute();

        return true;
    }

    // ************************************************** GET ALL ARTICLES

    static function getAllarticles(): array
    {
        global $db;
        
        $result = $db->query("SELECT * FROM articles WHERE status = 'published'");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // ************************************************** GET ONLY THE LAST 5 ARTICLES

    static function getTheLatestWiki(): array
    {
        global $db;
        
        $result = $db->query("SELECT * FROM articles ORDER BY create_at DESC LIMIT 5");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // ************************************************** GET ARTICLE BY ID

    static function getArticleById($articleId): ?array
    {
    global $db;
    $query = "SELECT * FROM articles WHERE id = :id";
    $stm = $db->prepare($query);
    $stm->bindValue(':id', $articleId, PDO::PARAM_INT);
    $exe = $stm->execute();

    if ($exe) {
        $result = $stm->fetch(PDO::FETCH_ASSOC);

        return $result !== false ? $result : null;
    } else {
        return null;
    }
    }

    // ************************************************** SOFT DELETE

    static function softDeleteArticle($id): bool
    {
        global $db;
    
        try {
            $stmt = $db->prepare("UPDATE articles SET status = 'archived' WHERE id_user = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            $rowCount = $stmt->rowCount();
            
            return $rowCount > 0; 
        } catch (PDOException $e) {
            error_log("Error during soft delete: " . $e->getMessage());
            return false;
        }
    }
    
}
