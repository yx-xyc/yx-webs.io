<!doctype html>
<html>
  <head>
    <title>Quiz Results</title>
    <style>
      .row{
        border: 3px solid black;
        margin: 5px;
      }
      body {
        font-family: "Gill Sans", sans-serif;
      }
    </style>
  </head>
  <body>
    <h1>Simpsons Quiz Results</h1>
    <?php
      // open the file for reading so we can grab the data
      $filename = getcwd() . "/data/votes.txt";
      $data = file_get_contents($filename);

      // // figure out the totals for each character
      $lines = explode("\n", $data);
      $nums = sizeof($lines);
      $homer = 0;
      $marge = 0;
      $bart = 0;
      $lisa = 0;
      for ($i = 0; $i < sizeof($lines); $i++) {
        if ($lines[$i] == "Homer") {
          $homer++;
        }
        else if ($lines[$i] == "Marge") {
          $marge++;
        }
        else if ($lines[$i] == "Bart"){
          $bart++;
        }
        else if ($lines[$i] == "Lisa"){
          $lisa++;
        }
      }
      print "<p>In total, there are $nums quiz submissions.</p>";
      // print "$homer $marge $bart $lisa";
      // display actual results as a bar chart
    ?>
      <table>
      <tr>
        <div class='row'>
        <?php
          print "<div style='width:" . round($homer/$nums*100,2) . "%; background-color: skyblue'>Homer " . round($homer/$nums*100,2) . "% &nbsp;<br><br></div>";
        ?>
        </div>
      </tr>
      <tr>
        <div class='row'>
        <?php
          print "<div style='width:" . round($marge/$nums*100,2) . "%; background-color: yellow'>Marge " . round($marge/$nums*100,2) . "% &nbsp;<br><br></div>";
        ?>
        </div>
      </tr>
      <tr>
        <div class='row'>
        <?php
          print "<div style='width:" . round($bart/$nums*100,2) . "%; background-color: lightgreen'>Bart " . round($bart/$nums*100,2) . "% &nbsp;<br><br></div>";
        ?>
        </div>
      </tr>
      <tr>
        <div class='row'>
        <?php
          print "<div style='width:" . round($lisa/$nums*100,2) . "%; background-color: pink'>Lisa " . round($lisa/$nums*100,2) . "% &nbsp;<br><br></div>";
        ?>
        </div>
      </tr>
      </table>
      <br>
      <a href="quiz.php">Back to Quiz</a>
  </body>
</html>
