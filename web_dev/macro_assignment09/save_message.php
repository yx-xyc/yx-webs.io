<?php

  // open database
  include('config.php');
  // get post variables
  $name = $_POST['name'];
  $message = $_POST['message'];
  $room = $_POST['room'];
  foreach (explode(' ', $message) as $word){
    $word = trim($word, '.,!?:;');
    $sql = "SELECT word from banned where word like '$word'";
    $result = $db->query($sql);
    if ($result->fetchArray()){
      print "banned_word";
      exit();
    }
  }
  // make sure there's a message here
  if (strlen($message) > 0) {
    // add to database
    $message = $db->escapeString(addslashes(htmlspecialchars($message)));
    $sql = "INSERT INTO chats (name, message, room_id) VALUES ('$name', '$message', '$room')";
    $db->query($sql);
    print "saved";
    exit();
  }
  print "fail";
  exit();


 ?>