<?php

session_start();


if ($_SESSION['user_status'] != "admin") {
    header('Location: /');
    exit();
}

$config = require "config.php";
require "Database.php";

$db = new Database($config["config"]);
$page_title = "Admin page";
$query_string = "INSERT INTO books (title, author, release_date, status) VALUES (?, ?, ?, ?)";
$params=[];

if(isset($_GET["title"], $_GET["author"], $_GET["release_date"], $_GET["status"]) && 
   !empty($_GET["title"]) && !empty($_GET["author"]) && !empty($_GET["release_date"])) {


    $params = [
        $_GET["title"],
        $_GET["author"],
        $_GET["release_date"],
        $_GET["status"]
    ];

   $db->execute($query_string, $params);
    

    
}
$editing = false;
if (isset($_GET["edit"])) {
    $edit_id = $_GET["edit"];
    $edit_query = "SELECT * FROM books WHERE id=:id";
    $edit_params = [":id" => $edit_id];
    $edit_book = $db->execute($edit_query, $edit_params);
    if (!empty($edit_book)) {
        $editing = true;
        $edit_title = $edit_book[0]["title"];
        $edit_author = $edit_book[0]["author"];
        $edit_release_date = $edit_book[0]["release_date"];
        $edit_status = $edit_book[0]["status"];
    }
}



$query_string2 = "SELECT * FROM books";
$params2=[];

if(isset($_GET["d_title"]) && $_GET["d_title"] != ""){
    $query_string2 .= " WHERE title=:title";
    $params2[":title"] = $_GET["d_title"];
}


$books=$db->execute($query_string2, $params2);


if (isset($_GET["delete"])) {
    $delete_query = "DELETE FROM books WHERE id=:id";
    $params_delete = [":id" => $_GET["delete"]];
    $db->execute($delete_query, $params_delete);
    header("Location: admin");
}

if (isset($_POST["submit_edit"])) {
    $edit_id = $_POST["edit_id"];
    $edit_title = $_POST["title"];
    $edit_author = $_POST["author"];
    $edit_release_date = $_POST["release_date"];
    $edit_status = isset($_POST["status"]) ? 1 : 0;
    
    $update_query = "UPDATE books SET title=:title, author=:author, release_date=:release_date, status=:status WHERE id=:id";
    $update_params = [
        ":id" => $edit_id,
        ":title" => $edit_title,
        ":author" => $edit_author,
        ":release_date" => $edit_release_date,
        ":status" => $edit_status
    ];
    
    $db->execute($update_query, $update_params);
    
    header("Location: admin");
    exit();
}

require "views/admin.view.php";