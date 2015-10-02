<?php
  /*  getsession.php
   *  PHP Sessions
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Friday, 2 October, 2015  */

session_start();

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Get Session</title>
    <link rel="stylesheet" href="Main.css">
  </head>
  <body>
    <h4>$_SESSION Data (Becomes Lost Without Cookie Reference):</h4>
    <pre><?php var_dump($_SESSION) ?></pre>
    <h4>$_GET Data (Remains Persistent After Cookie Reference Deletion):</h4>
    <pre><?php var_dump($_GET) ?></pre>
    <a href="setsession.php">&larr; Back</a>
  </body>
</html>
