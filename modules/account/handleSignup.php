<?php

if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["birthday"]) && isset($_POST["phone"]) && isset($_POST["postal"]) && isset($_POST["address"])) {
      require("sign_up.php");
      $result = SignUp(
            $_POST["email"],
            $_POST["password"],
            $_POST["name"],
            $_POST["birthday"],
            $_POST["phone"],
            $_POST["postal"],
            $_POST["address"]
      );

      echo $result;
} else {
      $response = array("code" => "400", "message" => "Missing required parameters");
      echo json_encode($response);
}
?>