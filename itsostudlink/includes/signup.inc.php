<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = $_POST['firstname'];
    $lastname = $_POST ['lastname'];
    $studentnum = $_POST['studentnum'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $year_level = $_POST['year_level'];
    $section = $_POST['section'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['conpwd'];

    require_once 'db.php';
    require_once 'signup_model.inc.php';
    require_once 'signup_contr.inc.php';
    require_once 'config_session.inc.php';

    $errors = [];

    // Basic validation
    if (is_input_empty($firstname, $lastname, $studentnum, $email, $contact, $year_level, $section, $username, $password, $confirm_password)) {
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

    // If errors exist from validation, redirect back with session
    if ($errors) {
        $_SESSION["errors_signup"] = $errors;
        $_SESSION["signup_data"] = [
            "firstname" => $firstname,
            "lastname" => $lastname,
            "studentnum" => $studentnum,
            "email" => $email,
            "contact" => $contact,
            "year_level" => $year_level,
            "section" => $section,
            "username" => $username
        ];
        header("Location: ../signup.php");
        die();
    }

    // Try inserting user into database
    try {
        set_user($pdo, $firstname, $lastname, $studentnum, $email, $contact, $year_level, $section, $username, $password);
        header("Location: ../login.php?signup=success");
        die();
    } catch (PDOException $e) {
        $errorCode = $e->getCode();
        $errorMsg = $e->getMessage();

        // Handle duplicate entry errors
        if ($errorCode == 23000) {
            if (str_contains($errorMsg, 'studentnum')) {
                $errors["studentnum_taken"] = "Student number already exists.";
            } elseif (str_contains($errorMsg, 'email')) {
                $errors["email_taken"] = "Email already exists.";
            } elseif (str_contains($errorMsg, 'username')) {
                $errors["username_taken"] = "Username already exists.";
            } else {
                $errors["duplicate"] = "Duplicate entry error.";
            }
        } else {
            $errors["db_error"] = "Unexpected database error: " . $errorMsg;
        }

        // Redirect back with errors
        $_SESSION["errors_signup"] = $errors;
        $_SESSION["signup_data"] = [
            "firstname" => $firstname,
            "lastname" => $lastname,
            "studentnum" => $studentnum,
            "email" => $email,
            "contact" => $contact,
            "year_level" => $year_level,
            "section" => $section,
            "username" => $username
        ];
        header("Location: ../signup.php");
        die();
    }

} else {
    header("Location: ../signup.php");
    die();
}
