<?php
/*
channel => @mirzapanel
*/
//-----------------------------database-------------------------------
$dbname = "databasename"; // Database Name
$usernamedb = "username"; // Database Username
$passworddb = "password"; // Database password
$connect = mysqli_connect("localhost", $usernamedb, $passworddb, $dbname);
if ($connect->connect_error) {
    die("The connection to the database failed:" . $connect->connect_error);
}
mysqli_set_charset($connect, "utf8mb4");
//-----------------------------info-------------------------------

$APIKEY = "**TOKEN**"; // Enter your bot token
$adminnumber = "5522424631"; // Admin numeric ID
$domainhosts = "domain.com/bot"; // Domain host and source path
$usernamebot = "marzbaninfobot"; // Bot username without @



$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$dsn = "mysql:host=localhost;dbname=$dbname;charset=utf8mb4";
try {
     $pdo = new PDO($dsn, $usernamedb, $passworddb, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
