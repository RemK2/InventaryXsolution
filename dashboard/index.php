<!-- Parte superior -->
<?php require_once "vistas/parte_superior.php"?>

<!-- INICIO del cont principal -->
<div class="container">
    <h1>Inventari X Solution</h1>
    
    <?php
    include_once 'bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $consulta = "SELECT id, nombre, ref, ubicacion, fecha_emision, fecha_modificacion, fecha_salida, precio_unidad, cantidad, precio_lote FROM personas";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
                <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">        
                    <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>NOMBRE</th>
                                <th>Ref</th>
                                <th>UBICACION</th>
                                <th>FECHA DE EMISION</th>
                                <th>FECHA DE MODIFICACION</th>
                                <th>FECHA DE SALIDA</th> 
                                <th>PRECIO UNIDAD</th>                
                                <th>CANTIDAD</th> 
                                <th>PRECIO LOTE</th>  
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id']; ?></td>
                                <td><?php echo $dat['nombre']; ?></td>
                                <td><?php echo $dat['ref']; ?></td>
                                <td><?php echo $dat['ubicacion']; ?></td>
                                <td><?php echo $dat['fecha_emision']; ?></td>
                                <td><?php echo $dat['fecha_modificacion']; ?></td>
                                <td><?php echo $dat['fecha_salida']; ?></td>
                                <td><?php echo $dat['precio_unidad']; ?></td>
                                <td><?php echo $dat['cantidad']; ?></td>
                                <td><?php echo $dat['precio_lote']; ?></td>
                                <td></td>
                            </tr>
                            <?php
                            }
                            ?>                                
                        </tbody>        
                    </table>                    
                </div>
            </div>
        </div>  
    </div>    

    <!-- Modal para CRUD -->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formPersonas">    
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre" class="col-form-label">NOMBRE:</label>
                            <input type="text" class="form-control" id="nombre">
                        </div>
                        <div class="form-group">
                            <label for="ref" class="col-form-label">REF:</label>
                            <input type="text" class="form-control" id="ref">
                        </div>
                        <div class="form-group">
                            <label for="ubicacion" class="col-form-label">UBICACION:</label>
                            <input type="text" class="form-control" id="ubicacion">
                        </div>
                        <div class="form-group">
                            <label for="fecha_emision" class="col-form-label">FECHA DE EMISION:</label>
                            <input type="date" class="form-control" id="fecha_emision">
                        </div>
                        <div class="form-group">
                            <label for="fecha_modificacion" class="col-form-label">FECHA DE MODIFICACION:</label>
                            <input type="date" class="form-control" id="fecha_modificacion">
                        </div>
                        <div class="form-group">
                            <label for="fecha_salida" class="col-form-label">FECHA DE SALIDA:</label>
                            <input type="date" class="form-control" id="fecha_salida">
                        </div>
                        <div class="form-group">
                            <label for="precio_unidad" class="col-form-label">PRECIO UNIDAD:</label>
                            <input type="text" class="form-control" id="precio_unidad">
                        </div>
                        <div class="form-group">
                            <label for="cantidad" class="col-form-label">CANTIDAD:</label>
                            <input type="number" class="form-control" id="cantidad">
                        </div>
                        <div class="form-group">
                            <label for="precio_lote" class="col-form-label">PRECIO LOTE:</label>
                            <input type="text" class="form-control" id="precio_lote">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>  
</div>

<!-- FIN del cont principal -->
<?php require_once "vistas/parte_inferior.php"?>