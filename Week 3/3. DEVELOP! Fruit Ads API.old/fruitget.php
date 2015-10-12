<?php
  
  /*  fruitget.php
   *  ANALYZE, DESIGN! Fruit Ads API
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Saturday, 10 October, 2015  */

// This script contains a class called 'DDI()'
// which interacts with the database for us
include "ddi.php";

// Create an instance of the class to interact with the database
$database = new DDI();

// Encode the JSON and send it back to the client
echo json_encode($database->fruitWithID($_GET["id"]));
