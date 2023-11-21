<?php

if (isset($_POST["id"])) {
      require_once("updateProduct.php");
      $result = updateProduct($_POST, $_FILES);
      echo $result;
} else {
      $response = array("code" => "400", "message" => "Missing credentials");
      echo json_encode($response);
}

?>