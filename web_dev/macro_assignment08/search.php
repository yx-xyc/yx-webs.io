<!doctype html>
<html>
  <head>
  <title>Search Result</title>
  <style>
    #container{
        width: 80%;
        margin: auto;
      }
  </style>
  </head>
  <body>
    <div id="container">
        <a href='index.php'><h1>Discussion Forum</h1></a>
        <!-- Fetch all posts -->
        <h2>Posts</h2>
        <hr>
        <?php
            include('config.php');
            $keyword = $_POST['keyword'];
            // grab the ID of the question
            // run a query against the database that grabs this post
            $sql = "SELECT * FROM posts WHERE body LIKE '%$keyword%' or title LIKE '%$keyword%' or name LIKE '%$keyword%'";
            $result = $db->query($sql);
            // do something with it!
            $row = $result->fetchArray();
            if ($row==NULL){
                print "No related post found";
            }
            while ($row) {
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
            $row = $result->fetchArray();
        }
        ?>
        <!-- Fetch all comments -->
        <h2>Comments</h2>
        <hr>
        <?php
            $sql = "SELECT * FROM comments WHERE body LIKE '%$keyword%' or name LIKE '%$keyword%'" ;
            $result = $db->query($sql);
            $row = $result->fetchArray();
            if ($row==NULL){
                print "No related comments found";
            }
            while ($row) {
        ?>
        <div>
            <p>Commented <?php print $row['name']; ?> on <?php
            $pretty_time = date("F j, Y, g:i a", $row['time']);
            print $pretty_time;
            ?></p>
            <p>&emsp;&emsp; <i><?php print $row['body']; ?></i></p>
        </div>
        <?php
            $row = $result->fetchArray();
        }
        // if ($row==NULL){
        //     print "No related post found";
        // }
        ?>
    </div>
  </body>
</html>