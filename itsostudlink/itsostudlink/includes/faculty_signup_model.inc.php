<?php
declare(strict_types=1);
function get_username(object $pdo, string $username){

    $query ="SELECT username FROM faculty WHERE username= :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function get_email(object $pdo, string $email){

    $query ="SELECT email FROM faculty WHERE email= :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function create_faculty_user(object $pdo, string $facultynum,string $email,string $contact,string $username,string $password){
    
    $query = "INSERT INTO faculty (facultynum, email, contact, username, password) VALUES
    (:facultynum, :email, :contact, :username, :password);";
    $stmt = $pdo -> prepare($query);

    $options =[
        'cost'=>12
    ];
    $hashed_pwd= password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(':facultynum', $facultynum);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_pwd);
    $stmt->execute();
}