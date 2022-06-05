<?php
function connectToDB(){
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'ELIDEK';

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if (!$conn) {
    echo 'Connection error: ' . mysql_connect_error();
  }
  return $conn;
}

?>
