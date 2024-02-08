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
        opcion = 3; //llamar datos relacionados a la persona
        var dataObject = {};
        console.error(id);
        dataObject['id'] = id;
        dataObject['opcion'] = 3;
        dataJSON = JSON.stringify(dataObject);
        fetch('bd/CopiaCrud.php', {
            method: 'POST',
            body: dataJSON,
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                //datos optenidos
                
                if (data.errores && data.errores.length > 0) {
                    // Mostrar los errores en el contenedor
                    console.log('Errores:', data.errores);
                    
                } else {
                    // La operación fue exitosa, puedes realizar otras acciones aquí
                    //datos personales
                    $("#nombre").val(data.data.personas[0].Nombre);
                    $("#fechaNacimiento").val(data.data.personas[0].FechaNacimiento);
                    $("#curp").val(data.data.personas[0].Curp);
                    $("#rfc").val(data.data.personas[0].Rfc);
                    $("#numeroFijo").val(data.data.personas[0].NumeroFijo);
                    $("#numeroCelular").val(data.data.personas[0].NumeroCelular);
                    $("#direccion").val(data.data.personas[0].Direccion);
                    $("#numeroLicencia").val(data.data.personas[0].NumeroLicencia);
                    $("#numeroPasaporte").val(data.data.personas[0].NumeroPasaporte);
                    $("#fechaIngreso").val(data.data.personas[0].FechaIngreso);
                    
                    //datos medicos
                    $("#alergias").val(data.data.medicos[0].Alergias);
                    $("#enfermedadesCronicas").val(data.data.medicos[0].EnfermedadesCronicas);
                    $("#lesiones").val(data.data.medicos[0].Lesiones);
                    $("#alergiasMedicamentos").val(data.data.medicos[0].AlergiasMedicamentos);
                    $("#numeroSeguro").val(data.data.medicos[0].NumeroSeguro);
                    $("#numeroEmergencia").val(data.data.medicos[0].NumeroEmergencia);
                    $("#tipoSangre").val(data.data.medicos[0].TipoSangre);

                    //datos academicos
                    $("#cedula").val(data.data.academicos[0].Cedula);
                    $("#carrera").val(data.data.academicos[0].Carrera);
                    $("#expLaboral").val(data.data.academicos[0].ExpLaboral);
                    $("#certificaciones").val(data.data.academicos[0].Certificaciones);
                    $("#gradoEstudios").val(data.data.academicos[0].GradoEstudios);
                }
                
            })
            .catch(error => {
                console.error('Error:', error);
            });


        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar");
        opcion = 4; //editar
        $("#modalCRUD").modal("show");

    });

    //botón BORRAR
    $(document).on("click", ".btnBorrar", function () {
        //declaramos las variables para el objeto JSON
        var dataObject = {};
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());

        opcion = 2 //borrar
       
        
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        dataObject['id'] = id;
        dataObject['opcion'] = opcion;
        dataJSON = JSON.stringify(dataObject);
        if (respuesta) {
            fetch('bd/CopiaCrud.php', {
                method: 'POST',
                body: dataJSON,
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.errores && data.errores.length > 0) {
                        // Mostrar los errores en el contenedor
                        console.log('Errores:', data.errores);
                        
                    } else {
                        // La operación fue exitosa, puedes realizar otras acciones aquí
                        location.reload();
                    }
                    
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
        
    });

    
});