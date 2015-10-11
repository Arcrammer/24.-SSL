<?php

  /*  ddi.php
   *  ANALYZE, DESIGN! Fruit Ads API
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Saturday, 10 October, 2015  */

class DDI extends PDO {
  /* Properties */
  var $database; // Store the database in an instance variable
  
  /*
   * Note about the '__get()' magic method:
   * I've heard it's bad to use them for many reasons so I've moved the
   * 'fruit' property to a method which returns the same value, 'allFruit()'
   */
  
  /* Methods */
  function __construct() {
    // Initialisation method; Called upon instance creation
    
    // Try to open a connection to the database
    try {
      // Load the secret database credentials from a file  which is private and
      // only visible to the machine (Only necessary for MySQL -- Not SQLite)
      //
      // (Of course you can simply hard-type the credentials below in the
      // instantiation of the PDO() object if you'd like. I don't know if
      // that would cause an error considering the .ini file probably 
      // doesn't exist. You may need to remove the call to 'parse_ini_file()'.)
      $config = parse_ini_file("/etc/config.ini");
      
      // Create a PDO object to interact with the MySQL database; Store
      // the PDO instance in the 'database' instance variable
      $this->database = new PDO("mysql:host=127.0.0.1;dbname=SSL", $config["username"], $config["password"]);
    } catch (PDOException $problem) {
      // There was a problem connecting to the MySQL database; Alert the dev with a friendly message if it's possible
      echo "<b>MySQL Problem:</b> " . $problem->getMessage();
    }
  }
  
  /* Creating Records in the Databases */
  function addFruit($fruit_name, $fruit_colour) {
    // Prepare a statement for insertion of the new fruit data
    $fruit_insertion_query = $this->database->prepare("INSERT INTO fruits (name, colour) VALUES (:name, :colour)");
    
    // Bind the parameters to the prepared statement
    $fruit_insertion_query->bindParam(":name", $fruit_name);
    $fruit_insertion_query->bindParam(":colour", $fruit_colour);
    
     // Execute the query; Return a boolean to represent success or failure
    return $fruit_insertion_query->execute();
  }
  
  /* Destroying Records in the Database */
  function destroyFruitWithID($fruit_id) {
    // Prepare a statement for the deletion of a fruit object
    $fruit_deletion_query = $this->database->prepare("DELETE FROM fruits WHERE id={$fruit_id}");
    
    // Execute the query; Return a boolean to represent success or failure
    return $fruit_deletion_query->execute();
  }
  
  /* Returning Properties */
  function allFruit() {
    return $this->database->query("SELECT id, name, colour FROM fruits ORDER BY name ASC")->fetchAll(PDO::FETCH_NUM);
  }
  
  function fruitWithID($ID) {
    return (array) $this->database->query("SELECT * FROM fruits WHERE id='{$ID}'")->fetchObject();
  }
  
  function randomFruit() {
    return (array) $this->database->query("SELECT * FROM fruits ORDER BY RAND() LIMIT 1")->fetchObject();
  }
  
  function fruitCount() {
    return $this->database->query("SELECT * FROM fruits")->rowCount();
  }
}
