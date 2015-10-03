<?php
  /*  activity2-3.php
   *  Filesystem Functions
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Saturday, 3 October, 2015  */

// Fetch foreign JSON for output later
$goodFellasInfo = file_get_contents("http://www.omdbapi.com/?t=goodfellas");

// Write five words to 'Dictionary.txt'
$dictionary = fopen("Dictionary.txt", "w+"); // Create or overwrite 'Dictionary.txt'
$words = <<<"EOD"
Red
Orange
Yellow
Green
Teal

EOD;
fwrite($dictionary, $words); // Write the colours to the file

/*  The 'file()' method seperates the file to an array
 *  in a very brilliant way, although the assignment
 *  requires use of the 'file_get_contents()'
 *  method, so I'll be using that instead.
 *  
 *  Example:
 *    $dictionaryWords = file("Dictionary.txt"); // Read the content to an array
 *
 */

$dictionaryWords = explode("\n", file_get_contents("Dictionary.txt")); // Only variables can be passed to 'array_pop()' (used in the next line)
array_pop($dictionaryWords); // Because the delimiter used was the newline character there's an empty sixth (last) element in the array. This removes that element
fclose($dictionary); // Close 'Dictionary.txt' ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Filesystem Functions</title>
    <style>
      body {
        font-family: "Verdana";
        font-size: 1em;
        line-height: 150%;
        padding: 1.5% 15%;
      }
      h4 {
        font-family: "Helvetica Neue";
        font-size: 1.2em;
        font-weight: 300;
        letter-spacing: 0.75px;
      }
      ul {
        list-style-type: decimal;
      }
    </style>
  </head>
  <body>
    <h4><i>Good Fellas</i> Info:</h4>
    <p><?= $goodFellasInfo ?></p>
    <h4>Dictionary Words:</h4>
    <ul>
    <?php foreach($dictionaryWords as $dictionaryWord): ?>
      <li><?= $dictionaryWord ?></li>
    <?php endforeach ?>
    </ul>
  </body>
</html>
