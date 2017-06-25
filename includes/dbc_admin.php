<?php


//    File: dbc_admin.php
//    Connect Read-only to MySQL databse via PHP



$host = "localhost";
$userName = "mdurkinm_410wrt";
$passWord = "410wrtdatabase";
$dataBase = "mdurkinm_gameSite";

$con = mysqli_connect($host, $userName, $passWord, $dataBase);

$connection_error = mysqli_connect_error();
if($connection_error != null){
    echo "<p>Error connection to database: $connection_error</p>";
}else{
    echo "Connected to Admin MySQL<br>";
}

?>