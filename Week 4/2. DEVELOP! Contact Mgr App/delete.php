<?php
  /*  delete.php
   *  DEVELOP! Contact Mgr App
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Saturday, 17 October, 2015  */

// If the form in this document was submitted, delete the
// user; Tell the next page to display a success message

// Start the session
session_start();

// Include 'DDI()'
include "ddi.php";

// Connect to the database
$database = new DDI();

// Fetch the client data
$client = $database->clientWithID($_GET["clientWithID"]);

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["deletion_confirmation"] != NULL) {
  // The user has confirmed they want to delete the client
  
  // Delete the client
  if ($database->deleteClient($_GET["clientWithID"])) {
    // The deletion was successful
    
    // Flash a success message
    $_SESSION["show_success_message"] = true;
    
    // Send the user to 'clients.php'
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
    <div class="deletion-page">
      <p>Are you sure you want to delete <i><?= $client["name"] ?></i>?</p>
      <form method="post">
        <input type="submit" class="button" name="deletion_confirmation" value="Yes">
      </form>
      <a href="clients.php">Nevermind</a>
    </div> <!-- .deletion-page -->
  </body>
</html>
