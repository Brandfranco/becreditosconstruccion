<?php
$nombre = $_POST['nombre'];
$identidad = $_POST['identidad'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$ubicacion = $_POST['ubicacion'];
$pagaduria = $_POST['pagaduria'];

if(!empty($nombre)||!empty($identidad)||!empty($telefono)||!empty($email)||
!empty($ubicacion)|| !empty($pagaduria))
{
$host = "localhost";
$dbusarname = "root";
$dbpassword= "";
$dbname = "formuprueba";

$conn = new myspli ($host,$dbusarname,$dbpassword,$dbname);

if(mysqli_connect_error()){
    die('connect error('.mysqli_connect_errno().')'.mysqli_connect_error()');
}
else{

    $SELECT = "SELECT telefono from formulario where telefono = ? limit 1";
    $INSERT = "INSERT INTO formulario (nombre,identidad,telefono,email,ubicacion,pagaduria) values (?,?,?,?,?,?)";
     
    $stmt = $conn-> prepare($SELECT);
    $stmt->bind_param( "i", $telefono);
    $stmt->execute();
    $stmt ->bind_result($telefono);
    $stmt ->store_result();
    $rnum = $stmt->num_rows;

 if ($rnum ==0){
 $stmt->close();
 $stmt -> $conn->prepare($INSERT);
 $stmt->bind_param( "s,i,i,s,s,s", $nombre,$identidad,$telefono,$email,$ubicacion,$pagaduria);
 $stmt->execute();
 echo "REGISTRO COMPLETADO";
 }
 else{

    echo "alguien registro ese numero";
 }
 $stmt->close();
 $conn->close();


}
}

else{
    echo "Todos los datos son obligatorios.";
    die();
}
?>