<?php

if(isset($_POST['reset-request-submit'])){
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://localhost/Hafsa_Moatassim_Billah_Alpha/index.php?page=newpassword&&selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;

    $userEmail = $_POST['email'];
    
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($db);

    if(!mysqli_stmt_prepare($stmt, $checkEmailQuery)){
        echo "there was an error";
        exit();
    }else{
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result)){

        //delete existing reset requests for this email
        $deleteQuery = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
        $stmt = mysqli_stmt_init($db);

            if(!mysqli_stmt_prepare($stmt,$deleteQuery)){
                echo "there was an error";
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, "s", $userEmail);
                mysqli_stmt_execute($stmt);
                }

        //inserting into table
        $insertQuery = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($db);

            if(!mysqli_stmt_prepare($stmt,$insertQuery)){
                echo "there was an error";
                exit();
                }else{
                    // $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                
                    mysqli_stmt_bind_param($stmt, "sssi", $userEmail ,$selector, $token, $expires);
                    mysqli_stmt_execute($stmt);
                }

            mysqli_stmt_close($stmt);

            $mail = new MailSender();
            $mail->Send($userEmail, $url);
        }else{
            echo "Email does not exist in our database";
        }
    }
}


?>



