<?php
  if($_FILES):
    // The user has uploaded a file
    $fileUploaded = $_FILES["file_uploaded"]; // Refer to the file more easily with a variable
    if(move_uploaded_file($fileUploaded["tmp_name"], $fileUploaded["name"])) {
      header("Content-Type: image/jpeg"); // Tell the browser which type of file is being returned
      header("Content-Length: " . filesize($fileUploaded["name"])); // Tell the browser how large the file is
      readfile($fileUploaded["name"]); // Return the file to the browser
      unlink($fileUploaded["name"]); // Delete the file from the servers' filesystem to prevent bloat
    };
  else:
    // The user has not uploaded a file, so we'll allow them to
?>
<!DOCTYPE html>
<html>
  <head>
    <title>(1-4) File Uploads</title>
    <style>
      body {
        font-family: "Verdana";
        font-size: 1em;
        padding: 1.5% 15%;
      }
      h4 {
        font-family: "Helvetica Neue";
        font-size: 1.2em;
        font-weight: 300;
        letter-spacing: 0.75px;
      }
    </style>
  </head>
  <body>
    <h4>File Upload</h4>
    <form enctype="multipart/form-data" method="post">
      <input type="file" accept="image/jpeg" name="file_uploaded">
      <br />
      <input type="submit" value="Upload">
    </form>
  </body>
</html>
<?php endif; ?>
