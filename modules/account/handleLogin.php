<?php

if (isset($_POST["email"]) && isset($_POST["password"])) {
      require_once("login.php");
      $result = login($_POST["email"], $_POST["password"]);
      echo $result;
} else {
      $response = array("code" => "400", "message" => "Missing email or password");
      echo json_encode($response);
}

?>