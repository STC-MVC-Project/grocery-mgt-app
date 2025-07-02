<?php
 session_start(); 

 function isLoggedIn() { return isset($_SESSION['user']); } 

 function requireLogin() { 
     if (!isLoggedIn()) { 
         header('Location: index.php?action=login'); 
         exit(); 
     } 
 } 

 function loginUser($username, $password, $remember = false) { 
     require './db.php'; 
     $stmt = $db->prepare("SELECT * FROM users WHERE username = ?"); 
     $stmt->execute([$username]); 
     $user = $stmt->fetch(PDO::FETCH_ASSOC); 

     if ($user && password_verify($password, $user['password'])) { 
         $_SESSION['user'] = $user; 
         if ($remember) { 
             setcookie("remember_user", $username, time() + (86400 * 30), "/"); 
         } 
         return true; 
     } 
     return false; 
 } 

 function autoLogin() { 
     if (!isset($_SESSION['user']) && isset($_COOKIE['remember_user'])) { 
         require './db.php'; 
         $stmt = $db->prepare("SELECT * FROM users WHERE username = ?"); 
         $stmt->execute([$_COOKIE['remember_user']]); 
         $user = $stmt->fetch(PDO::FETCH_ASSOC); 
         if ($user) { $_SESSION['user'] = $user; } 
     } 
 } 

 function logoutUser() { 
     setcookie("remember_user", "", time() - 3600, "/"); 
     session_destroy(); 
 } 
?>
