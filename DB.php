<?php 
$servename = "localhost";
$username = "root";
$password = "yago123";
$dbname = "farmacia";

$conn = new mysqli($servename, $username, $password, $dbname);

if($conn->connect_error){
    die("Conexion fallida.");
}

/*
if ($conn) {
   echo "Conexión exitosa a mysql.";
} else {
    echo "Error al conectar a SQL Server: ";
    die(print_r(sqlsrv_errors(), true));
}
*/