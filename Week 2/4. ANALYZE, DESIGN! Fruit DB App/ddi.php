<?php

  /*  ddi.php
   *  ANALYZE, DESIGN! Fruit DB App
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Tuesday, 6 October, 2015  */

// Choose a database to use. The default is MySQL, although you can choose
// "SQLite", also. The default is MySQL because that's
// what this assignment requires and assumes.
$preferred_DBMS = "MySQL";

class DDI extends PDO {
  /* Properties */
  
  var $database; // Store the database in an instance variable
  var $preferred_DBMS = "Unknown"; // Allow instances to say which DBMS is being used
  
  /* Getters and Setters (Virtual Properties) */
  function __get($fruit) {
    // This is necessary because defining 'fruit' without a getter doesn't
    // only mean the script would fail because the database hasn't been
    // set, but newly created fruits wouldn't show because this will
    // only be set once. We want it to be populated with all of the
    // values within the database at the time of the page reload
    return $this->database->query("SELECT id, name, colour FROM fruits ORDER BY name ASC")->fetchAll(PDO::FETCH_NUM);
  }
  
  /* Methods */
  function __construct($desired_DBMS) {
    // Initialisation method; Called upon instance creation
    
    // Set the $database based on which was preferred
    // See the docstring for these functions. They're just a few lines down!
    (strtolower($desired_DBMS) == "mysql") ? $this->openMySQLConnection() : $this->openSQLiteConnection();
  }
  
  /* Connecting to the Databases */
  function openMySQLConnection() {
    /* 
     * Attempt to open a connection to the MySQL database returning 'TRUE' in the
     * event the connection goes without error, or telling the developer about
     * what went wrong and returning 'FALSE' if the connection fails for some reason
     */
    try {
      // Load the secret database credentials from a file  which is private and
      // only visible to the machine (Only necessary for MySQL -- Not SQLite)
      //
      // (Of course you can simply hard-type the credentials below in the
      // instantiation of the PDO() object if you'd like. I don't know if
      // that would cause an error considering the .ini file probably 
      // doesn't exist. You may need to remove the call to 'parse_ini_file()'.)
      $config = parse_ini_file("/etc/config.ini");
      
      // Allow instances to tell which DMBS is being used
      $this->preferred_DBMS = "MySQL";
      
      // Create a PDO object to interact with the MySQL database; Store
      // the PDO instance in the 'database' instance variable
      $this->database = new PDO("mysql:host=127.0.0.1;dbname=SSL", $config["username"], $config["password"]);
      
      return TRUE; // The PDO object was created without error
    } catch (PDOException $problem) {
      // There was a problem connecting to the MySQL database; Alert the dev with a friendly message if it's possible
      echo "<b>MySQL Problem:</b> " . $problem->getMessage();
      return FALSE; // There was a problem connecting
    }
  }
  
  function openSQLiteConnection() {
    /* 
     * Attempt to open a connection to the SQLite database returning 'TRUE' in the
     * event the connection goes without error, or telling the developer about
     * what went wrong and return 'FALSE' if the connection fails for some reason
     */
    try {
      // Create a PDO object to interact with the SQLite database
      $this->database = new PDO("sqlite:SSL.db");
      
      // Allow instances to tell which DMBS is being used
      $this->preferred_DBMS = "SQLite";
      
      return TRUE; // The PDO object was created without error
    } catch (PDOException $problem) {
      // There was a problem connecting to the SQLite database; Alert the dev with a friendly message if it's possible
      echo "<b>SQLite Problem:</b> " . $problem->getMessage();
      return FALSE; // There was a problem connecting
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
}
