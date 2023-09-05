<?php
include "db_conn1.php";
$id = $_GET["id"];
$sql = "DELETE FROM `book` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: index1.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}