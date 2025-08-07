<?php


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../login.php");
    exit;
}
require_once 'config_session.inc.php';
require_once 'db.php';
require_once 'login_model.inc.php';
require_once 'login_contr.inc.php';
require_once 'login_view.inc.php';

$username   = trim($_POST['username'] ?? '');
$password   = $_POST['password'] ?? '';
$usertype   = $_POST['user-type'] ?? '';
$loginType  = $_POST['login_type'] ?? '';


$redirectMap = [
    'student' => '../student_login.php',
    'faculty' => '../faculty_login.php',
    'admin' => '../admin_login.php'
];

$dashboardMap = [
    'student' => '../student/student_dashboard.php',
    'faculty' => '../faculty/faculty_dashboard.php',
    'admin' => '../admin/admin_dashboard.php'
];


$errors = [];

if (empty($username) || empty($password)) {
    $errors['empty'] = "Please fill in all required fields.";
} else {
    $user = get_user($pdo, $username, $loginType);

    if (!$user) {
        $errors['username'] = "Username not found.";
    } elseif (password_verify($password, $user['password'])) {
        $errors['password'] = "Incorrect password.";
    }
}

if (!empty($errors)) {
    $_SESSION['errors_login'] = $errors;
    $_SESSION['form_data'] = ['username' => htmlspecialchars($username), 'login_type' => $loginType];
    header("Location: " . ($redirectMap[$loginType] ));
    exit;
}


session_regenerate_id(true);
$_SESSION['user_id']       = $user['id'];
$_SESSION['user_username'] = htmlspecialchars($user['username']);
$_SESSION['user_type']     = $usertype;
$_SESSION['last_regeneration'] = time();

if ($usertype === 'faculty') {
    $_SESSION['faculty_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
}

header("Location: " . ($dashboardMap[$usertype] ?? '../index.php'));
exit;
