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
 * your preference below
 */

// Choose a database to use. The default is MySQL, although you can choose "SQLite", also
$preferred_DBMS = "MySQL"; // The default is MySQL because that's what this assignment assumes

// Attempt to save memory by storing the PDO object here for use later
// (I don't know if this helps but I'm having so much fun! Sorry if
// I'm being annoying with my exceedingly large and overboard script.)
$database = NULL;

// Make future comparison easier
$preferred_DBMS = strtolower($preferred_DBMS);

// Set the $database based on which was preferred
($preferred_DBMS == "mysql") ? openMySQLConnection() : openSQLiteConnection(); // See the docstring for these functions. They're just a few lines down!

// Attempt to create a new fruit record upon form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["fruit_name"] != NULL && $_POST["fruit_colour"] != NULL) {
  // Prepare a statement for insertion of the new fruit data
  $fruit_insertion_query = $database->prepare("INSERT INTO fruits (name, colour) VALUES (:name, :colour)");
  
  // Bind the parameters to the prepared statement
  $fruit_insertion_query->bindParam(":name", $_POST["fruit_name"]);
  $fruit_insertion_query->bindParam(":colour", $_POST["fruit_colour"]);
  
   // Execute the query
  $fruit_insertion_query->execute();
}

// Fetch the fruit data
$fruit = $database->query("SELECT id, name, colour FROM fruits")->fetchAll(PDO::FETCH_NUM);

// Fortunately PHP allows the definition of functions before they're called!
function openMySQLConnection() {
  /* 
   * Attempt to open a connection to the MySQL database returning 'TRUE' in the
   * event the connection goes without error, or telling the developer about
   * what went wrong and return 'FALSE' if the connection fails for some reason
   */
  try {
    // Load the secret database credentials from a file  which is private and
    // only visible to the machine (Only necessary for MySQL -- Not SQLite)
    $config = parse_ini_file("/etc/config.ini");
    
    // Create a PDO object to interact with the MySQL database
    $mysql_database = new PDO("mysql:host=127.0.0.1;dbname=SSL", $config["username"], $config["password"]);
    
    // Put the PDO object in the scope one level
    // higher so other objects can use it later
    $GLOBALS["database"] = $mysql_database;
    return TRUE; // The PDO object was created without error
  } catch (PDOException $problem) {
    // There was a problem connecting to the MySQL database; Alert the dev with a friendly message if it's possible
    echo "<b>MySQL Problem:</b> " . $problem->getMessage();
    return FALSE; // There was a problem connecting
  }
}

function openSQLiteConnection() {
  /* 
   * Attempt to open a connection to the SQLite database returning 'TRUE' in the
   * event the connection goes without error, or telling the developer about
   * what went wrong and return 'FALSE' if the connection fails for some reason
   */
  try {
    // Create a PDO object to interact with the SQLite database
    $sqlite_database = new PDO("sqlite:SSL.db");
    
    // Put the PDO object in the scope one level
    // higher so other objects can use it
    $GLOBALS["database"] = $sqlite_database;
    return TRUE; // The PDO object was created without error
  } catch (PDOException $problem) {
    // There was a problem connecting to the SQLite database; Alert the dev with a friendly message if it's possible
    echo "<b>SQLite Problem:</b> " . $problem->getMessage();
    return FALSE; // There was a problem connecting
  }
}
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
    </style>
  </head>
  <body>
    <form method="post">
      <label for="fruit_name">Name:</label><input name="fruit_name" id="fruit_name" placeholder="Apple"><br />
      <label for="fruit_colour">Colour:</label><input name="fruit_colour" id="fruit_colour" placeholder="Red"><br />
      <input type="submit" value="Create">
    </form>
    <table>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Colour</th>
      </tr>
      <?php foreach ($fruit as $single_fruit): ?>
      <tr>
        <td><?= $single_fruit[0] ?></td>
        <td><?= $single_fruit[1] ?></td>
        <td><?= $single_fruit[2] ?></td>
      </tr>
      <?php endforeach ?>
    </table>
  </body>
</html>
