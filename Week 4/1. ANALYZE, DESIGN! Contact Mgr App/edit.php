<?php
  /*  edit.php
   *  ANALYZE, DESIGN! Contact Mgr App
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Saturday, 17 October, 2015  */

// Fetch the record from the database and allow the user
// to update it then send the user back to 'clients.php'
//
// Tell the next page to display a success message
//
?>
<!DOCTYPE html>
<html>
  <head>
    <title>ANALYZE, DESIGN! Contact Mgr App</title>
  </head>
  <body>
    <form method="post">
      <input type="text" name="client_name"><br />
      <input type="tel" name="phone_number"><br />
      <input type="email" name="email_address"><br />
      <input type="url" name="site">
    </form>
  </body>
</html>
