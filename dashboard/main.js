$(document).ready(function () {
    tablaPersonas = $("#tablaPersonas").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button><button class='btn btn-secondary btnOpciones' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Opciones</button><div class='dropdown-menu' aria-labelledby='opcionesDropdown'><a class='dropdown-item btnSubirArchivo' href='#'>Subir Archivo</a><a class='dropdown-item btnDescargarArchivo' href='#'>Descargar Archivo</a></div></div></div>"
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

    //boton subir
    $(document).on("click", ".btnSubir", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        var estadoDocumento = {};
        //solicitamos los documentos del empleado
        var dataObject = {};
        dataObject['id'] = id;
        dataObject['opcion'] = 5; //solicitar documentos
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
                console.log(data);
                if (data.errores && data.errores.length > 0) {
                    // Mostrar los errores en el contenedor
                    console.log('Errores:', data.errores);

                } else {
                    // La operación fue exitosa, puedes realizar otras acciones aquí
                    estadoDocumento = data.data;
                    console.log(estadoDocumento.Licencia);
                }

            })
            .catch(error => {
                console.error('Error:', error);
            });
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Gestionar Documentos");
        $("#modalSubir").modal("show");

    });
    //botón OPCIONES
    //botón SUBIR ARCHIVO (dentro del menú de opciones)
    $(document).on("click", ".btnSubirArchivo", function (event) {
        event.stopPropagation(); // Evita que el evento de clic se propague a elementos superiores
        // Aquí puedes agregar la lógica para subir un archivo
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        nombre = fila.find('td:eq(1)').text();
        recargarTablaDocumentos('tablaDocumentos');
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Gestionar Documentos");
        $("#modalSubir").modal("show");

    });

    //botón DESCARGAR ARCHIVO (dentro del menú de opciones)
    $(document).on("click", ".btnDescargarArchivo", function (event) {
        event.stopPropagation(); // Evita que el evento de clic se propague a elementos superiores
        // Aquí puedes agregar la lógica para subir un archivo

        try {
            fila = $(this).closest("tr");
            id = parseInt(fila.find('td:eq(0)').text());
            nombre = fila.find('td:eq(1)').text();
            //recargarTablaDocumentos('tablaDocumentos');
            $(".modal-header").css("background-color", "#4e73df");
            $(".modal-header").css("color", "white");
            $(".modal-title").text("Gestionar Documentos");
            $("#modalBajar").modal("show");
        } catch (error) {
            
            console.log("no se puede abrir el modal");
            console.log(error);
            alert("error al abrir: "+error);
            
        }

    });
    //botón SUBIR documento
    $(document).on("click", ".btnSubirDocumento", function () {
        //tomamos la lista de los documentos que se an seleccionado
        var estadoDocumento = obtenerArrayDeColumna('tablaDocumentos', 1);
        var documentos = ["Credencial", "Licencia", "Pasaporte", "CV", "Curp", "Inss", "ConstanciaSat"];
        //verificamos si se a seleccionado un archivo
        for (var i = 0; i < estadoDocumento.length; i++) {
            inputId = "fileInput" + documentos[i];
            if (verificarArchivo(inputId)) {
                if (subirArchivo(id, documentos[i], nombre, inputId)) {

                }

            } else {
                console.log("no hay archivo seleccionado en " + documentos[i]);
            }
        }

        $("#modalSubir").modal("hide");

    });
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

    //funcion para subir archivo al servidor
    function subirArchivo(id, tipoDocumento, nombre, idFileInput) {
        const archivoInput = document.getElementById(idFileInput);
        const archivo = archivoInput.files[0];
        //const id = 15; // Reemplaza con la ID deseada
        var resultados = {};
        const formData = new FormData();
        formData.append('archivo', archivo);
        formData.append('id', id);
        formData.append('tipoDocumento', tipoDocumento);
        formData.append('nombre', nombre);

        fetch('../upload.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log('Respuesta del servidor:', data);
                resultados = true;
                console.log(data.ruta);
                subirRutaDocumento(id, tipoDocumento, data.ruta);
            })
            .catch(error => {
                console.error('Error:', error);
                resultados = false;
            });
        return resultados;
    }

    //funcion para verificar si se a seleccionado un archivo
    function verificarArchivo(inputId) {
        // Obtener el elemento input de tipo file por ID
        var fileInput = document.getElementById(inputId);

        // Verificar si se ha seleccionado al menos un archivo
        var archivoSeleccionado = fileInput.files.length > 0;



        return archivoSeleccionado;
    }

    //funcion para obtener el valor de una columna
    function obtenerArrayDeColumna(tablaId, columnaIndex) {
        var arrayDeColumna = [];

        // Obtener la referencia de la tabla
        var tabla = document.getElementById(tablaId);

        // Iterar sobre las filas de la tabla
        for (var i = 1; i < tabla.rows.length; i++) {
            // Obtener el valor de la celda en la columna especificada
            var valorCelda = tabla.rows[i].cells[columnaIndex].innerText;

            // Agregar el valor al array
            arrayDeColumna.push(valorCelda);
        }

        return arrayDeColumna;
    }

    //funcion para subir la ruta de guardado del documento
    function subirRutaDocumento(id, tipoDocumento, ruta) {
        var dataObject = {};
        dataObject['id'] = id;
        dataObject['tipoDocumento'] = tipoDocumento;
        dataObject['ruta'] = ruta;
        dataObject['opcion'] = 6; //subir ruta
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
                if (data.errores && data.errores.length > 0) {
                    // Mostrar los errores en el contenedor
                    console.log('Errores:', data.errores);

                } else {
                    // La operación fue exitosa, puedes realizar otras acciones aquí
                    console.log(data);

                }

            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    //Funcion recargar la tabla de documentos
    function recargarTablaDocumentos(idtabla) {
        var estadoDocumento = {};
        //solicitamos los documentos del empleado
        var dataObject = {};
        dataObject['id'] = id;
        dataObject['opcion'] = 5; //solicitar documentos
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
                //datos optenidos si no hay errores se mostrara el estado de los documentos
                //console.log(data);
                if (data.errores && data.errores.length > 0) {
                    // Mostrar los errores en el contenedor
                    console.log('Errores:', data.errores);

                } else {
                    // La operación fue exitosa, puedes realizar otras acciones aquí
                    estadoDocumento = data.data;
                    console.log(estadoDocumento[0].Licencia);
                    var fila = {};
                    var celda = {};
                    //verificamos si todos los documentos estan subidos

                    //Credencial
                    if (estadoDocumento[0].Credencial == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="credencial"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                    } else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="credencial"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                    }

                    //Licencia
                    if (estadoDocumento[0].Licencia == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="licencia"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                    } else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="licencia"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                    }

                    //pasaporte
                    if (estadoDocumento[0].Pasaporte == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="pasaporte"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="pasaporte"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                    }

                    //cv
                    if (estadoDocumento[0].CV == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="cv"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="cv"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                    }

                    //curp
                    if (estadoDocumento[0].Curp == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="curp"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="curp"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                    }
                    //inss
                    if (estadoDocumento[0].Inss == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="nss"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="nss"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                    }
                    //Sat
                    if (estadoDocumento[0].ConstanciaSat == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="sat"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="sat"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                    }

                }

            })
            .catch(error => {
                console.error('Error:', error);
            });
    }






});