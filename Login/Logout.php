<?php 
    include './Control.php';
    //delete shopping cart
    include_once '../lib/Database.php';
    $db = new Database();
    $db->deleteCart();
    
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy(); 
    
    header("Location: ./Login.php");
  
    exit;
  
?>
