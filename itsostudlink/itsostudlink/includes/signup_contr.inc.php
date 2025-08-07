<?php
declare(strict_types=1);

function is_input_empty(  string $firstname, string $lastname, string $studentnum, string $email, string $contact,  string $yearlvl,   string $section, string $username, string $password, string $confirm_password){
    if (empty($firstname) || empty($lastname) || empty($studentnum) || empty($contact) || empty($email) || empty($yearlvl) || empty($section) || empty($username) || empty($password) || empty($confirm_password) ){
        return false;
    }
    else{
        return true;
    }
}

function is_password_mismatch(string $password, string $confirm_password){
    if ($password === $confirm_password){
        return true;
    }
    else{
        return false;
    }
}
function is_email_invalid( string $email){
    if (!filter_var( $email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else{
        return false;
    }
}
function is_username_taken( object $pdo, string $username){
   if(get_username($pdo,  $username)){
        return true;
    }
    else{
        return false;
    }
}

function is_email_registered( object $pdo, string  $email){
    if(get_email($pdo,  $email)){
        return true;
    }else return false;
 }
 function create_user( object $pdo, string $firstname, string $lastname, string $studentnum,string $email,string $contact,string  $year_level, string  $section,string $username,string $password){
    set_user( $pdo,$firstname, $lastname, $studentnum,
        $email,
      $contact,
        $year_level,
          $section,
           $username,
            $password);
 }