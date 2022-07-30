<?php

  include("config.php");

  $username = $_POST['username'];
  $hardness = $_POST['hardness'];
  $game_time = $_POST['time'];
  $date_time = time();

  $sql = "INSERT INTO records (username, game_time, date_time, hardness) VALUES ('$username', '$game_time', '$date_time', '$hardness')";
  $db->query($sql);

  print "record_saved";
 ?>
