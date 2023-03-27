<?php
$con = mysqli_init();
mysqli_ssl_set($con,NULL,NULL, "{path to CA cert}", NULL, NULL);
mysqli_real_connect($conn, "elibrary1.mysql.database.azure.com", "CloudSAd6857fe5", "Test@123", "{your_database}", 3306, MYSQLI_CLIENT_SSL);
?>
