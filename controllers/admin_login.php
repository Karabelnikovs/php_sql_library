<?php
$page_title = "Admin_login";

$config = require "config.php";
require "Database.php";

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $db = new Database($config["config"]);
    
    

    $query_string = "SELECT * FROM users WHERE name = :name";
    $params=[":name"=>$_POST["name"]];
    
    $user = $db->execute($query_string, $params);
    
   
    $user = $user[0];

    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_status"] = "admin";
            
            header("Location: admin");
            exit();
        }
    }
    $is_invalid = true;
}


require "views/admin_login.view.php";