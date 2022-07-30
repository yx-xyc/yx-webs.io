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

    <audio id="wrong_sound">
      <source src="assignment06_images/wrong.wav" type="audio/wav" />
    </audio>
    <audio id="correct_sound">
      <source src="assignment06_images/correct.wav" type="audio/wav" />
    </audio>
    <div id="panel_start">
      <p>Welcome to the game!</p>
      
      <p>Select Hardness below:</p>
        <select name="Hardness" id="hardness">
          <option value="easy">Easy</option>
          <option value="medium">Medium</option>
          <option value="hard">Hard</option>
        </select>
      <button id="button_start">Click to Start!</button>
    </div>

    <br>
    <div id="buttons">
          <a href="logout.php"><button id="logout">Logout</button></a>
    </div>

    <div id="panel_game" class="hidden">
      <div id="timer">Time elapsed: 0 seconds</div>
      <div id="token_container"></div>
    </div>

    <div id="panel_gameover" class="hidden">
      <p>Your time: </p>
      <a href="leader_board.php"><button id="leader_board">See Leader Board</button></a>
      <button id="restart">Play Again!</button>
    </div>

    <script>
      // DOM references
      let panel_start = document.getElementById("panel_start");
      let button_start = document.getElementById("button_start");
      let panel_game = document.getElementById("panel_game");
      let timer = document.getElementById("timer");
      let token_container = document.getElementById("token_container");
      let hardness = document.getElementById("hardness");
      let panel_gameover = document.getElementById("panel_gameover");
      let wrong_sound = document.getElementById("wrong_sound");
      let correct_sound = document.getElementById("correct_sound");
      let restart = document.getElementById("restart");
      let leader_board = document.getElementById("leader_board");
      let timerInterval;
      let currentTime = 0;
      let token1 = false;
      let token2 = false;
      let win;

      // console.log(hardness);

      $(document).ready(function() {
        button_start.addEventListener("click", function (event) {
          token_container.classList.add(hardness.value+'_container');
          panel_start.classList.add("hidden");
          panel_game.classList.remove("hidden");

          timerInterval = setInterval(function () {
            currentTime += 1;
            timer.innerHTML = "Time elapsed: " + currentTime + " seconds";
          }, 1000);

          let assets = [
            "snorlax.png",
            "electrabuzz.png",
            "chansey.png",
            "oddish.png",
            "pikachu.png",
            "paras.png",
            "arcanine.png",
            "ponita.png",
            "venonat.png",
            "eggsecute.png",
            "machop.png",
            "pidgey.png",
            "psyduck.png",
            "tauros.png",
            "vulpix.png",
            "gloom.png",
            "krabby.png",
            "butterfree.png",
            "bulbasaur.png",
            "clefairy.png",
            "koffing.png",
            "goldeen.png",
            "magikarp.png",
            "beedrill.png",
            "lapras.png",
            "meowth.png",
            "ekans.png",
            "jigglypuff.png",
            "horsea.png",
            "polywog.png",
            "sandshrew.png",
            "rattata.png",
            "gengar.png",
            "eevee.png",
            "bellsprout.png",
            "squirtle.png",
            "seel.png",
            "caterpie.png",
          ];

          let picked = [];
          let limit;
          
          if (hardness.value=="easy"){
            limit = 12;
          } else if (hardness.value=="medium"){
            limit = 20;
          } else if (hardness.value=="hard"){
            limit = 30;
          }

          while (picked.length < limit) {
            let i = parseInt(Math.random() * assets.length);
            picked.push(assets[i]);
            picked.push(assets[i]);
            assets.splice(i, 1);
          }

          // you want to randomize the images here
          for (let i = 0; i < 9999; i++) {
            a = parseInt(Math.random() * picked.length);
            b = parseInt(Math.random() * picked.length);
            if (a != b) {
              temp = picked[a];
              picked[a] = picked[b];
              picked[b] = temp;
            }
          }
          // create our pokeballs

          for (let i = 0; i < picked.length; i++) {
            let tempImage = document.createElement("img");
            tempImage.src = "assignment06_images/pokeball.png";
            tempImage.classList.add("token");
            tempImage.dataset.secret = "assignment06_images/" + picked[i];
            tempImage.dataset.discover = false;
            token_container.appendChild(tempImage);

            tempImage.onclick = function (event) {
              if (token1 == false) {
                event.currentTarget.src = event.currentTarget.dataset.secret;
                token1 = event.currentTarget;
                token1.style.pointerEvents = 'none';
              }
              else if (token1 != false && token2 == false){
                event.currentTarget.src = event.currentTarget.dataset.secret;
                token2 = event.currentTarget;
                token2.style.pointerEvents = 'none';
                if (token1.dataset.secret == token2.dataset.secret) {
                  correct_sound.play();
                  token1.dataset.discover = true;
                  token2.dataset.discover = true;
                  token1.onclick = null;
                  token2.onclick = null;
                  token1 = false;
                  token2 = false;
                  let tokens = document.querySelectorAll('.token');
                  win = true;
                  for (let i=0;i<tokens.length;i++){
                    if (tokens[i].dataset.discover == "false"){
                      win = false;
                    }
                  } 
                  if (win){
                    clearInterval( timerInterval );
                    $.ajax({
                      url: 'save_result.php',
                      type: 'post',
                      data: {
                        username: '<?php print $_SESSION['username']?>',
                        hardness: hardness.value,
                        time: currentTime
                      },
                      success: function(data, status){
                        console.log(data);
                        if (data=='record_saved'){
                          panel_game.classList.add("hidden");
                          panel_gameover.classList.remove("hidden");
                          panel_gameover.firstElementChild.innerHTML = `Your time: ${currentTime}s`;
                        }
                      }
                    })
                  } 
                } else {
                  wrong_sound.play();
                  setTimeout(function () {
                    token1.style.pointerEvents = 'auto';
                    token2.style.pointerEvents = 'auto';
                    token1.src = "assignment06_images/pokeball.png";
                    token2.src = "assignment06_images/pokeball.png";
                    token1 = false;
                    token2 = false;
                  }, 1000);
                }
              }
            };
          }

          restart.onclick = function(event){
            let tokens = document.querySelectorAll('.token');
            for (let i=0;i<tokens.length;i++){
              tokens[i].remove();
            }
            currentTime = 0;
            panel_gameover.classList.add('hidden');
            panel_game.classList.remove('hidden');
            button_start.click();
          }

        });
      });
    </script>
  </body>
</html>
