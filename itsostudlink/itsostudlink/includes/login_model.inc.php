<?php

declare(strict_types=1);

function get_user(object $pdo, string $username, string $usertype){
     $allowedTypes = ['student', 'faculty', 'admin'];
    if (!in_array($usertype, $allowedTypes)) {
        return false;
    }
    
    // Determine which table to query based on user type
    $table = '';
    switch($usertype){
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

function get_user_by_token(object $pdo, string $token) {
    $query = "SELECT u.* FROM student u JOIN auth_tokens a ON u.id = a.user_id WHERE a.token = :token";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

