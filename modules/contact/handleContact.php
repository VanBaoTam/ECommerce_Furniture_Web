<?php
if (isset($_POST["id"]) && $_POST["name"] && isset($_POST["subject"]) && isset($_POST["message"])) {
      require_once("getUser.php");
      $userInfo = getUser($_POST["id"], $_POST["name"]);
      require(__DIR__ . '/../database/conn.php');
      if (!empty($userInfo)) {
            require_once("sendContact.php");
            $result = sendContact($_POST["id"], $_POST["subject"], $_POST["message"]);
            echo $result;
      } else {
            $response = array("code" => "400", "message" => "Invalid user");
            return json_encode($response);
      }
}



?>