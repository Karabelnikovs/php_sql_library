<?php

session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: /');
    exit();
}


$config = require "config.php";
require "Database.php";

$db = new Database($config["config"]);
$page_title = "Bibliotēka";

$query_string = "SELECT * FROM books";
$params=[];

if(isset($_GET["title"]) && $_GET["title"] != ""){
$query_string .=" WHERE title=:title";
$params[":title"] = $_GET["title"];
}


$books = $db->execute($query_string, $params);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["reserve_book"])) {
        if (isset($_POST["reserve"])) {
            $reserveIndex = $_POST["reserve"];
            if (isset($books[$reserveIndex]) && $books[$reserveIndex]['status'] == '1') {
                $reserve_query = "UPDATE books SET user_id = ?, status = '0' WHERE id = ?";
                $params_reserve = [
                    $_SESSION['user_id'],
                    $books[$reserveIndex]['id']
                ];
                $db->execute($reserve_query, $params_reserve);
                header("Location: books");
                exit();
            }
        }
    } elseif (isset($_POST["return_book"])) {
        if (isset($_POST["return"])) {
            $returnIndex = $_POST["return"];
            if (isset($books[$returnIndex]) && $books[$returnIndex]['user_id'] == $_SESSION['user_id']) {
                $return_query = "UPDATE books SET user_id = NULL, status = '1' WHERE id = ?";
                $params_return = [
                    $books[$returnIndex]['id']
                ];
                $db->execute($return_query, $params_return);
                header("Location: books");
                exit();
            }
        }
    }
}



require "views/books.view.php";

?>