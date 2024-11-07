$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
        "columnDefs":[{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
        }],
        "columns": [
            { "data": "id" },
            { "data": "nombre" },
            { "data": "ref" },
            { "data": "ubicacion" },
            { "data": "fecha_emision" },
            { "data": "fecha_modificacion" },
            { "data": "fecha_salida" },
            { "data": "precio_unidad" },
            { "data": "cantidad" },
            { "data": "precio_lote" },
            { "data": null }  // Acciones
        ],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }
    });
    
    $("#btnNuevo").click(function(){
        $("#formPersonas").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Producto");            
        $("#modalCRUD").modal("show");        
        id = null;
        opcion = 1; // alta
    });    
    
    var fila; // capturar la fila para editar o borrar el registro
    
    // botón EDITAR    
    $(document).on("click", ".btnEditar", function(){
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        nombre = fila.find('td:eq(1)').text();
        ref = fila.find('td:eq(2)').text();
        ubicacion = fila.find('td:eq(3)').text();
        fecha_emision = fila.find('td:eq(4)').text();
        fecha_modificacion = fila.find('td:eq(5)').text();
        fecha_salida = fila.find('td:eq(6)').text();
        precio_unidad = fila.find('td:eq(7)').text();
        cantidad = parseInt(fila.find('td:eq(8)').text());
        precio_lote = fila.find('td:eq(9)').text();
    
        $("#nombre").val(nombre);
        $("#ref").val(ref);
        $("#ubicacion").val(ubicacion);
        $("#fecha_emision").val(fecha_emision);
        $("#fecha_modificacion").val(fecha_modificacion);
        $("#fecha_salida").val(fecha_salida);
        $("#precio_unidad").val(precio_unidad);
        $("#cantidad").val(cantidad);
        $("#precio_lote").val(precio_lote);
        opcion = 2; // editar
    
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Producto");            
        $("#modalCRUD").modal("show");  
    });
    
    // botón BORRAR
    $(document).on("click", ".btnBorrar", function(){    
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3; // borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "bd/crud.php",
                type: "POST",
                dataType: "json",
                data: {opcion: opcion, id: id},
                success: function(){
                    tablaPersonas.row(fila.parents('tr')).remove().draw();
                }
            });
        }   
    });
    
    // Envío del formulario
    $("#formPersonas").submit(function(e){
        e.preventDefault();    
        nombre = $.trim($("#nombre").val());
        ref = $.trim($("#ref").val());
        ubicacion = $.trim($("#ubicacion").val());
        fecha_emision = $.trim($("#fecha_emision").val());
        fecha_modificacion = $.trim($("#fecha_modificacion").val());
        fecha_salida = $.trim($("#fecha_salida").val());
        precio_unidad = $.trim($("#precio_unidad").val());
        cantidad = $.trim($("#cantidad").val());
        precio_lote = $.trim($("#precio_lote").val());

        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {nombre: nombre, ref: ref, ubicacion: ubicacion, fecha_emision: fecha_emision, fecha_modificacion: fecha_modificacion, fecha_salida: fecha_salida, precio_unidad: precio_unidad, cantidad: cantidad, precio_lote: precio_lote, id: id, opcion: opcion},
            success: function(data){  
                console.log(data);
                id = data[0].id;            
                nombre = data[0].nombre;
                ref = data[0].ref;
                ubicacion = data[0].ubicacion;
                fecha_emision = data[0].fecha_emision;
                fecha_modificacion = data[0].fecha_modificacion;
                fecha_salida = data[0].fecha_salida;
                precio_unidad = data[0].precio_unidad;
                cantidad = data[0].cantidad;
                precio_lote = data[0].precio_lote;

                if(opcion == 1){ 
                    // Agregar nuevo producto
                    tablaPersonas.row.add([
                        id,              
                        nombre,          
                        ref,             
                        ubicacion,       
                        fecha_emision,   
                        fecha_modificacion,
                        fecha_salida,    
                        precio_unidad,   
                        cantidad,        
                        precio_lote,     
                        "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  // Acciones
                    ]).draw();
                } else {
                    // Modificar producto existente
                    tablaPersonas.row(fila).data([
                        id,
                        nombre,
                        ref,
                        ubicacion,
                        fecha_emision,
                        fecha_modificacion,
                        fecha_salida,
                        precio_unidad,
                        cantidad,
                        precio_lote,
                        "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  // Acciones
                    ]).draw();
                }
            }        
        });
        $("#modalCRUD").modal("hide");    
    });
});
