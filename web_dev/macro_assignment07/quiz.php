<!doctype html>
<html>
  <head>
    <style>
      .result{
        display: center;
        margin: auto;
        border: 5px solid black;
        border-radius: 10%;
        width: 300px;
        height: auto;
      }
      .center{
        display: block;
        margin: auto;
        text-align: center;
      }
      body {
        font-family: "Gill Sans", sans-serif;
      }
    </style>
    <title>Quiz!</title>
  </head>
  <body>
    <h1>What Simpsons Character Am I?</h1>
    <hr>
    <?php

      if ($_GET['error'] == 'notfilledin') {
        print "<p>Error! Fill in the form</p>";
      }

      if ($_COOKIE['choice']) {
        print '<div class="result center">';
        print "You are " . $_COOKIE['choice'];
        print '<img class="center" src="assignment07_images/' .  $_COOKIE['choice'] . '.png">';
        print '<a href=tryagain.php>Try again?</a>';
        print '</div>';

      }
      else {
     ?>
    <form method="POST" action="save.php">
     <p>
        What's your ideal job?<br>
        <select name="job" id="job">
          <option value="">Select a job</option>
          <option value="homer">Working at a bakery</option>
          <option value="marge">French tutor</option>
          <option value="bart">Prank phone call specialist</option>
          <option value="lisa">College professor</option>
        </select>
      </p>

      <p>What is your favorite food?<br>
        <select name="food" id="food">
          <option value="">Select a food</option>
          <option value="homer">Donuts</option>
          <option value="marge">Apple pie</option>
          <option value="bart">Krusty Flakes</option>
          <option value="lisa">Anything organic and locally sourced</option>
        </select>
      </p>

      <p>What is your favorite hobby?<br>
        <select name="hobby" id="hobby">
          <option value="">Select a hobby</option>
          <option value="homer">Watching TV</option>
          <option value="marge">Knitting</option>
          <option value="bart">Skateboarding</option>
          <option value="lisa">Reading</option>
        </select>
      </p>
      <p>What is your biggest fear?<br>
        <select name="fear" id="fear">
          <option value="">Select a fear</option>
          <option value="homer">Sock puppets</option>
          <option value="marge">Flying</option>
          <option value="bart">I'm fearless, man</option>
          <option value="lisa">Getting anything below an A in school</option>
        </select>
      </p>

      <input type="submit" value="What Simpsons Character am I?">
      <?php
      }
    ?>
    </form>
    <hr>
    <a href="results.php">Click here for results</a>
  </body>
</html>
