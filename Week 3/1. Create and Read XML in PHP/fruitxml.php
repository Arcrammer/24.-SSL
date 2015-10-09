<?php
  
  /*  fruitxml.php
   *  Create and Read XML in PHP
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Friday, 9 October, 2015  */

// Requests to this script return XML
header("Content-Type: text/xml");

// Write the XML declaration tag with 'echo'
// (Preventing PHP from attempting to execute the tag)
echo '<?xml version="1.0" encoding="UTF-8" ?>';

// Read a hidden configuration file (Preventing username
// and password for the database from being hard-coded)
$config = parse_ini_file("/etc/config.ini");

// Open a connection to the database and fetch all fruits
$database = new PDO("mysql:host=127.0.0.1;dbname=SSL", $config["username"], $config["password"]);
$fruits = $database->query("SELECT * FROM fruits")->fetchAll(PDO::FETCH_NUM) ?>
<fruits>
  <?php foreach($fruits as $fruit): ?>
    <fruit>
      <id><?= $fruit[0] ?></id>
      <name><?= $fruit[1] ?></name>
      <colour><?= $fruit[2] ?></colour>
    </fruit>
  <?php endforeach ?>
</fruits>
