<?php
  /*  clients.php
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

// Store the clients for output later
$clients = $database->allClientsByName();

?>
<!DOCTYPE html>
<html>
  <head>
    <title>DEVELOP! Contact Mgr App</title>
    <link rel="stylesheet" href="Main.css">
  </head>
  <body>
    <h4>Clients</h4>
    <?php if (isset($_SESSION["show_success_message"]) && $_SESSION["show_success_message"] != NULL): ?>
      <p class="notification success-notification">The action was successful.</p>
    <?php $_SESSION["show_success_message"] = NULL; endif ?>
    <form action="edit.php" method="get" id="edit-form">
    </form>
    <form action="delete.php" method="get" id="deletion-form">
    </form>
    <?php foreach ($clients as $client): ?>
      <div class="client">
        <h6><?= $client["name"] ?></h6>
        <ul>
          <li><?= $client["phone"] ?></li>
          <li><?= $client["email"] ?></li>
          <li><?= $client["site"] ?></li>
        </ul>
        <button form="edit-form" name="clientWithID" value="<?= $client["id"] ?>" type="submit" class="button">Edit</button>
        <button form="deletion-form" name="clientWithID" value="<?= $client["id"] ?>" type="submit" class="button">Delete</button>
      </div> <!-- .client -->
    <?php endforeach ?>
    <a class="create-button" href="add.php">
      <button class="button">Add</button>
    </a>
  </body>
</html>
