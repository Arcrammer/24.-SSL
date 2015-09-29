<?php
  function findLetterGrade($forNumericalGrade) {
    $letterGrade = NULL;
    if ($forNumericalGrade >= 90.00 && $forNumericalGrade <= 100.00) {
      $letterGrade = "A";
    } elseif ($forNumericalGrade >= 80.00 && $forNumericalGrade <= 89.99) {
      $letterGrade = "B";
    } elseif ($forNumericalGrade >= 70.00 && $forNumericalGrade <= 79.99) {
      $letterGrade = "C";
    } elseif ($forNumericalGrade >= 60.00 && $forNumericalGrade <= 69.99) {
      $letterGrade = "D";
    } elseif ($forNumericalGrade >= 0.00 && $forNumericalGrade <= 60.99) {
      $letterGrade = "F";
    }
    return ($letterGrade) ? $letterGrade : "Unknown. Was the number you passed too high or low?";
  }
  
  echo "Letter: " . findLetterGrade(94) . "<br /><br />";
  echo "Letter: " . findLetterGrade(54) . "<br /><br />";
  echo "Letter: " . findLetterGrade(89.9) . "<br /><br />";
  echo "Letter: " . findLetterGrade(60.01) . "<br /><br />";
  echo "Letter: " . findLetterGrade(102.1);
?>
