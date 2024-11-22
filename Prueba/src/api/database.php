<?php

//-------------------------------------------------------------------------------------------------------
//          server:text, username:text, password:text, database:text --> database()
//-------------------------------------------------------------------------------------------------------
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'bio';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}