<?php
  
  /*  activity3-1.php
   *  Create and Read XML in PHP
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Friday, 9 October, 2015  */

// Before PHP 5.1.2, --enable-simplexml is required to enable the 'simplexml' extension
$fruits = simplexml_load_file("http://localhost:8888/1.%20Create%20and%20Read%20XML%20in%20PHP/fruitxml.php") ?>
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
    <?php foreach($fruits->fruit as $fruit): ?>
      <ul>
        <li>ID: <?= trim($fruit->id) ?></li>
        <li>Name: <?= $fruit->name ?></li>
        <li>Colour: <?= $fruit->colour ?></li>
      </ul>
    <?php endforeach ?>
  </body>
</html>
