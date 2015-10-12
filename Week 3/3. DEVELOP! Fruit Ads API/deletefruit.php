<?php

  /*  deletefruit.php
   *  ANALYZE, DESIGN! Fruit DB App
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Tuesday, 6 October, 2015  */

// This script contains a class called 'DDI()'
// which interacts with the database for us
include "ddi.php";

// Create an instance of the class to interact with the database
$database = new DDI();

$database->destroyFruitWithID($_GET["id"]);

// Send the user to the fruit table
header("Location: fruitads.php");
