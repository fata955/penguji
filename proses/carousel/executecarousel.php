<?php
session_start();
$username = $_SESSION['username'];
// include '../../../lib/dbh.inc.php';
include '../../../lib/dbh.inc.php';



if ($_GET["action"] === "fetchData") {
  $sql = "SELECT * FROM carousel";
  $result = mysqli_query($koneksi, $sql);
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  mysqli_close($koneksi);
  header('Content-Type: application/json');
  echo json_encode([
    "data" => $data
  ]);
}

if ($_GET["action"] === "insertData") {
  // if (!empty($_POST["judul_berita"]) && !empty($_POST["isi"]) && !empty($_POST["status"] && !empty($_POST["tanggal"])) != 0) {
  $judul = $_POST["judul"];


  $name     = $_FILES['filegambar']['name'];
  $masalah  = $_FILES['filegambar']['error'];
  $ukuran   = $_FILES['filegambar']['size'];
  $asal     = $_FILES['filegambar']['tmp_name'];

  if ($asal == "") {
    echo json_encode([
      "statusCode" => 404,
      "message" => "Data gambar masih kosong"
    ]);
  } else {
    copy($asal, "../../uploads/".$name);
    $query  = "INSERT INTO carousel (id,judul,gambar) VALUES('$judul','$name')";
    $result = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
  }
  if ($result) {
    echo json_encode([
      "statusCode" => 200,
      "message" => "Data Berhasil tersimpan"
    ]);
    // header("Location: /admin/carousel");
    exit();
  }
}


if ($_GET["action"] === "fetchIsi") {
  $id = $_POST["id"];
  $sql = "SELECT isi as isihalaman FROM halaman WHERE id='$id'";
  $result = mysqli_query($koneksi, $sql);
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    header("Content-Type: application/json");
    echo json_encode([
      "statusCode" => 200,
      "data" => $data
    ]);
  } else {
    echo json_encode([
      "statusCode" => 404,
      "message" => "No user found with this id 😓"
    ]);
  }
  mysqli_close($koneksi);
}

if ($_GET["action"] === "fetchSingle") {
  $id = $_POST["id"];
  $sql = "SELECT * FROM carousel WHERE id='$id'";
  $result = mysqli_query($koneksi, $sql);
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    header("Content-Type: application/json");
    echo json_encode([
      "statusCode" => 200,
      "data" => $data
    ]);
  } else {
    echo json_encode([
      "statusCode" => 404,
      "message" => "No user found with this id 😓"
    ]);
  }
  mysqli_close($koneksi);
}

// function to update data
if ($_GET["action"] === "updateData") {
  $id = $_POST["id"];
  $judul = $_POST["judul"];
 
  
  $name = $_FILES['filegambar1']['name'];
  // $masalah  = $_FILES['filegambar']['error'];
  $ukuran   = $_FILES['filegambar1']['size'];
  $asal     = $_FILES['filegambar1']['tmp_name'];
  // $email = mysqli_real_escape_string($conn, $_POST["email"]);
  // $country = mysqli_real_escape_string($conn, $_POST["country"]);
  // $gender = mysqli_real_escape_string($conn, $_POST["gender"]);

  $format = pathinfo($name, PATHINFO_EXTENSION);
    if ($ukuran < 10000000) {

      if ($format === 'JPG' ||$format === 'jpg' || $format === 'png' || $format === 'PNG' || $format === 'jpeg') {
        $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM carousel where id=$id"));
        if ($data['gambar'] != "") unlink("../../uploads/$data[gambar]");

        $edit = copy($asal, "../../uploads/".$name);
        $edit2 = mysqli_query($koneksi, "UPDATE carousel SET judul=$judul, gambar=$name WHERE id=$id") or die(mysqli_error($koneksi));
        if ($edit2) {
          echo json_encode([
            "statusCode" => 200,
            "message" => "Data Berhasil tersimpan"
          ]);
        } else {
          echo json_encode([
            "statusCode" => 404,
            "message" => "Data Gagal Tersimpan"
          ]);
        }
      } else {
        echo json_encode([
          "statusCode" => 500,
          "message" => "File Yang Dimasukan Harus JPG atau PNG"
        ]);
        // echo "<script>alert('File Yang Dimasukan Harus JPG atau PNG');</script>";
      }
    } else {
      echo json_encode([
        "statusCode" => 501,
        "message" => "File Yang Dimasukan Terlalu Besar"
      ]);
      // echo "<script>alert('File Yang Dimasukan Terlalu Besar');</script>";
    }
  // if ($asal == "") {
  //   $kirim = mysqli_query($koneksi, "UPDATE carousel SET judul='$judul' WHERE id=$id") or die(mysqli_error($koneksi));
  // } else {
  //   $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from carousel where id=$id"));
  //   if ($data['gambar'] != "") unlink("../../uploads/" .$data['gambar']);

  //   $edit = move_uploaded_file($asal, "../../uploads/".$original_name);
  //   $sql1 = "UPDATE carousel SET judul='$judul', gambar='$original_name' WHERE id=$id";
  //   $kirim = mysqli_query($koneksi, $sql1) or die(mysqli_error($koneksi));
  // }

  // if ($kirim) {
  //   echo json_encode([
  //     "statusCode" => 200,
  //     "message" => "Data updated successfully 😀"
  //   ]);
  //    header("Location: /admin/carousel");
  //   exit();
  // } else {
  //   echo json_encode([
  //     "statusCode" => 500,
  //     "message" => "Failed to update data 😓"
  //   ]);
  //    header("Location: /admin/carousel");
  //   exit();
  // }
  mysqli_close($koneksi);
}



// function to delete data
if ($_GET["action"] === "deleteData") {
  $id = $_POST["id"];
  // $delete_image = $_POST["delete_image"];
  $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from carousel where id=$id"));
  if ($data['gambar'] != "") unlink("../../uploads/" . $data['gambar']);
  $sql = "DELETE FROM carousel WHERE id=$id";

  if (mysqli_query($koneksi, $sql)) {
    // remove the image
    // unlink("uploads/" . $delete_image);
    echo json_encode([
      "statusCode" => 200,
      "message" => "Data deleted successfully 😀"
    ]);
  } else {
    echo json_encode([
      "statusCode" => 500,
      "message" => "Failed to delete data 😓"
    ]);
  }
}
