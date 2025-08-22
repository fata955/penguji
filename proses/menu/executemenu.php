<?php
// include '../../../lib/dbh.inc.php';
include '../../../lib/dbh.inc.php';


if ($_GET["action"] === "fetchData") {
  $sql = "SELECT * FROM menu";
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


  if (!empty($_POST["judul"]) && !empty($_POST["link"]) && !empty($_POST["urutan"]) != 0) {
    $judul = mysqli_real_escape_string($koneksi, $_POST["judul"]);
    $link = mysqli_real_escape_string($koneksi, $_POST["link"]);
    $urutan = mysqli_real_escape_string($koneksi, $_POST["urutan"]);

    // $judul = $_POST["judul"];
    // $link = $_POST["link"];
    // $urutan = $_POST["urutan"];

    $cek = mysqli_query($koneksi, "SELECT * FROM menu where judul='$judul'");
    $double = mysqli_num_rows($cek);
    if ($double == null) {
      $sql = "INSERT INTO menu (judul,link,urutan) VALUES ('$judul','$link','$urutan')";
      // header("Content-Type: application/json");
      if (mysqli_query($koneksi, $sql)) {
        echo json_encode([
          "statusCode" => 200,
          "message" => "Data inserted successfully 😀"
        ]);
      } else {
        echo json_encode([
          "statusCode" => 500,
          "message" => "Failed to insert data 😓"
        ]);
      }
    } else {
      echo json_encode([
        "statusCode" => 800,
        "message" => "DATA SUDAH ADA BRO 😓"
      ]);
    }
  } else {
    echo json_encode([
      "statusCode" => 400,
      "message" => "Please fill all the required fields 🙏"
    ]);
  }
}


if ($_GET["action"] === "fetchSingle") {
  $id = $_POST["id"];
  $sql = "SELECT * FROM menu WHERE id='$id'";
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
  if (!empty($_POST["judul"]) && !empty($_POST["link"]) && !empty($_POST["urutan"])) {
    // $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $judul = mysqli_real_escape_string($koneksi, $_POST["judul"]);
    $link = mysqli_real_escape_string($koneksi, $_POST["link"]);
    $urutan = mysqli_real_escape_string($koneksi, $_POST["urutan"]);
    // $email = mysqli_real_escape_string($conn, $_POST["email"]);
    // $country = mysqli_real_escape_string($conn, $_POST["country"]);
    // $gender = mysqli_real_escape_string($conn, $_POST["gender"]);

    // if ($_FILES["image"]["size"] != 0) {
    //   // rename the image before saving to database
    //   $original_name = $_FILES["image"]["name"];
    //   $new_name = uniqid() . time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
    //   move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $new_name);
    //   // remove the old image from uploads directory
    //   unlink("uploads/" . $_POST["image_old"]);
    // } else {
    //   $new_name = mysqli_real_escape_string($conn, $_POST["image_old"]);
    // }
    $sql = "UPDATE menu SET judul='$judul',link='$link', urutan='$urutan' WHERE id=$id";
    if (mysqli_query($koneksi, $sql)) {
      echo json_encode([
        "statusCode" => 200,
        "message" => "Data updated successfully 😀"
      ]);
    } else {
      echo json_encode([
        "statusCode" => 500,
        "message" => "Failed to update data 😓"
      ]);
    }
    mysqli_close($koneksi);
  } else {
    echo json_encode([
      "statusCode" => 400,
      "message" => "Please fill all the required fields 🙏"
    ]);
  }
}


// function to delete data
if ($_GET["action"] === "deleteData") {
  $id = $_POST["id"];
  // $delete_image = $_POST["delete_image"];

  $sql = "DELETE FROM menu WHERE id=$id";

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



