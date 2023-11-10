<?php

if (isset($_POST["id"]) && isset($_POST["name"])) {

      require_once("checkout.php");
      $result = fetchingCart($_POST["id"], $_POST["name"]);
      echo $result;
} else {
      $response = array("code" => "400", "message" => "Missing credentials");
      echo json_encode($response);
}


?>