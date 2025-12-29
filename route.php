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
    case $me . 'daftarsp2d':
        require "content/daftar.view.php";
        break;
    case $me . 'listpenguji':
        require "content/daftarpenguji.view.php";
        break;
    case $me . 'berkas':
        require "content/berkas.view.php";
        break;


    case $me . 'kertaskerja':
        require "content/kertaskerja.view.php";
        break;
    case $me . 'spm':
        require "content/getdataspm.view.php";
        break;
    case $me . 'logout':
        require "proses/logout/page.php";
        break;
    case $me . 'mocking':
        require "content/tarik.view.php";
        break;
    case $me . 'verifikasi':
        require "content/verif.view.php";
        break;
     case $me . 'status':
        require "content/statusberkas.view.php";
        break;   
   
   
   
    default:
        http_response_code(404);
        require "content/login.view.php";
        break;
}
return;
