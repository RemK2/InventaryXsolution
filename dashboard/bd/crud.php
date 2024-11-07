<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$ref = (isset($_POST['ref'])) ? $_POST['ref'] : '';
$ubicacion = (isset($_POST['ubicacion'])) ? $_POST['ubicacion'] : '';
$fecha_emision = (isset($_POST['fecha_emision'])) ? $_POST['fecha_emision'] : '';
$fecha_modificacion = (isset($_POST['fecha_modificacion'])) ? $_POST['fecha_modificacion'] : '';
$fecha_salida = (isset($_POST['fecha_salida'])) ? $_POST['fecha_salida'] : '';
$precio_unidad = (isset($_POST['precio_unida
d'])) ? $_POST['precio_unidad'] : '';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$precio_lote = (isset($_POST['precio_lote'])) ? $_POST['precio_lote'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';  


switch($opcion){
    case 1: // Alta (Insertar)

       
       $consulta = "INSERT INTO personas (nombre, ref, ubicacion, fecha_emision, fecha_modificacion, fecha_salida, precio_unidad, cantidad, precio_lote) 
                     VALUES('$nombre', '$ref', '$ubicacion', '$fecha_emision', '$fecha_modificacion', '$fecha_salida', '$precio_unidad', '$cantidad', '$precio_lote')";			

        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        // Obtener el último registro insertado
        $consulta = "SELECT id, nombre, ref, ubicacion, fecha_emision, fecha_modificacion, fecha_salida, precio_unidad, cantidad, precio_lote 
                     FROM personas 
                     ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 2: // Modificación
        $consulta = "UPDATE personas 
                     SET nombre='$nombre', ref='$ref', ubicacion='$ubicacion', fecha_emision='$fecha_emision', 
                         fecha_modificacion='$fecha_modificacion', fecha_salida='$fecha_salida', 
                         precio_unidad='$precio_unidad', cantidad='$cantidad', precio_lote='$precio_lote' 
                     WHERE id='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        // Obtener el registro modificado
        $consulta = "SELECT id, nombre, ref, ubicacion, fecha_emision, fecha_modificacion, fecha_salida, precio_unidad, cantidad, precio_lote 
                     FROM personas 
                     WHERE id='$id'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        

    case 3: // Baja (Eliminar)
        $consulta = "DELETE FROM personas WHERE id='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}


print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
