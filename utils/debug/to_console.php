<?php
function DebugToConsole($data)
{
      $timestamp = date("H:i:s d/m/Y"); // Get the current timestamp in the desired format
      $output = $data;
      if (is_array($output))
            $output = implode(',', $output);
      echo "<script>console.log('[$timestamp] Debug Objects: " . $output . "' );</script>";
}
?>