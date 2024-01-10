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


   
    
}
