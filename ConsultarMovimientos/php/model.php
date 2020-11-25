<?php

function conectar() 
{
    $conexion_bd = mysqli_connect("localhost","root","","gigis_db");
    
    if ($conexion_bd == NULL) 
    {
        die("No se pudo conectar a la base de datos");
    }
    
    $conexion_bd->set_charset("utf8");
    return $conexion_bd;
}

function desconectar($conexion_bd) 
{
    mysqli_close($conexion_bd);
}

//para las opciones 
function select() 
{
    $resultado = '<select id="IdAlmacen"  name="NombreAlmacen" class="browser-default">';
    $resultado .= '<option value="" disabled selected>Selecciona un Almacen</option>';
    $conexion_bd = conectar();
    
    $consulta = 'SELECT * FROM ALMACEN';
    $resultados_consulta = $conexion_bd->query($consulta);  
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_BOTH)) 
    {    
        $resultado .= '<option value="'.$row["IdAlmacen"].'">'.$row["NombreAlmacen"].'</option>';
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</select>';
    
    desconectar($conexion_bd);
    return $resultado;
}

function tabla_personal() 
{
    $consulta = 'SELECT PERSONAL.NombrePersonal, ALMACEN.NombreAlmacen, STOCK.IdProducto, STOCK.IdStock, MOVIMIENTO.Tipo, MOVIMIENTO.Cantidad, MOVIMIENTO.Destinatario, MOVIMIENTO.Fecha'; 
    $consulta .= ' FROM PERSONAL NATURAL JOIN MOVIMIENTO NATURAL JOIN ALMACEN NATURAL JOIN STOCK';
    $consulta .= ' ORDER BY MOVIMIENTO.Fecha DESC';
    
    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
 //   var_dump($consulta);
    $resultado = '<table id="personal" class="table table-hover table-condensed table-bordered">';
    $resultado .= '<thead class="bg-warning"><tr><th>Personal</th><th>Almacen</th><th>ID del Producto</th><th>ID en Stock</th><th>Tipo de Movimiento</th><th>Cantidad</th><th>Destinatario</th><th>Fecha</th></tr></thead>';
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) 
    { 
        $resultado .= '<tr>';
        $resultado .= '<td>'.$row["NombrePersonal"].'</td>';
        $resultado .= '<td>'.$row["NombreAlmacen"].'</td>';
        $resultado .= '<td>'.$row["IdProducto"].'</td>';
        $resultado .= '<td>'.$row["IdStock"].'</td>';
        $resultado .= '<td>'.$row["Tipo"].'</td>';
        $resultado .= '<td>'.$row["Cantidad"].'</td>';
        $resultado .= '<td>'.$row["Destinatario"].'</td>';
        $resultado .= '<td>'.$row["Fecha"].'</td>';
        $resultado .= '</tr>';
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</table><br>';
    
    desconectar($conexion_bd);
    return $resultado;
} 

function insertar_personal($rol, $fechai, $fechaf) 
{
     
    $conexion_bd = conectar();
    $consulta = 'SELECT PERSONAL.NombrePersonal, ALMACEN.NombreAlmacen, STOCK.IdProducto, STOCK.IdStock, MOVIMIENTO.Tipo, MOVIMIENTO.Cantidad, MOVIMIENTO.Destinatario, MOVIMIENTO.Fecha';
    $consulta .= ' FROM PERSONAL NATURAL JOIN MOVIMIENTO NATURAL JOIN ALMACEN NATURAL JOIN STOCK';
    $consulta .= ' WHERE MOVIMIENTO.IdAlmacen = '.$rol.' AND MOVIMIENTO.Fecha >= "'.$fechai.'" AND MOVIMIENTO.Fecha <= "'.$fechaf.'"';
    $consulta .= ' ORDER BY MOVIMIENTO.Fecha DESC';

    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
 //   var_dump($consulta);
    $resultado = '<table id="personal" class="table table-hover table-condensed table-bordered">';
    $resultado .= '<thead class="bg-warning"><tr><th>Personal</th><th>Almacen</th><th>ID del Producto</th><th>ID en Stock</th><th>Tipo de Movimiento</th><th>Cantidad</th><th>Destinatario</th><th>Fecha</th></tr></thead>';
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) 
    { 
        $resultado .= '<tr>';
        $resultado .= '<td>'.$row["NombrePersonal"].'</td>';
        $resultado .= '<td>'.$row["NombreAlmacen"].'</td>';
        $resultado .= '<td>'.$row["IdProducto"].'</td>';
        $resultado .= '<td>'.$row["IdStock"].'</td>';
        $resultado .= '<td>'.$row["Tipo"].'</td>';
        $resultado .= '<td>'.$row["Cantidad"].'</td>';
        $resultado .= '<td>'.$row["Destinatario"].'</td>';
        $resultado .= '<td>'.$row["Fecha"].'</td>';
        $resultado .= '</tr>';
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</table><br>';
    
    desconectar($conexion_bd);
    return $resultado;
}
//insertar_personal('Pikachu', '9678103', 'poke@hotmail.com', '11/11/20', '12/11/21');

function limpiar_entradas() {
    if (isset($_GET["id"])) {
        $_GET["id"] = htmlspecialchars($_GET["id"]);
    }

    if (isset($_GET["fechaIConsulta"])) {
        $_GET["fechaIConsulta"] = htmlspecialchars($_GET["fechaIConsulta"]);
    }

    if (isset( $_POST["fechaIConsulta"])) {
       $_POST["fechaIConsulta"] = htmlspecialchars($_POST["fechaIConsulta"]);
    }

    if (isset($_GET["fechaFConsulta"])) {
        $_GET["fechaFConsulta"] = htmlspecialchars($_GET["fechaFConsulta"]);
    }

    if (isset( $_POST["fechaFConsulta"])) {
       $_POST["fechaFConsulta"] = htmlspecialchars($_POST["fechaFConsulta"]);
    }   
}
//acusa(5,6);
//echo tabla_personal();
?>