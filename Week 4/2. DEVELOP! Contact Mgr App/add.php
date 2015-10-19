<?php
  /*  add.php
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

// Set some default values for when the user hasn't submitted data
$emptyDataSubmitted = FALSE;
$missingDataForFields = [];

// Handle the form submission then send the user back to 'clients.php'
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // The user has submitted the form
  
  // Store the variables from the $_POST superglobal
  $client = [
    "name" => $_POST["client_name"],
    "phone" => $_POST["phone_number"],
    "email" => $_POST["email_address"],
    "site" => $_POST["site"]
  ];
  
  // Sanitize the values
  filter_var($client["name"], FILTER_SANITIZE_SPECIAL_CHARS);
  filter_var($client["phone"], FILTER_SANITIZE_NUMBER_INT);
  filter_var($client["email"], FILTER_SANITIZE_EMAIL);
  filter_var($client["site"], FILTER_SANITIZE_URL);
  filter_var($client["site"], FILTER_SANITIZE_ENCODED);
  
  // Look through each submitted value for missing data
  foreach (array_values($client) as $index => $clientData) {
    if (empty(trim($clientData))) {
      // Empty data was found
      $emptyDataSubmitted = true;
      array_push($missingDataForFields, $index);
    }
  }
  
  if ($emptyDataSubmitted == FALSE) {
    // The user has submitted valid and populated client data
    
    // Connect to the database
    $database = new DDI();
    
    // Add the new client to the database
    $clientAdditionSucceeded = $database->addClient($client);
    
    if ($clientAdditionSucceeded) {
      // Show a success message in the next page
      $_SESSION["show_success_message"] = true;
      
      // Send the user to 'clients.php'
      header("Location: clients.php");
    }
  }
}

// Store data about each client to the database

// After save send the user to 'clients.php'

?>
<!DOCTYPE html>
<html>
  <head>
    <title>DEVELOP! Contact Mgr App</title>
    <link rel="stylesheet" href="Main.css">
  </head>
  <body>
    <h4 class="page-title">New Client</h4>
    <?php if ($emptyDataSubmitted): ?>
      <p class="notification problem-notification">Are you missing some data?</p>
    <?php endif ?>
    <form method="post">
      <input type="text" name="client_name" placeholder="Name" <?php if (in_array(0, $missingDataForFields)): echo 'class="missing-data"'; endif ?>><br />
      <input type="tel" name="phone_number" placeholder="Phone" <?php if (in_array(1, $missingDataForFields)): echo 'class="missing-data"'; endif ?>><br />
      <input type="email" name="email_address" placeholder="Email" <?php if (in_array(2, $missingDataForFields)): echo 'class="missing-data"'; endif ?>><br />
      <input type="url" name="site" placeholder="Site" <?php if (in_array(3, $missingDataForFields)): echo 'class="missing-data"'; endif ?>><br />
      <input type="submit" class="button" value="Create">
    </form>
  </body>
</html>
