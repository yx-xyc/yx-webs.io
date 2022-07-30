<!doctype html>
<html>
  <head>
    <title>Discussion!</title>
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
      <!-- Search form -->
      <div id="search_box">
        <form id="search" method="post" action="search.php">
          <input type="text" name="keyword">
          <button>Search</button>
        </form>
      </div>

      <!-- Discussion Board -->
      <h1>Discussion!</h1>

      <!-- Add Question -->
      <button id='panel_visibility' data-status="hidden">Add Post</button><br>
      <?php
        if($_GET['error'] == 'empty_field'){
          print("<div class='failure'>Missing information, please try again!</div>");
        } else if ($_GET['msg'] == 'success'){
          print("<div class='success'>Submit Post successfully!</div>");
        }
      ?>
      <form method="post" action="save.php" class="hidden" id="panel">
        Username:
        <br>
        <input type="text" name="username">
        <br>
        Title:
        <br>
        <input type="text" name="title">
        <br>
        Question:
        <br>
        <textarea name="question"></textarea>
        <br>
        <input type="submit">
      </form>

      <!-- Order the Posts -->
      <hr>
      <a href="index.php?order=asc">Sort by Oldest</a> - 
      <a href="index.php?order=desc">Sort by Newest</a>

      <!-- Show all the posts -->
      <?php
        // connect to databases
        include('config.php');
        date_default_timezone_set('America/New_York');
        // grab all posts
        if ($_GET['order']=='desc'){
          $sql = "SELECT * FROM posts ORDER BY time DESC";
        } else if ($_GET['order']=='asc'){
          $sql = "SELECT * FROM posts ORDER BY time ASC";
        } else{
          $sql = "SELECT * FROM posts";
        }
        $result = $db->query($sql);
        // iterate over posts and display
        while ($row = $result->fetchArray()) {
          ?>
          <div>
            <p>Posted by <?php print $row['name']; ?> on <?php
            $pretty_time = date("F j, Y, g:i a", $row['time']);
            print $pretty_time;
            ?></p>
            <p>&emsp;&emsp;<strong><?php print $row['title']; ?></strong><?php
            print " - <a href=view.php?id=" . $row['id'] . ">expand</a>";
            ?></p>
          </div>
          <br>
          <?php
        }
      ?>

      <!-- Show hide Panel -->
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
              btn.innerHTML = 'Add Post';
              event.currentTarget.dataset.status = "hidden";
            }
        });
      </script>
     </div>
  </body>
</html>

