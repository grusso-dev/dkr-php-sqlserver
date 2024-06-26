<?php
/*
$usuario= 'tmssTemasisDevUsr001';
$pass = 'vaqueriendo@2017';
$servidor = '190.105.225.234';
$basedatos = 'tmssTemasisDev';

$info = array('Database'=>$basedatos, 'UID'=>$usuario, 'PWD'=>$pass); 
$conexion = sqlsrv_connect($servidor, $info);  
*/
$usuario= 'sa';
$pass = 'Password01';
$servidor = 'localhost';
$basedatos = 'testdb';

$info = array('Database'=>$basedatos, 'UID'=>$usuario, 'PWD'=>$pass); 
$conexion = sqlsrv_connect($servidor, $info);  


if(!$conexion){

 die( print_r( sqlsrv_errors(), true));

 }
 //var_dump($conexion);
echo 'Conectado a: <br> '.$servidor . '->'.$basedatos ; 

/*



$query = 'Select * from test';
$registros = sqlsrv_query($conexion, $query);





while($row = sqlsrv_fetch_object($registros)){
     
echo "
<br>
$row->nombre
<br>
$row->apellido
<br>
$row->direccion
<br>";
	
}

*/
?>
