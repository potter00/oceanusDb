$(document).ready(function () {
    tablaPersonas = $("#tablaPersonas").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"
        }],

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

    $("#btnNuevo").click(function () {
        $("#formPersonas").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Persona");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; //alta
    });

    var fila; //capturar la fila para editar o borrar el registro

    //botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        nombre = fila.find('td:eq(1)').text();
        pais = fila.find('td:eq(2)').text();
        edad = parseInt(fila.find('td:eq(3)').text());

        $("#nombre").val(nombre);
        $("#pais").val(pais);
        $("#edad").val(edad);
        opcion = 2; //editar

        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Persona");
        $("#modalCRUD").modal("show");

    });

    //botón BORRAR
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "bd/crud.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, id: id },
                success: function () {
                    tablaPersonas.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });

    /*$("#formPersonas").submit(function (e) {
        e.preventDefault();
        nombre = $.trim($("#nombre").val());
        curp = $.trim($("#curp").val());
        edad = $.trim($("#fechaNacimiento").val());
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: { nombre: nombre, fechaNacimiento: fechaNacimiento, edad: edad, id: id, opcion: opcion },
            success: function (data) {
                console.log(data);
                id = data[0].id;
                nombre = data[0].nombre;
                fechaNacimiento = data[0].fechaNacimiento;
                edad = data[0].edad;
                if (opcion == 1) { tablaPersonas.row.add([id, nombre, pais, edad]).draw(); }
                else { tablaPersonas.row(fila).data([id, nombre, pais, edad]).draw(); }
            }
        });
        //$("#modalCRUD").modal("hide");

    });*/
    $("#formPersonas").submit(function(e){
        e.preventDefault();    
        console.log("Actualizado");
        // Obtén los valores de los campos del formulario
        nombre = $.trim($("#nombre").val());
        fechaNacimiento = $.trim($("#fechaNacimiento").val());
        curp = $.trim($("#curp").val());
        rfc = $.trim($("#rfc").val());
        numeroFijo = $.trim($("#numeroFijo").val());
        numeroCelular = $.trim($("#numeroCelular").val());
        direccion = $.trim($("#direccion").val());
        numeroLicencia = $.trim($("#numeroLicencia").val());
        numeroPasaporte = $.trim($("#numeroPasaporte").val());
        fechaIngreso = $.trim($("#fechaIngreso").val());
        // Configura la solicitud Ajax
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {
                nombre: nombre,
                fechaNacimiento: fechaNacimiento,
                curp: curp,
                rfc: rfc,
                numeroFijo: numeroFijo,
                numeroCelular: numeroCelular,
                direccion: direccion,
                numeroLicencia: numeroLicencia,
                numeroPasaporte: numeroPasaporte,
                fechaIngreso: fechaIngreso,
                id: id,
                opcion: opcion
            },
            success: function(data){  
                console.log(data);
                id = data[0].id;            
                nombre = data[0].nombre;
                fechaNacimiento = data[0].fechaNacimiento;
                curp = data[0].curp;
                rfc = data[0].rfc;
                numeroFijo = data[0].numeroFijo;
                numeroCelular = data[0].numeroCelular;
                direccion = data[0].direccion;
                numeroLicencia = data[0].numeroLicencia;
                numeroPasaporte = data[0].numeroPasaporte;
                fechaIngreso = data[0].fechaIngreso;
    
                if(opcion == 1){
                    // Agrega una nueva fila a la tabla
                    tablaPersonas.row.add([id, nombre, fechaNacimiento, curp, rfc, numeroFijo, numeroCelular, direccion, numeroLicencia, numeroPasaporte, fechaIngreso]).draw();
                } else {
                    // Actualiza la fila existente
                    tablaPersonas.row(fila).data([id, nombre, fechaNacimiento, curp, rfc, numeroFijo, numeroCelular, direccion, numeroLicencia, numeroPasaporte, fechaIngreso]).draw();
                }            
            }        
        });
    
        // Oculta el modal después de enviar la solicitud
        $("#modalCRUD").modal("hide");    
    });
    

});