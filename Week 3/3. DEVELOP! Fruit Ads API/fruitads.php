<?php
  /*  fruitads.php
   *  ANALYZE, DESIGN! Fruit DB App
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Monday, 12 October, 2015  */

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

// Default values
$longURL = false;

// Attempt to create a new fruit record upon form submission
if ($_SERVER["REQUEST_METHOD"] == "POST"
    && $_POST["fruit_name"] != NULL
    && $_POST["fruit_colour"] != NULL
    && $_POST["fruit_image"] != NULL) {
 $database->addFruit($_POST["fruit_name"], $_POST["fruit_colour"], $_POST["fruit_image"]);
  if (strlen($_POST["fruit_image"]) > 512) {
    $longURL = true;
  }
}

// Fetch the fruit data
$fruit = $database->allFruit();

// Because the user is allowed to delete fruit data, the value returned by
// the following solution may return an ID value which there's no object for.
//
//   $randomNumber = rand(0, $database->fruitCount()-1);
//
// This is the reason 'DDI' uses an SQL query to randomise the results, instead.
//
// Fetch the fruit data
$todays_fruit = $database->randomFruit();

?>
<!DOCTYPE html>
<html>
  <head>
    <title>ANALYZE, DESIGN! Fruit DB App</title>
    <style>
      body {
        background-color: rgb(254,254,254);
        font-family: "Verdana";
        font-size: 1em;
        line-height: 150%;
        padding: 1.5% 15%;
      }
      label {
        color: #272727;
        letter-spacing: 0.35px;
      }
      p:first-of-type {
        font-family: "Helvetica Neue", "Helvetica", sans-serif;
        font-size: 0.85em;
        letter-spacing: 0.75px;
        margin-top: 3.5%;
        text-align: center;
      }
      form {
        float: left;
        margin: auto;
        margin-top: 5%;
        width: 50%;
      }
      input {
        background-color: #FBFBFB;
        border: 1px solid #F1F1F1;
        border-radius: 100px;
        border-width: 3px;
        color: #525252;
        font-family: "Georgia", "Times New Roman", serif;
        font-size: 1em;
        font-style: italic;
        letter-spacing: 0.75px;
        margin-bottom: 5%;
        margin-left: 2.5%;
        outline: none;
        padding: 5% 10%;
        transition: all 175ms;
      }
      input:hover {
        background-color: #fff;
        border-color: lightcyan;
      }
      input:hover, input:active {
        color: #565656;
      }
      input[type="submit"] {
        cursor: pointer;
        display: block;
        margin: auto;
      }
      ul {
        list-style-type: decimal;
      }
      table {
        margin: 5% 0;
        width: 100%;
      }
      th {
        font-weight: 100;
        letter-spacing: 1.25px;
        padding: 1.5% 0;
        text-align: left;
        text-transform: uppercase;
      }
      th:first-of-type, td:first-of-type {
        text-align: center;
      }
      tr {
        height: 50px;
      }
      tr:nth-child(2n) {
        background-color: lightcyan;
      }
      .todays-fruit {
        float: left;
        width: 50%;
      }
      .todays-fruit img {
        display: block;
        margin: 5% auto;
        width: 50%;
      }
      .todays-fruit h1 {
        line-height: 125%;
        text-align: center;
      }
      p.warning {
        color: Red;
        letter-spacing: 0.25px;
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
    <?php if ($longURL): // The image wasn't added because its' URL was too long ?>
    <p class="warning">The images' URL was too long to add to the database.<br />The fruit was not created.</p>
    <?php endif ?>
    <form method="post">
      <label for="fruit_name">Name:</label><input name="fruit_name" id="fruit_name" placeholder="Apple" autocomplete="off" required><br />
      <label for="fruit_colour">Colour:</label><input name="fruit_colour" id="fruit_colour" placeholder="Red"  autocomplete="off" required><br />
      <label for="fruit_image">Image:</label><input name="fruit_image" id="fruit_image" placeholder="http://"  autocomplete="off" required><br />
      <input type="submit" value="Create">
    </form>
    <div class="todays-fruit">
      <h1>Today's fruit is <?= $todays_fruit["name"] ?>.</h1>
      <a href="fruitget.php?id=<?= $todays_fruit["id"] ?>">API Data of This Fruit</a>
      <?php
        // Choose whether to display a local image or a remote one
        // 
        // NOTE: Because 'http' begins at the zeroeth index, 'strpos()'
        // returns an int of 0, which is the same as the boolean 'false'
        // in PHP. This is the reason a strict comparison operator 
        // against the 'false' boolean value is necessary.
        //
        if (strpos($todays_fruit["image"], "http") !== false): ?>
          <img src="<?= $todays_fruit["image"] ?>" alt="<?= $todays_fruit["image"] ?>"><br />
        <?php else: ?>
          <img src="Images/<?= $todays_fruit["image"] ?>" alt="<?= $todays_fruit["image"] ?>"><br />
        <?php endif ?>
    </div> <!-- .todays-fruit -->
    <table>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Colour</th>
        <th>Manage</th>
      </tr>
      <?php foreach ($fruit as $single_fruit): ?>
      <tr>
        <td><?= $single_fruit[0] ?></td>
        <td><?= $single_fruit[1] ?></td>
        <td><?= $single_fruit[2] ?></td>
        <td><a href="deletefruit.php?id=<?= $single_fruit[0] ?>">Delete</a></td>
      </tr>
      <?php endforeach ?>
    </table>
  </body>
</html>
