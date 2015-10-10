<?php
  
  /*  fruitjson.php
   *  Create and Read JSON in PHP
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Friday, 9 October, 2015  */

// Read a hidden configuration file (Preventing username
// and password for the database from being hard-coded)
$config = parse_ini_file("/etc/config.ini");

// Open a connection to the database and fetch all fruits
$database = new PDO("mysql:host=127.0.0.1;dbname=SSL", $config["username"], $config["password"]);
$fruits = $database->query("SELECT * FROM fruits")->fetchAll(PDO::FETCH_NUM);

// Write the fruits in the response as JSON
echo json_encode($fruits);
