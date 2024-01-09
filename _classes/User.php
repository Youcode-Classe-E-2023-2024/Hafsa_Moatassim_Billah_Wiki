<?php

class User
{   
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    private $password;
    public $file;

    public function __construct($id)
    {
        global $db;

        $stmt = $db->prepare("SELECT * FROM users WHERE users_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $this->id = $user['users_id'];
            $this->firstname = $user['firstname'];
            $this->lastname = $user['lastname'];
            $this->email = $user['email'];
            $this->password = $user['password'];
        }
    }

    // *************************ALL USER

    static function getAll()
    {
        global $db;
        $result = $db->query("SELECT * FROM users");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function edit()
    {
        global $db;
        return $db->query("UPDATE users SET email = '$this->email', firstname = '$this->firstname', lastname = '$this->lastname' WHERE users_id = '$this->id'");
    }

    // public function setPassword($pwd)
    // {
    //     $this->password = password_hash($pwd, PASSWORD_DEFAULT);
    // }

    // *************************NEW USER

    static function NewUser($firstname, $lastname, $email, $password, $file)
    {
        global $db;

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO users (firstname, lastname, email, password, file) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $firstname, $lastname, $email, $hashedPassword, $file);

        return $stmt->execute();
    }
    // *************************NEW ARTICLE

    static function NewWiki($title, $content, $file){
        global  $db;

        $query = ("INSERT INTO articles (title, content, file) VALUES ('$title', '$content', '$file')");

        return $db->query($query);
    }

    // *************************LOGIN

    static function login($email, $password)
    {
        global $db;

        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user['users_id'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    
}