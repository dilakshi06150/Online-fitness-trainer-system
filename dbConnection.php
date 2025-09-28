<?php

$dbServer = 'localhost';
$dbUser = 'root';
$dbPwd = '';
$dbName = 'online_fitness_trainer';

$conn = mysqli_connect($dbServer, $dbUser, $dbPwd, $dbName);

if (!$conn) {
    die("Connection failed!" . mysqli_connect_error());
}
