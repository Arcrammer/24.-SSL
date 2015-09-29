<?php
  if(!empty($_POST["school_email"]) && !empty($_POST["personal_email"])):
    // Pull the data from the $_POST superglobal for easier access
    $schoolEmailAddress = $_POST["school_email"];
    $personalEmailAddress = $_POST["personal_email"];
    // The form was submitted and there was data sent
    //
    // Normally I'd store this HTML in another file or something but
    // for the sake of having only two files I'll throw it in here
    // the old fashioned way.
    //
    // First, however, let's check the validity of the two email
    // addresses using the built-in validation abilities
    //
    if (filter_var($schoolEmailAddress, FILTER_VALIDATE_EMAIL)) {
      $schoolEmailValidity = "Valid";
    } else {
      $schoolEmailValidity = "Invalid";
    }
    // And again for the personal address...
    if (filter_var($personalEmailAddress, FILTER_VALIDATE_EMAIL)) {
      $personalEmailValidity = "Valid";
    } else {
      $personalEmailValidity = "Invalid";
    }
  ?>
<!DOCTYPE html>
<html>
  <head>
    <title>(1-4) Validating User Input </title>
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
      span {
        font-family: "Helvetica Neue", "Helvetica", sans-serif;
        font-weight: 200;
        letter-spacing: 1.75px;
        text-transform: uppercase;
      }
      .validitiyStatusValid {
        color: green;
      }
      .validitiyStatusInvalid {
        color: red;
      }
      .fullSailor {
        color: #ff952d;
      }
      .alternateUniTLD {
        color: gray;
      }
    </style>
  </head>
  <body>
    <p><span>University <?php
      // Find whether the email address was found to be valid or not and write that to the label
      if ($schoolEmailValidity == "Valid") {
        // The school email address was valid, now to check whether the
        // email address ends in 'fullsail.edu' or 'fullsail.com'
        if (preg_match("/fullsail.edu$/", $schoolEmailAddress)) {
          // Their email address is a students ending in '.edu'
          echo '<span class="validitiyStatusValid">(' . $schoolEmailValidity . ', <span class="fullSailor">@fullsail.edu</span>)</span>';
        } elseif (preg_match("/fullsail.com$/", $schoolEmailAddress)) {
          // Their email address is an instructors ending in '.com'
          echo '<span class="validitiyStatusValid">(' . $schoolEmailValidity . ', <span class="fullSailor">@fullsail.com</span>)</span>';
        } else {
          // The email address ends in neither 'fullsail.edu' nor 'fullsail.com'; Highlight the fact that they're not a Full Sailor
          echo '<span class="validitiyStatusValid">(' . $schoolEmailValidity . ', <span class="alternateUniTLD">Not Full Sail</span>)</span>';
        }
      } else {
        // The school email address wasn't a valid email address
        echo '<span class="validitiyStatusInvalid">(' . $schoolEmailValidity . ')</span>';
      }
    ?>:</span> <?= $schoolEmailAddress ?></p>
    <p><span>Personal <?php
      // Find whether the email address was found to be valid or not and write that to the label
      echo ($personalEmailValidity == "Valid")
        ? '<span class="validitiyStatusValid">(' . $personalEmailValidity . ')</span>'
        : '<span class="validitiyStatusInvalid">(' . $personalEmailValidity . ')</span>';
    ?>:</span> <?= $personalEmailAddress ?></p>
  </body>
</html>
  <?php else:
    // The form was submitted but there's either missing or no data
    header("Location: /activity1-5.html?missingData=true"); // Send them back to the form
  endif;
?>