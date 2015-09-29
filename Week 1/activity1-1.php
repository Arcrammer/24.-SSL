<?php
  $name = "Alexander Rhett Crammer";
  $age = 19;
  $person = [$name, $age];
  $person["name"] = $name;
  $person["age"] = $age;
  
  echo "My name is ${name} and age is ${age}.";
  echo "<br /><br />";
  echo 'My name is ' . $name . ' and age is ' . $age . '.';
  echo "<br /><br />";
  echo "My name is ${person[0]} and age is ${person[1]}.";
  echo "<br /><br />";
  echo "My name is ${person['name']} and age is ${person['age']}.";
  echo "<br /><br />";
  
  $age = NULL;
  echo "I'm ${age}.";
  
  unset($name);
  echo "I'm ${name}.";
?>