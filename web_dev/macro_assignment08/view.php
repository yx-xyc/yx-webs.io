<!doctype html>
<html>
  <head>
  <title>Post</title>
  <style>
     textarea {
        resize: none;
        width: 300px;
        height: 100px;
      }
      .hidden{
        display: none;
      }
      .success{
        background-color: green;
        color: white;
        margin-top: 1em;
        margin-bottom: 1em;
        padding: 1em;
      }
      .failure{
        background-color: red;
        color: white;
        margin-top: 1em;
        margin-bottom: 1em;
        padding: 1em;
      }
      #search_box{
        position: absolute;
        top: 2em;
        right: 0em;
      }
      #container{
        position: relative;
        max-width: 80%;
        margin: auto;
      }
  </style>
  </head>
  <body>
    <div id="container">
      <div id="search_box">
        <form id="search" method="post" action="search.php">
          <input type="text" name="keyword">
          <button>Search</button>
        </form>
      </div>
      <a href='index.php'><h1>Discussion Forum</h1></a>
      <?php
        include('config.php');
        // grab the ID of the question
        $id = $_GET['id'];
        // run a query against the database that grabs this post
        $sql = "SELECT * FROM posts WHERE id = $id";
        $result = $db->query($sql);
        $row=$result->fetchArray();
        // do something with it!
      ?>
      <h1>
        <?php print $row['title']; ?>
      </h1>
      <hr>
      <div>
        <p>Posted by <?php print $row['name']?> on 
        <?php 
          $pretty_time = date("F j, Y, g:i a", $row['time']);
          print $pretty_time;
        ?></p>
        <p>&emsp;&emsp; <?php print $row['body']?></p>
        <button id='panel_visibility' data-status="hidden">Add Comment</button><br>
      </div>
      <hr>
      <?php
        if($_GET['error'] == 'empty_field'){
          print("<div class='failure'>Missing information, please try again!</div>");
        } else if ($_GET['msg'] == 'success'){
          print("<div class='success'>Submit Comment successfully!</div>");
        }
      ?>
      <form method="post" action="savecomment.php" class="hidden" id="panel">
        <input type="hidden" name="post_id" value="<?php print $id?>">
        Username:
        <br>
        <input type="text" name="username">
        <br>
        Content:
        <br>
        <textarea name="content"></textarea>
        <br>
        <input type="submit">
      </form>
      <h2>Comments</h2>
      <a href="view.php?order=asc&id=<?php print $id;?>">Sort by Oldest</a> - 
      <a href="view.php?order=desc&id=<?php print $id;?>">Sort by Newest</a>
      <?php

        // connect to databases
        include('config.php');
        date_default_timezone_set('America/New_York');

        // grab all posts
        if ($_GET['order']=='desc'){
          $sql = "SELECT * FROM comments  WHERE post_id = $id ORDER BY time DESC";
        } else if ($_GET['order']=='asc'){
          $sql = "SELECT * FROM comments WHERE post_id = $id ORDER BY time ASC ";
        } else{
          $sql = "SELECT * FROM comments WHERE post_id = $id";
        }
        $result = $db->query($sql);

        // iterate over posts and display
        while ($row = $result->fetchArray()) {
          ?>
          <div>
            <p>Commented <?php print $row['name']; ?> on <?php
            $pretty_time = date("F j, Y, g:i a", $row['time']);
            print $pretty_time;
            ?></p>
            <p>&emsp;&emsp; <i><?php print $row['body']; ?></i></p>
          </div>
          <br>
          <?php
        }
      ?>
      <script>
        let btn = document.getElementById('panel_visibility');
        let panel = document.getElementById('panel');
        btn.addEventListener("click", function(event){
            if (event.currentTarget.dataset.status == "hidden"){
              panel.classList.remove('hidden');
              btn.innerHTML = 'Hidden Panel';
              event.currentTarget.dataset.status = "appear";
            } else if (event.currentTarget.dataset.status == "appear"){
              panel.classList.add('hidden');
              btn.innerHTML = 'Add Comment';
              event.currentTarget.dataset.status = "hidden";
            }
        });
      </script>
    </div>
  </body>
<html>