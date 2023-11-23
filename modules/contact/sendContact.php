<?php
function sendContact($id, $subject, $message)
{
      require(__DIR__ . '/../database/conn.php');
      if (!preg_match('/^[1-9]\d*$/', $id)) {
            $response = array("code" => "400", "message" => "Invalid id");
            return json_encode($response);
      }
      if (!preg_match('/^.{4,30}$/', $subject)) {
            $response = array("code" => "400", "message" => "Subject length should be between 4 and 30 characters");
            return json_encode($response);
      }
      if (empty($message)) {
            $response = array("code" => "400", "message" => "Message cannot be empty");
            return json_encode($response);
      }

      try {
            $query = "INSERT INTO contact (user_id,subject,message) VALUES (:user_id,:subject,:message)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':user_id', $id);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':message', $message);
            $stmt->execute();
            $response = array("code" => "200", "message" => "Send Contact successfully");
            return json_encode($response);

      } catch (PDOException $e) {
            $response = array("code" => "500", "message" => "Error: Internal Server Error");
            return json_encode($response);
      }
}

?>