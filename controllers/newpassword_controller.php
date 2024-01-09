<?php

if (isset($_GET['selector']) && isset($_GET['validator'])) {
    $selector = $_GET['selector'];
    $validator = $_GET['validator'];

    // Assuming $db is your database connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $currentDate = date("U");

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error in the first query preparation.";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "si", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        // Fetch the result inside the loop
        if ($row = mysqli_fetch_assoc($result)) {
            $tokenEmail = $row['pwdResetEmail'];

            $sql = "SELECT * FROM users WHERE email=?";
            $stmt = mysqli_stmt_init($db);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "There was an error in the second query preparation.";
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                mysqli_stmt_execute($stmt);

                $result1 = mysqli_stmt_get_result($stmt);

                if (!$row = mysqli_fetch_assoc($result1)) {
                    echo "There was an error in fetching user data.";
                    exit();
                } 
            }

            if (isset($_POST['submit'])){

                // Validate and sanitize user input
                $newPassword = $_POST['new_password'];

                // Password hashing
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $sql = "UPDATE users SET password=? WHERE email=?";
                $stmt = mysqli_stmt_init($db);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "There was an error in the third query preparation.";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ss", $hashedNewPassword, $tokenEmail);
                    mysqli_stmt_execute($stmt);

                    // Delete the reset request from the pwdReset table
                    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                    $stmt = mysqli_stmt_init($db);

                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                        mysqli_stmt_execute($stmt);
                        echo "Your password has been reset successfully!";
                    } else {
                        echo "There was an error in the fourth query preparation.";
                    }
                }
            }
        }
        //  else {
        //     echo "You need to re-submit your reset request.";
        //     exit();
        // }
    }

    mysqli_close($db);
}
//  else {
//     echo "Invalid request: Selector or Validator not set.";
// }
?>