<?php
// kết nối với database
$username = "root";
$password = "";
$servername = "localhost";
$db = "decorbeauty";

$conn = mysqli_connect($servername, $username, $password, $db);

if (!$conn) {
  echo "kết nối thất bại" . mysqli_connect_error();
} else {
  //echo "kết nối thành công";
}
