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
    
    
    $("#formPersonas").submit(function (e) {
        e.preventDefault();
        console.log("Enviando datos");
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

        //datos medicos
        alergias = $.trim($("#alergias").val());
        enfermedadesCronicas = $.trim($("#enfermedadesCronicas").val());
        lesiones = $.trim($("#lesiones").val());
        alergiasMedicamentos = $.trim($("#alergiasMedicamentos").val());
        numeroSeguro = $.trim($("#numeroSeguro").val());
        numeroEmergencia = $.trim($("#numeroEmergencia").val());
        tipoSangre = $.trim($("#tipoSangre").val());

        //datos academicos
        cedula = $.trim($("#cedula").val());
        carrera = $.trim($("#carrera").val());
        expLaboral = $.trim($("#expLaboral").val());
        certificaciones = $.trim($("#certificaciones").val());
        gradoEstudio = $.trim($("#gradoEstudio").val());

        //opciones
        opcion = $.trim($("#opcion").val());
        id = $.trim($("#id").val());
        // Configura la solicitud Ajax
        
        console.log(nombre);
        
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: formData,
            success: function (data) {
                console.log("dentro del log");
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
                alergias = data[0].alergias;
                enfermedadesCronicas = data[0].enfermedadesCronicas;
                lesiones = data[0].lesiones;
                alergiasMedicamentos = data[0].alergiasMedicamentos;
                numeroSeguro = data[0].numeroSeguro;
                numeroEmergencia = data[0].numeroEmergencia;
                tipoSangre = data[0].tipoSangre;
                cedula = data[0].cedula;
                carrera = data[0].carrera;
                expLaboral = data[0].expLaboral;
                certificaciones = data[0].certificaciones;
                gradoEstudio = data[0].gradoEstudio;


                if (opcion == 1) {
                    // Agrega una nueva fila a la tabla
                    console.log("Agregando nueva fila");
                    tablaPersonas.row.add([id, nombre, fechaNacimiento]).draw();
                } else {
                    // Actualiza la fila existente
                    console.log("Actualizando fila");
                    tablaPersonas.row(fila).data([id, nombre, fechaNacimiento]).draw();
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Handle any errors here
                console.error("Error: " + textStatus, errorThrown);
            }
        });

        // Oculta el modal después de enviar la solicitud
        //$("#modalCRUD").modal("hide");


    });



});