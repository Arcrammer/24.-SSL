<?php
  /*  activity2-2.php
   *  Graphic Image Manipulation
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Friday, 2 October, 2015  */

// Create the image
$image_of_text = imagecreatetruecolor(1675, 225);
imagefill($image_of_text, 0, 0, imagecolorallocate($image_of_text, 255, 255, 255));
imagefttext($image_of_text, 100, 0, 75, 150, imagecolorallocate($image_of_text, 236, 0, 140), "/Library/Fonts/Trebuchet MS.ttf", "Alexander Rhett Crammer");

// Send the image to the client
header("Content-Type: image/jpeg");
// imagejpeg($image_of_text, NULL, 100);
imagedestroy($image_of_text);

// Create an image resource from the .jpg
$london = imagecreatefromjpeg("London.jpg");
imagefill($london, 0, 0, imagecolorallocate($london, 255, 255, 255));
imagefttext($london, 100, 0, 50, 575, imagecolorallocate($london, 255, 255, 255), "FLOW", "Alexander Rhett Crammer");
imagejpeg($london);
imagedestroy($london);
?>
