<?php
session_start();
//stack overflow proper way to logout from a session in PHP
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: ../login.php");
exit;
?>