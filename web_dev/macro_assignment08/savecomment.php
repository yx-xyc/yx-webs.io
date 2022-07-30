<?php

  // grab data from form
  $username = $_POST['username'];
  $content = $_POST['content'];
  $post_id = $_POST['post_id'];
//   print $username;
//   print $content;
//   print $post_id;
  // connect to database!
  include('config.php');

  // validation
  if (!$username || !$content || !$post_id ){
    header("Location: view.php?id=$post_id&error=empty_field");
    exit();
  }

  // if everything is OK, save the record into
  // the database
  $now = time();

  $sql = "INSERT INTO comments (post_id, body, name, time) VALUES ('$post_id', '$content', '$username', $now)";
  $db->query($sql);

  // send them back to index.php
  header("Location: view.php?id=$post_id&msg=success");
  exit();
 ?>