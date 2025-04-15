<?php
$serverName = "sqlserver";
$connectionOptions = [
    "Database" => "PersonasDB",
    "Uid" => "sa",
    "PWD" => "TuPassword123!",
    "Encrypt" => "no"
];

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    echo "❌ Error de conexión.<br>";
    print_r(sqlsrv_errors());
    exit;
}

$sql = "SELECT Nombre, Apellido FROM Personas";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    echo "❌ Error al ejecutar la consulta.<br>";
    print_r(sqlsrv_errors());
    exit;
}

echo "<h2>Lista de personas:</h2><ul>";
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<li>{$row['Nombre']} {$row['Apellido']}</li>";
}
echo "</ul>";

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
