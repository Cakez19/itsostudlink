<?php

declare(strict_types=1);


function is_input_empty(string $facultynum, string $email, string $contact, string $username, string $password, string $confirm_password){

    if(empty($facultynum) || empty($email) || empty($contact) || empty($username) || empty($password) || empty($confirm_password)){
        return false;
    }else{
        return true;
    }
}

function is_password_mismatch(string $password, string $confirm_password){

    if($password === $confirm_password){
        return true;
    }else{
        return false;
    }
}

function is_email_invalid(string $email){

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}

function is_username_taken(object $pdo, string $username){

    if(get_username($pdo, $username)){
        return true;
    }else{
        return false;
    }
}

function is_email_registered(object $pdo, string $email){

    if(get_email($pdo, $email)){
        return true;
    }else{
        return false;
    }
}
function create_user( object $pdo, string $facultynum,string $email,string $contact,string $username,string $password){
    create_faculty_user( $pdo,$facultynum,
        $email,
      $contact,
           $username,
            $password);
 }

