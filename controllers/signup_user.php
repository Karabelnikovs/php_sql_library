<?php
$page_title = "Signup";
require "views/signup_user.view.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["name"])) {
    die("Name is required");
}

if ($_POST["name"] == "admin") {
    die("Grow up🤡");
}

if ($_POST["email"] == "admin@gmail.com") {
    die("Grow up🤡");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);


$config = require "config.php";
require "Database.php";

$db = new Database($config["config"]);

$users = $db->execute("SELECT * FROM users", []);
foreach($users as $user){
    if($user['email'] == $_POST["email"]){
        die("Email already exists");
    }
}

$user_status = "user";
$page_title = "Admin page";
$query_string = "INSERT INTO users (name, email, password_hash, user_status) VALUES (?, ?, ?, ?)";
$params=[];

$params = [
    $_POST["name"],
    $_POST["email"],
    $password_hash,
    $user_status
];
$db->execute($query_string, $params);

    header("Location: signup-succes");
    exit; 

}

