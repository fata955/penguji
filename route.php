<?php
// include 'lib/conn.php';
// Define your location project directory in htdocs (EX THE FULL PATH: D:\xampp\htdocs\x-kang\simple-routing-with-php)
// if (isset($_SESSION['user'])) {
include 'lib/dbh.inc.php';
$project_location = "/";
$me = $project_location;

// For get URL PATH
$request = $_SERVER['REQUEST_URI'];
switch ($request) {

    case $me:
        include 'content/home.view.php';
        break;
    case $me . 'home':
        include 'content/home.view.php';
        break;
    case $me . 'inputmenu':
        // require "content/daftarlist.view.php";
        break;
    case $me . 'inputsubmenu':
        require "content/submenu.view.php";
        break;

    case $me . 'kertaskerja':
        require "content/daftarlist.view.php";
        break;
    case $me . 'berita':
        require "content/berita.view.php";
        break;
    case $me . 'halaman':
        require "content/halaman.view.php";
        break;
   case $me . 'login':
        require "content/login.view.php";
        break;
      case $me . 'signup':
        require "content/signup.view.php";
        break;
    case $me . 'logout':
        require "proses/logout/page.php";
        break;
   
    default:
        http_response_code(404);
        require "content/login.view.php";
        break;
}
return;
