<?php
function getUser($id, $name)
{
      require_once(__DIR__ . '/../database/conn.php');

      try {
            $query = "SELECT id FROM user WHERE id = :id and name = :name and status ='activated'";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                  return $result['id'];
            } else {
                  return null;
            }
      } catch (PDOException $e) {
            return null;
      }
}
?>