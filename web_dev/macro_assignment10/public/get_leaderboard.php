<?php
  include('config.php');
  $sql = "SELECT * FROM records WHERE (hardness = 'easy') ORDER BY game_time ASC LIMIT 3";
  $results = $db->query($sql);
  $return_array = array();
  while ($row = $results->fetchArray()){
      $result_array = array();
      $result_array['username'] = $row['username'];
      $result_array['game_time'] = $row['game_time'];
      $result_array['date_time'] = $row['date_time'];
      array_push($return_array, $result_array);
  }
  $sql = "SELECT * FROM records WHERE (hardness = 'medium') ORDER BY game_time ASC LIMIT 3";
  $results = $db->query($sql);
  while ($row = $results->fetchArray()){
      $result_array = array();
      $result_array['username'] = $row['username'];
      $result_array['game_time'] = $row['game_time'];
      $result_array['date_time'] = $row['date_time'];
      array_push($return_array, $result_array);
  }
  $sql = "SELECT * FROM records WHERE (hardness = 'hard') ORDER BY game_time ASC LIMIT 3";
  $results = $db->query($sql);
  while ($row = $results->fetchArray()){
      $result_array = array();
      $result_array['username'] = $row['username'];
      $result_array['game_time'] = $row['game_time'];
      $result_array['date_time'] = $row['date_time'];
      array_push($return_array, $result_array);
  }
  print json_encode($return_array);
  exit();
?>

