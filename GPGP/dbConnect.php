<?php
/*
    'The Connection File'
    this file will handle the connection between your program and a database server

    We are going to use PDO (PHP Data Objects) for all database processing

    Note: should be on .gitIgnore list!!!!
        DO NOT upload to your host, make a version specific to your host account

    Opens, and holds open, a doorway between your php processor and the database server
*/
$servername = "localhost";       //generally the same for local hosting account
$username = "root";             //database username, different on local vs hosting account
$password = "root";                 //database password, different on local vs hosting account
$databasename = "gpgp";        //will differ between local and hosting account

try {   //says 'I am going to listen to code and see if I can handle it'
        //make a new PDO object
  $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);  //making a new 'connection object'

  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} 

catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>