<?php

require_once(__DIR__ . '/../../constants/index.php');


try {
      $conn = new PDO("mysql:host=" . constant("DB_HOST") . ";dbname=" . constant("DB_DATABASE"), constant("DB_USERNAME"), constant("DB_PASSWORD"));
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected to the database successfully";
} catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
}
?>