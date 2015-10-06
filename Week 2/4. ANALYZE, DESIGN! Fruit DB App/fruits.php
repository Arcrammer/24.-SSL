<?php
  /*  fruits.php
   *  ANALYZE, DESIGN! Fruit DB App
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Saturday, 3 October, 2015  */

/* You can choose to use either
 * the SSL MySQL database or the
 * SQLite3 database (Stored in
 * the file 'SSL.db' within this
 * directory) by simply setting
 * your preference at the top
 * of 'DDI.php'! There are more
 * details over there. It's the
 * first statement.
 */

// This script contains a class called 'DDI()'
// which interacts with the database for us
include "ddi.php";

// Create an instance of the class to interact with the database
$database = new DDI($preferred_DBMS);

// Attempt to create a new fruit record upon form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["fruit_name"] != NULL && $_POST["fruit_colour"] != NULL) {
  $database->addFruit($_POST["fruit_name"], $_POST["fruit_colour"]);
}

// Fetch the fruit data
$fruit = $database->fruit;
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
      a {
        color: #ec008c;
        font-family: "Helvetica Neue";
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
    <form method="post">
      <label for="fruit_name">Name:</label><input name="fruit_name" id="fruit_name" placeholder="Apple" autocomplete="off" required><br />
      <label for="fruit_colour">Colour:</label><input name="fruit_colour" id="fruit_colour" placeholder="Red"  autocomplete="off" required><br />
      <input type="submit" value="Create">
    </form>
    <p>DBMS: <?= $database->preferred_DBMS ?></p>
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
