<?php
  // send them away if they aren't logged in
  if (!$_COOKIE['PHPSESSID']) {
    header('Location: index_notloggedin.php');
    exit();
  }
  session_start();
 ?><!doctype html>
<html>
  <head>
    <title>Matching Game</title>

    <!-- bring in the jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- custom styles -->
    <style>
      body {
        background-color: black;
        color: white;
        font-family: sans-serif;
        font-size: 125%;
        text-align: center;
      }
      .hidden {
        display: none;
      }
      #buttons{
        position: absolute;
        right: 2em;
        top: 2em;
      }
      .easy_container {
        width: 400px;
        height: 300px;
        /* border: 1px solid white; */
        margin: auto;
      }
      .medium_container {
        width: 500px;
        height: 400px;
        /* border: 1px solid white; */
        margin: auto;
      }
      .hard_container {
        width: 600px;
        height: 500px;
        /* border: 1px solid white; */
        margin: auto;
      }

      .token {
        width: 100px;
        height: 100px;
      }
    </style>
  </head>
  <body>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  
  <h1>Memory Matching Madness!</h1>

    <br>
    <div id="buttons">
        <a href="index_loggedin.php"><button id="back">Back</button></a>
        <a href="logout.php"><button id="logout">Logout</button></a>
    </div>

    <div id="board">
        <h2>Leader Board</h2>
        <div id="hard">
            <h3>Hard Mode</h3>
        </div>
        <div id="medium">
            <h3>Medium Mode</h3>
        </div>
        <div id="easy">
            <h3>Easy Mode</h3>
        </div>
    </div>

    <div id="history">
      <h2>Your History</h2>
    </div>

    <script>
      // DOM references
      // console.log(hardness);
      let easy = document.getElementById("easy");      
      let medium = document.getElementById("medium");
      let hard = document.getElementById("hard");

      let history = document.getElementById("history");
      let counter = 1;
      $(document).ready(function(){
        $.ajax({
            url: 'get_history.php',
            type: 'post',
            data: {
            username: '<?php print $_SESSION['username']?>',
            },
            success: function(data, status){
                let parsed = JSON.parse(data);
                for (let i=0;i<parsed.length;i++){
                    temp = document.createElement('p');
                    temp.innerHTML = `${counter}. ${parsed[i].username} | ${parsed[i].game_time}s | ${new Date(parsed[i].date_time*1000).toLocaleDateString("en-US")} ${new Date(parsed[i].date_time*1000).toLocaleTimeString("en-US")} | ${parsed[i].hardness}`;
                    history.appendChild(temp);
                    counter += 1;
                    }
                }
            })
            $.ajax({
            url: 'get_leaderboard.php',
            success: function(data, status){
                let parsed = JSON.parse(data);
                console.log(parsed);
                for (let i=0;i<3;i++){
                    temp = document.createElement('p');
                    temp.innerHTML = `${i+1}. ${parsed[i].username} | ${parsed[i].game_time}s | ${new Date(parsed[i].date_time*1000).toLocaleDateString("en-US")} ${new Date(parsed[i].date_time*1000).toLocaleTimeString("en-US")}`;
                    easy.appendChild(temp);
                    }
                for (let i=3;i<6;i++){
                    temp = document.createElement('p');
                    temp.innerHTML = `${i-2}. ${parsed[i].username} | ${parsed[i].game_time}s | ${new Date(parsed[i].date_time*1000).toLocaleDateString("en-US")} ${new Date(parsed[i].date_time*1000).toLocaleTimeString("en-US")}`;
                    medium.appendChild(temp);
                    }
                for (let i=6;i<9;i++){
                    temp = document.createElement('p');
                    temp.innerHTML = `${i-5}. ${parsed[i].username} | ${parsed[i].game_time}s | ${new Date(parsed[i].date_time*1000).toLocaleDateString("en-US")} ${new Date(parsed[i].date_time*1000).toLocaleTimeString("en-US")}`;
                    hard.appendChild(temp);
                    }
                }
            })
        });
    </script>
  </body>
</html>
