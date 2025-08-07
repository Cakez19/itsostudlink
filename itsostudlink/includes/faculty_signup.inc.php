<?php

require_once 'config_session.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){

        $facultynum = $_POST['faculty_num'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['conpwd'];
        
        try {
            require_once 'db.php';
            require_once 'faculty_signup_model.inc.php';
            require_once 'faculty_signup_contr.inc.php';

            $errors = [];
            
            if (is_input_empty($facultynum, $email, $contact, $username, $password, $confirm_password)) {
                $errors["empty_input"] = "Please fill in all fields.";
            }
            if (is_password_mismatch($password, $confirm_password)) {
                $errors["password_mismatch"] = "Passwords do not match!";
            }
            if (!empty($email) && is_email_invalid($email)) {
                $errors["invalid_email"] = "Invalid email used!";
            }
            if (!empty($username) && is_username_taken($pdo, $username)) {
                $errors["username_taken"] = "Username already taken!";
            }
            if (!empty($email) && !isset($errors['invalid_email']) && is_email_registered($pdo, $email)) {
                $errors["email_used"] = "Email already registered!";
            }

            if($errors){
                $_SESSION["errors_signup"] = $errors;
                
                $signupData = [
                    "facultynum" => $facultynum,
                    "email" => $email,
                    "contact" => $contact,
                    "username" => $username
                ];
                $_SESSION["signup_data"] = $signupData;
                header("Location: ../faculty_signup.php");
                die();
            }

            create_faculty_user($pdo, $facultynum, $email, $contact, $username, $password);
            
            header("Location:../login.php?signup=success");
            
            $pdo = null;
            $stmt=null;
            die();
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
}
else{
    header("Location:../faculty_signup.php");
    die();
}