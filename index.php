<?php

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];


switch ($uri) {
  case "/":
      require "controllers/login_user.php";
      break;
  case "/index":
    require "controllers/login_user.php";
    break;
  case "/books":
    require "controllers/books.php";
    break;
  case "/admin":
    require "controllers/admin.php";
    break;
  case "/signup":
    require "controllers/signup_user.php";
    break;
  case "/login-user":
    require "controllers/login_user.php";
    break;
  case "/signup-succes":
    require "controllers/signup_succes.php";
    break;
  case "/logout":
    require "controllers/logout.php";
    break;
  case "/admin_login":
    require "controllers/admin_login.php";
    break;
  default:
    http_response_code(404);
    require "controllers/gg.php";
};