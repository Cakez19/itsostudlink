<?php
declare(strict_types=1);

function signup_inputs() {
    if (isset($_SESSION["signup_data"]["studentnum"])) {
        echo '<div class="input-group"><label for="studentnum">Student Number</label><input type="text" id="studentnum" name="studentnum" value="' . htmlspecialchars($_SESSION["signup_data"]["studentnum"]) . '"></div>';
    } else {
        echo '<div class="input-group"><label for="studentnum">Student Number</label><input type="text" id="studentnum" name="studentnum"></div>';
    }

    if (isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["invalid_email"]) && !isset($_SESSION["errors_signup"]["email_used"])) {
        echo '<div class="input-group"><label for="email">Email</label><input type="email" id="email" name="email" value="' . htmlspecialchars($_SESSION["signup_data"]["email"]) . '"></div>';
    } else {
        echo '<div class="input-group"><label for="email">Email</label><input type="email" id="email" name="email"></div>';
    }

    if (isset($_SESSION["signup_data"]["contact"])) {
        echo '<div class="input-group"><label for="contact">Contact Number</label><input type="text" id="contact" name="contact" value="' . htmlspecialchars($_SESSION["signup_data"]["contact"]) . '"></div>';
    } else {
        echo '<div class="input-group"><label for="contact">Contact Number</label><input type="text" id="contact" name="contact"></div>';
    }

    if (isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["errors_signup"]["username_taken"])) {
        echo '<div class="input-group"><label for="username">Username</label><input type="text" id="username" name="username" value="' . htmlspecialchars($_SESSION["signup_data"]["username"]) . '"></div>';
    } else {
        echo '<div class="input-group"><label for="username">Username</label><input type="text" id="username" name="username"></div>';
    }
}

function check_signup_errors(){
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];

        echo"<br>";

        foreach ($errors as $error){
            echo '<p class="form-error">'. $error.'</p>';
        }
        unset($_SESSION['errors_signup']);
    } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<br><p class="form-success">Signup success!</p>';
    }
}