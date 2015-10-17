<?php
  /*  clients.php
   *  ANALYZE, DESIGN! Contact Mgr App
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Saturday, 17 October, 2015  */

?>
<!DOCTYPE html>
<html>
  <head>
    <title>ANALYZE, DESIGN! Contact Mgr App</title>
  </head>
  <body>
    <?php // Show a success message (for a CRUD action) if necessary ?>
    <form action="edit.php" method="post" id="edit-form">
    </form>
    <form action="delete.php" method="post" id="deletion-form">
    </form>
    <?php // Iterate through client data and display each record ?>
    <div class="client">
      <h4>Name</h4>
      <ul>
        <li>Phone Number</li>
        <li>Email Address</li>
        <li>Site</li>
      </ul>
      <button form="edit-form" type="submit">Edit</button>
      <button form="deletion-form" type="submit">Delete</button>
    </div> <!-- .client -->
  </body>
</html>
