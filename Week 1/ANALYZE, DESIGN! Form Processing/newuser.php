<?php
  /*  newuser.php
   * DEVELOP! Form Processing
   * Server-Side Languages
   * Full Sail University
   * Alexander Rhett Crammer  */
   
   function formatFormData() {
     // Encrypt and salt the password
     $hashedPassword = password_hash($_POST["password"], PASSWORD_BCRYPT, ["cost" => 12]);
     return [
       "first_name" => $_POST["first_name"],
       "last_name" => $_POST["last_name"],
       "username" => $_POST["username"],
       "encrypted_password" => $hashedPassword
     ];
   }
   
   function saveSelfie() {
     // Write the image to the filesystem
     // with a random alphanumeric (URL
     // friendly) string as its' name,
     // then return its' path.
     //
     // Also append the file extension so we
     // know whether its' a jpeg or png.
     //
    $localSelfieFileName = "Assets/Selfies/" . md5(uniqid(rand(), true)) . "." . strtolower(pathinfo($_FILES["selfie"]["name"], PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["selfie"]["tmp_name"], $localSelfieFileName);
    return $localSelfieFileName;
   }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Submitted Information // ANALYZE, DESIGN! Form Processing</title>
    <style>
      body {
        font-family: "Verdana";
        font-size: 1em;
        line-height: 215%;
        padding: 1.5% 0 1.5% 15%;
      }
      h4 {
        font-family: "Helvetica Neue";
        font-size: 1.2em;
        font-weight: 300;
        letter-spacing: 0.75px;
      }
      img {
        vertical-align: top;
        width: 35%;
      }
    </style>
  </head>
  <body>
    <p>
      <?php
        foreach(formatFormData() as $key => $value) {
          echo "${key} &raquo; ${value}<br />";
        }
        $selfiePath = saveSelfie();
        $selfieName = pathinfo($selfiePath, PATHINFO_BASENAME);
        echo 'image &raquo; <img src="' . $selfiePath . '" alt="' . $selfieName . '">';
      ?>
    </p>
  </body>
</html>
