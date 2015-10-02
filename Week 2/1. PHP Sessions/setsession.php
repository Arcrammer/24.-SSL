<?php
  /*  setsession.php
   *  PHP Sessions
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Friday, 2 October, 2015  */

session_start();
$_SESSION["full_name"] = "Alexander Rhett Crammer";
$_SESSION["city"] = "New York";
$_SESSION["neighbourhood"] = "Greenwich Village";
$_SESSION["favourite_colour"] = "Black";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Set Session</title>
    <link rel="stylesheet" href="Main.css">
  </head>
  <body>
    <p>The $_SESSION superglobal has been populated.</p>
    <a href="getsession.php?<?= http_build_query($_SESSION) // Create query string from $_SESSION superglobal ?>">Demonstrate Session Data &rarr;</a>
  </body>
</html>
