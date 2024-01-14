<?php 

global $db;
    
if(isset($_FILES['picture'])){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $file = $_FILES['picture']['name'];
    $uploadDir = 'assets/image/';
    $originalFileName = $_FILES['picture']['name'];
    $uploadFile = $uploadDir . basename($originalFileName);
    move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile);

    $imgExtenion = explode('.', $file);
    $Allowed = strtolower(end($imgExtenion));
    $Extenion = array('jpg', 'jpeg','png');

    if(in_array($Allowed, $Extenion) === true){
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        User::register($firstname, $lastname, $email, $passwordHash, $file);
        echo json_encode(["success" => "User registered successfully"]);
        exit;
    }
        $errors = [
            "firstName_err" => Validation::validateFirstname($firstname),
            "lastName_err" => Validation::validateLastname($lastname),
            "email_err" => Validation::validateEmail($email),
            "password_err" => Validation::validatePassword($password),
            "userexists_err" => Validation::checkIfUserExist($email),
            "file_err" =>'you can not upload this type of image',
            ];
    
            if (array_filter($errors)) {
                echo json_encode(["errors" => $errors]);
                exit;
            }
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