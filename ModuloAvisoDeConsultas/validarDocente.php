<?php
$email=$_POST['email'];
$contraseña=$_POST['contrasenia'];

session_destroy();

include('db.php');

$consulta="SELECT * FROM profesores WHERE email='$email' and contrasenia='$contraseña'";
$resultado=mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));

$fila=mysqli_fetch_array($resultado);

if(mysqli_num_rows($resultado) > 0){
    if (!session_id())
        session_start();
    $_SESSION['email']=$email;
    $_SESSION['esDocente']=true;
    header("location: listadoConsultas.php");
}else{
    echo '<div class="alert alert-danger" role="alert">
    Error en la autenticación
    </div>';
    include("loginDocente.php");
}

mysqli_free_result($resultado);
mysqli_close($conexion);

?>
