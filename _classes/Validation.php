<?php

class Validation
{

    static function validateFirstname($Firstname)
    {
        if (empty($Firstname)) {
            return "Username is required";
        } elseif (!preg_match('/^[a-zA-Z0-9]{3,}$/', $Firstname)) {
            return "Invalid firstname. firstname should be at least 3 characters long.";
        }
        return false;
    } 

    static function validateLastname($Lastname)
    {
        if (empty($Lastname)) {
            return "Username is required";
        } elseif (!preg_match('/^[a-zA-Z0-9]{3,}$/', $Lastname)) {
            return "Invalid lastname. Lastname should be at least 3 characters long.";
        }
        return false;
    }

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
    
    static function validateEmail($email)
    {
        if (empty($email)) {
            return "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format.";
        }
        return false;
    }

    static function validatePassword($password)
    {
        if (empty($password)) {
            return "Password is required";
        } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)) {
            return "Invalid password. Password should have at least 8 characters, including one uppercase letter, one lowercase letter, and one number.";
        }
        return false;
    }

}