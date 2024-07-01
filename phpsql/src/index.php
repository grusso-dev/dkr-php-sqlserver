<?php
$serverName = "sqlserver"; // Nombre del servicio definido en docker-compose
$connectionOptions = array(
    "Database" => "master",
    "Uid" => "sa",
    "PWD" => "qweHB2626..."
);

// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Consulta de ejemplo
$sql = "SELECT name FROM sys.databases";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo $row['name'] . "<br />";
}

// Cerrar la conexión
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

?>

