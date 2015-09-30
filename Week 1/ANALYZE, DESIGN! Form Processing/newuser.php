<?php
  /*  newuser.php
   * DEVELOP! Form Processing
   * Server-Side Languages
   * Full Sail University
   * Alexander Rhett Crammer  */
   
   function formatFormData() {
     // Encrypt and salt the password
     $hashedPassword = password_hash($_POST["password"], PASSWORD_BCRYPT, ["cost" => 12]);
     
     // Write the image to the filesystem
     // then return its' path to a variable
     return [
       "first_name" => $_POST["first_name"],
       "last_name" => $_POST["last_name"],
       "username" => $_POST["username"],
       "encrypted_password" => $hashedPassword,
       "selfie" => ""
     ];
   }
   print_r(formatFormData());
?>