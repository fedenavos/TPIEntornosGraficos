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
    $_SESSION['legajo']=$fila['legajo'];
    $_SESSION['nombre']=$fila['nombre'];
    $_SESSION['apellido']=$fila['apellido'];
    $_SESSION['esDocente']=true;
    //$_SESSION['esAlumno']=false; Agrego esto?
    header("location:../regConsulta.php");
}else{
    echo '<div class="alert alert-danger" role="alert">
    Error en la autenticación
    </div>';
    include("loginDocente.php");
}

mysqli_free_result($resultado);
mysqli_close($conexion);

?>
