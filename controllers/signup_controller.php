<?php 

global $db;

if (isset($_POST["req"]) && $_POST["req"] == "submit") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    $file = $_FILES['picture']['name'];
    $uploadDir = 'assets/image/';
    $originalFileName = $_FILES['picture']['name'];
    $uploadFile = $uploadDir . basename($originalFileName);

    move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile);

    $errors = [
        "firstName_err" => Validation::validateUsername($firstname),
        "lastName_err" => Validation::validateUsername($lastname),
        "email_err" => Validation::validateEmail($email),
        "password_err" => Validation::validatePassword($password),
        "userexists_err" => Validation::checkIfUserExist($email, $db),
    ];

    if (array_filter($errors)) {
        // Handle errors
        echo json_encode(["errors" => $errors]);
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    User::register($firstname, $lastname, $email, $passwordHash, $file);
    echo json_encode(["success" => "User registered successfully"]);
    exit;
}





// if(isset($_POST['submit']) && isset($_FILES['pp']['name'])) {
//     $firstname = $_POST['firstname'];
//     $lastname = $_POST['lastname'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $file = $_FILES['pp']['name'];

//     $uploadDir = 'assets/image/';
//     $originalFileName = $_FILES['pp']['name'];
//     $uploadFile = $uploadDir . basename($originalFileName);

//     move_uploaded_file($_FILES['pp']['tmp_name'], $uploadFile);
//         $User = User::register($firstname, $lastname, $email, $password, $file);
//         header("location:index.php?page=login");

//     }
?>