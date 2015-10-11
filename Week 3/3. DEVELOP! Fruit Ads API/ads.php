<?php
  
  /*  ads.php
   *  ANALYZE, DESIGN! Fruit Ads API
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Friday, 9 October, 2015  */

// The fruit queries each ran at 0.4ms, sometimes 0.3ms and 0.5ms

// This script contains a class called 'DDI()'
// which interacts with the database for us
//
// NOTE: SQLite support is being dropped. I
// didn't want to exclude it because it's so
// nice to have, but it's not worth the time.
//
// I have a lot of other personal projects to
// complete so the DDI() class
// has been modified to drop support.
//
include "ddi.php";

// Open a connection to the database
$database = new DDI();

// Random number for the query string
$randomNumber = rand(0, $database->fruitCount()-1);

// Fetch the fruit data
$todays_fruit = (array) json_decode(file_get_contents("http://localhost:8888/Week%203/3.%20DEVELOP!%20Fruit%20Ads%20API/fruitget.php?id={$randomNumber}"));

?>
<!DOCTYPE html>
<html>
  <head>
    <title>ANALYZE, DESIGN! Fruit Ads API</title>
    <style>
      body {
        background-color: rgb(254,254,254);
        font-family: "Verdana";
        font-size: 1em;
        line-height: 150%;
        padding: 1.5% 15%;
        text-align: center;
      }
      img {
        margin: 5% 0;
        width: 35%;
      }
      a {
        color: #ec008c;
        display: block;
        font-family: "Helvetica Neue";
        text-align: center;
        text-decoration: none;
      }
      a:hover {
        color: #FF0097;
        font-style: italic;
      }
      a:active {
        color: #A20C65;
      }
    </style>
  </head>
  <body>
    <h1>Today's fruit is <?= $todays_fruit["name"] ?>.</h1>
    <a href="fruitget.php?id=<?= $todays_fruit["id"] ?>">API Data of This Fruit</a>
    <img src="Images/<?= $todays_fruit["image"] ?>" alt="<?= $todays_fruit["image"] ?>"><br />
  </body>
</html>
