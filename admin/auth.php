<?php
/**
 * SuperMax Auto Admin - Authentication Functions
 */
session_start();

// Check if user is logged in
function isLoggedIn()
{
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

// Require login - redirect if not logged in
function requireLogin()
{
    if (!isLoggedIn()) {
        header('Location: index.php');
        exit;
    }
}

// Login function
function login($username, $password)
{
    require_once '../config/database.php';

    $user = fetchOne("SELECT * FROM admin_users WHERE username = ?", [$username]);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $user['username'];
        $_SESSION['admin_id'] = $user['id'];
        return true;
    }
    return false;
}

// Logout function
function logout()
{
    session_destroy();
    header('Location: index.php');
    exit;
}
?>