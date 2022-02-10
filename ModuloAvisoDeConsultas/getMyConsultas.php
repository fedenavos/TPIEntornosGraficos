<?php

include('db.php');

$legajoDoc = $_SESSION['legajo'];
$consulta="SELECT * FROM consultas WHERE estado = 1 and fecha_hora > curdate() and id_profesor = {$legajoDoc};";
$resultado=mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));

if ($resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $formatoInput = 'Y-m-d H:i:s';
        $fechaHora = DateTime::createFromFormat($formatoInput, $row["fecha_hora"]);
        $hora = $fechaHora -> format('H:i');
        $fecha = $fechaHora -> format('d-m-Y');
        echo "
            <tr>
                <th scope='row'></th>
                <td><button type='button' class='btn btn-outline-secondary'>Seleccionar</button></td>
                <td><p>Profesor: " . $row["id_profesor"]. "</p><p>Cupos Disponibles: " . $row["cupo"]. "</p><b>Día de consulta: " . $fecha . "</b></td>
                <td><b>" . $hora . "</b></td>
            </tr>
        ";
    }
}
else {
    echo "
        <tr>
            <th scope='row'></th>
            <td></td>
            <td><b>No hay proximas consultas</b></td>
            <td></td>
        </tr>
    ";
}

?>