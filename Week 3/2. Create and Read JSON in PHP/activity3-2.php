<?php
  
  /*  activity3-2.php
   *  Create and Read JSON in PHP
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Friday, 9 October, 2015  */

$fruits = json_decode(file_get_contents("http://localhost:8888/2.%20Create%20and%20Read%20JSON%20in%20PHP/fruitjson.php")) ?>
<!DOCTYPE html>
<html>
  <head>
    <style>
      ul {
        list-style-type: none;
      }
    </style>
  </head>
  <body>
    <?php foreach($fruits as $fruit): ?>
      <ul>
        <li>ID: <?= trim($fruit[0]) ?></li>
        <li>Name: <?= $fruit[1] ?></li>
        <li>Colour: <?= $fruit[2] ?></li>
      </ul>
    <?php endforeach ?>
  </body>
</html>
