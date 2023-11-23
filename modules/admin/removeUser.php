<?php
function deactivateUser($id)
{
      require_once(__DIR__ . '/../database/conn.php');
      try {
            if (!is_numeric($id) || $id <= 0) {
                  $response = array("code" => "400", "message" => "Invalid user ID");
                  return json_encode($response);
            }

            $checkQuery = "SELECT COUNT(*) FROM user WHERE id = :id AND status ='activated'";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $checkStmt->execute();
            $userCount = $checkStmt->fetchColumn();

            if ($userCount == 0) {
                  $response = array("code" => "404", "message" => "User not found");
                  return json_encode($response);
            }

            $updateStatusQuery = "UPDATE user SET status = 'deactivated' WHERE id = :id AND status ='activated'";
            $updateStatusStmt = $conn->prepare($updateStatusQuery);
            $updateStatusStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $updateStatusStmt->execute();
            $affectedRows = $updateStatusStmt->rowCount();

            if ($affectedRows > 0) {
                  $response = array("code" => "200", "message" => "User deactivated successfully");
                  return json_encode($response);
            } else {
                  $response = array("code" => "400", "message" => "User not found or already deactivated");
                  return json_encode($response);
            }
      } catch (PDOException $e) {
            $response = array("code" => "500", "message" => "Error: Internal Server Error");
            return json_encode($response);
      }
}
?>