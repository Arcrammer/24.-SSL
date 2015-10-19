<?php
  /*  edit.php
   *  DEVELOP! Contact Mgr App
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Saturday, 17 October, 2015  */

// Start the session
session_start();

// Include 'DDI()'
include "ddi.php";

// Connect to the database
$database = new DDI();

// Fetch the data for the client with the ID sent
$client = $database->clientWithID($_GET["clientWithID"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // The user has attempted to save the new data; Update the database records
  
  // Update the '$client' object
  $client["name"] = $_POST["client_name"];
  $client["phone"] = $_POST["phone_number"];
  $client["email"] = $_POST["email_address"];
  $client["site"] = $_POST["site"];
  
  // Update the database record of the client; Send the
  // user to 'clients.php' if the update was successful
  if ($database->updateClient($client)) {
    $_SESSION["show_success_message"] = true;
    header("Location: clients.php");
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>DEVELOP! Contact Mgr App</title>
    <link rel="stylesheet" href="Main.css">
  </head>
  <body>
    <form method="post">
      <input type="text" name="client_name" value="<?= $client["name"] ?>"><br />
      <input type="tel" name="phone_number" value="<?= $client["phone"] ?>"><br />
      <input type="email" name="email_address" value="<?= $client["email"] ?>"><br />
      <input type="url" name="site" value="<?= $client["site"] ?>"><br />
      <input type="submit" class="button" value="Save">
    </form>
  </body>
</html>
