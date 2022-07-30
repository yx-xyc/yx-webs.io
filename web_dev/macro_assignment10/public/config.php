<?php

  // secret salt for hashing passwords
  $salt = "12345";

  // define file path - you will need to change this when
  // you upload your code to i6!
  $path = getcwd().'/../private';

  // open our database
  $db = new SQLite3("$path/database.db");

 ?>
