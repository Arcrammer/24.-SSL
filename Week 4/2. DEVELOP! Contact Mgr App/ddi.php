<?php
  /*  ddi.php
   *  DEVELOP! Contact Mgr App
   *  Server-Side Languages
   *  Full Sail University
   *  
   *  Alexander Rhett Crammer
   *  Saturday, 17 October, 2015  */

class DDI extends PDO {
  /* Properties */
  var $database;
  
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
  
  /* Adding clients to the database */
  function addClient($client) {
    // Start a query for creating a new client
    $query = $this->database->prepare("INSERT INTO clients (name, phone, email, site) VALUES (:name, :phone, :email, :site)");
    
    // Bind parameters to the query
    $query->bindParam(":name", $client["name"]);
    $query->bindParam(":phone", $client["phone"]);
    $query->bindParam(":email", $client["email"]);
    $query->bindParam(":site", $client["site"]);
    
    // Return a boolean representing whether the query failed
    return $query->execute();
  }
  
  /* Fetching clients from the database */
  function allClients() {
    return $this->database->query("SELECT * FROM clients")->fetchAll();
  }
  
  function allClientsByName() {
    return $this->database->query("SELECT * FROM clients ORDER BY name ASC")->fetchAll();
  }
  
  function clientWithID($id) {
    // Return a client with a given ID
    return $this->database->query("SELECT * FROM clients WHERE id='{$id}'")->fetch(PDO::FETCH_ASSOC);
  }
  
  function updateClient($withClientData) {
    // Prepare the query
    $queryForUpdatingClient = $this->database->prepare("UPDATE clients SET name=:name, phone=:phone, email=:email, site=:site WHERE id=:id");
    
    // Bind the parameters
    $queryForUpdatingClient->bindValue(":name", $withClientData["name"]);
    $queryForUpdatingClient->bindValue(":phone", $withClientData["phone"]);
    $queryForUpdatingClient->bindValue(":email", $withClientData["email"]);
    $queryForUpdatingClient->bindValue(":site", $withClientData["site"]);
    $queryForUpdatingClient->bindValue(":id", $withClientData["id"]);
    
    // Execute the query; Return a boolean representing whether the query failed
    return $queryForUpdatingClient->execute();
  }
  
  function deleteClient($withID) {
    return $this->database->query("DELETE FROM clients WHERE id={$withID}");
  }
}
