<!DOCTYPE html>
<html>
  <head>
    <title>(1-3) Loops</title>
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
    <h4>Array of Colours</h4>
    <?php
      $colours = ["Red", "Pink", "Blue", "Aquamarine", "Green", "Lime"];
      foreach ($colours as $index => $colour) {
        echo "Colour #{$index} is {$colour}.<br /><br />";
      }
    ?>
    <h4>Reversed Array of Colours</h4>
    <?php
      foreach (array_reverse($colours, TRUE) as $index => $colour) {
        echo "Colour #{$index} is {$colour}.<br /><br />";
      }
    ?>
    <h4>Even Keys in Array of Colours</h4>
    <?php
      foreach ($colours as $index => $colour) {
        if ($index % 2 == 0) {
          /* The key is even, so we'll write it out */
          echo "Colour #{$index} is {$colour}.<br /><br />";
        }
      }
    ?>
  </body>
</html>
