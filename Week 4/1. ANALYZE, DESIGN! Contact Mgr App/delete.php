<?php
  /*  delete.php
   *  ANALYZE, DESIGN! Contact Mgr App
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Saturday, 17 October, 2015  */

// If the form in this document was submitted, delete the
// user; Tell the next page to display a success message

?>
<!DOCTYPE html>
<html>
  <head>
    <title>ANALYZE, DESIGN! Contact Mgr App</title>
  </head>
  <body>
    <p>Are you sure you want to delete <?php // The clients' name ?>?</p>
    <a href="clients.php">Nevermind</a>
    <form method="post">
      <input type="submit" name="deletion_confirmation" value="Yes">
    </form>
  </body>
</html>
