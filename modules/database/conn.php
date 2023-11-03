<?php
require_once(__DIR__ . '/../../constants/index.php');

$timestamp = date("H:i:s d/m/Y");
try {
      $conn = new PDO("mysql:host=" . constant("DB_HOST") . ";dbname=" . constant("DB_DATABASE"), constant("DB_USERNAME"), constant("DB_PASSWORD"));
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "<script>console.log('[$timestamp]: DB CONNECTED SUCCESSED' );</script>";
} catch (PDOException $e) {
      echo "<script>console.log('[$timestamp]: DB CONNECTED FAILED. Error: $e' );";
}
?>