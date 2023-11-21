<?php

if (isset($_POST["id"])) {
      require_once("removeOrder.php");
      $result = removeOrder($_POST["id"]);
      echo $result;
} else {
      $response = array("code" => "400", "message" => "Missing credentials");
      echo json_encode($response);
}

?>