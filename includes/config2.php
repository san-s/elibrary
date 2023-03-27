<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:elibrary1.database.windows.net,1433; Database = elibrary", "CloudSAd6857fe5", "Test@123");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "CloudSAd6857fe5", "pwd" => "{your_password_here}", "Database" => "elibrary", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:elibrary1.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>
