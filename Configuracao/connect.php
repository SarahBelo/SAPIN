<?php
//Database connection parameters
$host = 'localhost:3308';
$dbname = 'teste_banco';
$username = 'root';
$password = '';

//Connecting to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
