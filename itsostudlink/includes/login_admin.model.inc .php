<?php

declare(strict_types=1);

function get_user(object $pdo, string $username, string $usertype){
   
    $allowedTypes = ['student', 'faculty', 'admin'];
    if (!in_array($usertype, $allowedTypes)) {
        return false;
    }
    
    // Determine which table to query based on user type
    $table = '';
    switch($usertype) {
        case 'student':
            $table = 'student';
            break;
        case 'faculty':
            $table = 'faculty';
            break;
        case 'admin':
            $table = 'admin';
            break;
        
    }
    
 
    $username = trim($username);
    if (empty($username)) {
        return false;
    }
    
    $query = "SELECT * FROM {$table} WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_remember_me_token(object $pdo, int $user_id, string $token) {
    $query = "INSERT INTO auth_tokens (user_id, token) VALUES (:user_id, :token)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->execute();
}

function get_user_by_token(object $pdo, string $token) {
    $query = "SELECT u.* FROM admin u JOIN auth_tokens a ON u.id = a.user_id WHERE a.token = :token";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

