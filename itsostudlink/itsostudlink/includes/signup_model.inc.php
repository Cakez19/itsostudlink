<?php
declare(strict_types=1);
function get_username(object $pdo, string $username){

    $query ="SELECT username FROM student WHERE username= :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function get_email(object $pdo, string $email){

    $query ="SELECT email FROM student WHERE email= :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function set_user(object $pdo, string $firstname, string $lastname, string $studentnum,string $email,string $contact, string $year_level, string $section,string $username,string $password){
    
    $query = "INSERT INTO student (firstname, lastname, studentnum, email, contact, year_level, section,username, password) VALUES
    (:firstname, :lastname, :studentnum, :email, :contact, :year_level, :section, :username, :password);";
    $stmt = $pdo -> prepare($query);

    $options =[
        'cost'=>12
    ];
    $hashed_pwd= password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':studentnum', $studentnum);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':year_level', $year_level);
    $stmt->bindParam(':section', $section);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_pwd);
    $stmt->execute();
}