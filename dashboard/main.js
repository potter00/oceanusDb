$(document).ready(function () {
    //actualizamos la tabla

    var tablaPersonas = $("#tablaPersonas").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": true,
        "buttons": [
            {
                extend: 'copy',
                className: 'btn btn-primary',
                text: 'Copiar'
            },
            {
                extend: 'excel',
                className: 'btn btn-primary',
                text: 'Exportar a Excel'
            },
            {
                extend: 'pdf',
                className: 'btn btn-primary',
                text: 'Pdf'
            },
            {
                extend: 'print',
                className: 'btn btn-primary',
                text: 'imprimir'
            },
            {
                extend: 'colvis',
                className: 'btn btn-primary',
                text: 'Filtrar columnas'
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
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad",
                "collection": "Colección",
                "colvisRestore": "Restaurar visibilidad",
                "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                "copySuccess": {
                    "1": "Copiada 1 fila al portapapeles",
                    "_": "Copiadas %ds fila al portapapeles"
                },
                "copyTitle": "Copiar al portapapeles",
                "csv": "CSV",
                "excel": "Excel",
                "pageLength": {
                    "-1": "Mostrar todas las filas",
                    "_": "Mostrar %d filas"
                },
                "pdf": "PDF",
                "print": "Imprimir",
                "renameState": "Cambiar nombre",
                "updateState": "Actualizar",
                "createState": "Crear Estado",
                "removeAllStates": "Remover Estados",
                "removeState": "Remover",
                "savedStates": "Estados Guardados",
                "stateRestore": "Estado %d"
            }
        }


    });

    //inicializacion de la pagina
    //inicializamos la tabla
    actualizarTablaPersonas();
    tablaPersonas.buttons().container().appendTo('#tablaPersonas_wrapper .col-md-6:eq(0)');

    tablaPersonas.column(2).visible(false);
    tablaPersonas.column(4).visible(false);
    tablaPersonas.column(5).visible(false);

    tablaPersonas.column(7).visible(false);
    tablaPersonas.column(8).visible(false);
    tablaPersonas.column(9).visible(false);
    tablaPersonas.column(10).visible(false);
    tablaPersonas.column(11).visible(false);

    tablaPersonas.column(13).visible(false);
    tablaPersonas.column(14).visible(false);
    tablaPersonas.column(15).visible(false);

    //variables globales
    var documentos = ["Credencial", "Licencia", "Pasaporte", "CV", "Curp", "Inss", "ConstanciaSat", "Foto", "ActaNacimiento", "EstadoCuentaBanco", "AltaSeguroSocial", "CedulaProfecional", "CopiaContrato", "ComprobanteDomicilio"];
    $("#btnNuevo").click(function () {
        resetForm();
        $("#formPersonas").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Persona");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; //alta
    });

    var fila; //capturar la fila para editar o borrar el registro
    //addEvents();
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
        fetch('../dashboard/bd/copiaCrud.php', {
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
        mostrarFileInputs();
        ocultarBotones();
        resetFileInputs();
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

            $(".modal-header").css("background-color", "#4e73df");
            $(".modal-header").css("color", "white");
            $(".modal-title").text("Descargar Documentos");
            ocultarFileInputs();
            mostrarBotones();
            //tomamos la lista de los documentos que se an seleccionado
            $("#modalSubir").modal("show");

            recargarTablaDocumentos('tablaDocumentos');

        } catch (error) {

            console.log("no se puede abrir el modal");
            console.log(error);
            alert("error al abrir: " + error);

        }

    });
    //Boton descargar documento(dentro del modal)
    $(document).on("click", ".btnDescargarDocumento", function () {
        fila = $(this).closest("tr");
        tipoDocumento = fila.find('td:eq(0)').text();
        if (tipoDocumento == "NSS") {
            tipoDocumento = "Inss";

        }
        if (tipoDocumento == "Constancia SAT") {
            tipoDocumento = "ConstanciaSat";
        }
        if (tipoDocumento == "Acta") {
            tipoDocumento = "ActaNacimiento";
        }
        if (tipoDocumento == "Estado cuenta banco") {
            tipoDocumento = "EstadoCuentaBanco";

        }
        if (tipoDocumento == "Alta Seguro") {
            tipoDocumento = "AltaSeguroSocial";
        }
        if (tipoDocumento == "Cedula") {
            tipoDocumento = "CedulaProfecional";
        }
        if (tipoDocumento == "Contrato") {
            tipoDocumento = "CopiaContrato";
        }
        if (tipoDocumento == "Comprobante domicilio") {
            tipoDocumento = "ComprobanteDomicilio";

        }
        pedirRutaDocumento(id, tipoDocumento)
            .then(data => {

                for (const key in data.data[0]) {
                    if (Object.hasOwnProperty.call(data.data[0], key)) {
                        const element = data.data[0][key];

                        descargarDocumento(element, key, nombre);

                    }
                }

            });


    });
    //botón SUBIR documento
    $(document).on("click", ".btnSubirDocumento", function () {
        //tomamos la lista de los documentos que se an seleccionado
        var estadoDocumento = obtenerArrayDeColumna('tablaDocumentos', 1);

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

        var id;
        var urlActual = window.location.href;
        var nombreArchivo = urlActual.split('/').pop(); // Obtiene el último segmento de la URL
        var nombreArchivo = nombreArchivo.split('?')[0]; // Remueve cualquier query string
        console.log('Nombre del archivo actual:', nombreArchivo);
        if (nombreArchivo == "detalles_usuario.php") {
            console.log("estamos en detalles");
            id = parseInt(urlActual.split('?').pop().split('=').pop());
        } else {
            fila = $(this).closest("tr");
            id = parseInt(fila.find('td:eq(0)').text());
        }


        opcion = 3; //llamar datos relacionados a la persona
        var dataObject = {};

        dataObject['id'] = id;
        dataObject['opcion'] = 3;
        dataJSON = JSON.stringify(dataObject);
        fetch('../dashboard/bd/copiaCrud.php', {
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
                    $("#id_usuario").val(data.data.personas[0].Id);
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
                    document.getElementById("tipoContrato").value = data.data.personas[0].TipoContrato;
                    document.getElementById("estado").value = data.data.personas[0].Estado;
                    $("#fechaInicioContrato").val(data.data.personas[0].InicioContrato);
                    $("#fechaFinContrato").val(data.data.personas[0].FinContrato);
                    $("#correo").val(data.data.personas[0].Correo);

                    console.log(data.data.personas[0].FechaInicioContrato);
                    console.log(data.data.personas[0].FechaFinContrato);

                    //datos medicos
                    $("#alergias").val(data.data.medicos[0].Alergias);
                    $("#enfermedadesCronicas").val(data.data.medicos[0].EnfermedadesCronicas);
                    $("#lesiones").val(data.data.medicos[0].Lesiones);
                    $("#alergiasMedicamentos").val(data.data.medicos[0].AlergiasMedicamentos);
                    $("#numeroSeguro").val(data.data.medicos[0].NumeroSeguro);
                    $("#numeroEmergencia").val(data.data.medicos[0].NumeroEmergencia);
                    $("#tipoSangre").val(data.data.medicos[0].TipoSangre);
                    $("#nombreEmergencia").val(data.data.medicos[0].NombreEmergencia);
                    document.getElementById("genero").value = data.data.medicos[0].Genero;
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

        var id;
        var urlActual = window.location.href;
        var nombreArchivo = urlActual.split('/').pop(); // Obtiene el último segmento de la URL
        var nombreArchivo = nombreArchivo.split('?')[0]; // Remueve cualquier query string

        if (nombreArchivo == "detalles_usuario.php") {
            console.log("estamos en detalles");
            id = parseInt(urlActual.split('?').pop().split('=').pop());
        } else {
            fila = $(this);
            id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        }




        //declaramos las variables para el objeto JSON
        var dataObject = {};


        opcion = 2 //borrar


        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        dataObject['id'] = id;
        dataObject['opcion'] = opcion;
        dataJSON = JSON.stringify(dataObject);
        if (respuesta) {
            fetch('../dashboard/bd/copiaCrud.php', {
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
                        borrarCarpeta(id);

                        //los devolvemos al index
                        window.location.href = "./index.php";
                    }

                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

    });

    //botón GENERAR REPORTE
    $(document).on("click", ".btnGenerarReporte", function () {

        var id;
        var urlActual = window.location.href;
        var nombreArchivo = urlActual.split('/').pop(); // Obtiene el último segmento de la URL
        var nombreArchivo = nombreArchivo.split('?')[0]; // Remueve cualquier query string

        if (nombreArchivo == "detalles_usuario.php") {

            id = parseInt(urlActual.split('?').pop().split('=').pop());
        } else {
            fila = $(this).closest("tr");
            id = parseInt(fila.find('td:eq(0)').text());

        }
        //Abrimos una nueva pestaña a Reporte.php con un GET el cual es el id
        window.open("./vistas/plantilla_datos_completos.php?id=" + id, '_blank');


    });

    //boton detalles
    $(document).on("click", ".btnDetalles", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());

        //redireccionamos a la pagina de detalles dando la id de la persona con get
        window.location.href = "./detalles_usuario.php?id=" + id;


    });

    //boton generar credencial
    $(document).on("click", ".btnGenerarCredencial", function () {

        var id;
        var urlActual = window.location.href;
        var nombreArchivo = urlActual.split('/').pop(); // Obtiene el último segmento de la URL
        var nombreArchivo = nombreArchivo.split('?')[0]; // Remueve cualquier query string

        if (nombreArchivo == "detalles_usuario.php") {

            id = parseInt(urlActual.split('?').pop().split('=').pop());
        } else {
            fila = $(this).closest("tr");
            id = parseInt(fila.find('td:eq(0)').text());


        }
        //abrimos una nueva pestaña a Credencial.php con un GET el cual es el id
        window.open("./Credencial.php?id=" + id, '_blank');



    });

    //boton actualizar tabla
    $(document).on("click", "#btnActualizar", function () {
        actualizarTablaPersonas();

    });

    //funcion para subir archivo al servidor
    function subirArchivo(id, tipoDocumento, nombre, idFileInput) {
        const archivoInput = document.getElementById(idFileInput);
        const archivo = archivoInput.files[0];
        //const id = 15; // Reemplaza con la ID deseada
        var opcion = 1; //subir
        var resultados = {};
        const formData = new FormData();
        formData.append('archivo', archivo);
        formData.append('id', id);
        formData.append('tipoDocumento', tipoDocumento);
        formData.append('nombre', nombre);
        formData.append('opcion', opcion);

        fetch('../upload.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log('Respuesta del servidor:', data);
                resultados = true;
                console.log(data.ruta);
                subirRutaDocumento(data.id, tipoDocumento, data.ruta);
            })
            .catch(error => {
                console.error('Error:', error);
                resultados = false;
            });
        return resultados;
    }

    //funcion para borrar carpeta del servidor
    function borrarCarpeta(id) {

        const formData = new FormData();
        formData.append('id', id);
        formData.append('opcion', 2);
        fetch('../upload.php', {
            method: 'POST',
            body: formData

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
    function subirRutaDocumento(idEmpleado, tipoDocumento, ruta) {
        var dataObject = {};

        dataObject['id'] = idEmpleado;
        dataObject['tipoDocumento'] = tipoDocumento;
        dataObject['ruta'] = ruta;
        dataObject['opcion'] = 6; //subir ruta
        dataJSON = JSON.stringify(dataObject);
        fetch('../dashboard/bd/copiaCrud.php', {
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

        fetch('../dashboard/bd/copiaCrud.php', {
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
                    var boton = {};
                    boton.disabled = true;
                    //verificamos si todos los documentos estan subidos




                    //Credencial
                    if (estadoDocumento[0].Credencial == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="credencial"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                        boton = document.getElementById('btnDescargarCredencial');
                        boton.disabled = true;
                    } else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="credencial"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                        boton = document.getElementById('btnDescargarCredencial');
                        boton.disabled = false;
                    }

                    //Licencia
                    if (estadoDocumento[0].Licencia == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="licencia"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                        boton = document.getElementById('btnDescargarLicencia');
                        boton.disabled = true;
                    } else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="licencia"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                        boton = document.getElementById('btnDescargarLicencia');
                        boton.disabled = false;
                    }

                    //pasaporte
                    if (estadoDocumento[0].Pasaporte == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="pasaporte"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                        boton = document.getElementById('btnDescargarPasaporte');
                        boton.disabled = true;
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="pasaporte"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                        boton = document.getElementById('btnDescargarPasaporte');
                        boton.disabled = false;
                    }

                    //cv
                    if (estadoDocumento[0].CV == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="cv"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                        boton = document.getElementById('btnDescargarCV');
                        boton.disabled = true;
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="cv"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                        boton = document.getElementById('btnDescargarCV');
                        boton.disabled = false;
                    }

                    //curp
                    if (estadoDocumento[0].Curp == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="curp"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                        boton = document.getElementById('btnDescargarCurp');
                        boton.disabled = true;
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="curp"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                        boton = document.getElementById('btnDescargarCurp');
                        boton.disabled = false;
                    }
                    //inss
                    if (estadoDocumento[0].Inss == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="nss"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                        boton = document.getElementById('btnDescargarInss');
                        boton.disabled = true;
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="nss"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                        boton = document.getElementById('btnDescargarInss');
                        boton.disabled = false;
                    }
                    //Sat
                    if (estadoDocumento[0].ConstanciaSat == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="sat"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                        boton = document.getElementById('btnDescargarConstanciaSat');
                        boton.disabled = true;
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="sat"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                        boton = document.getElementById('btnDescargarConstanciaSat');
                        boton.disabled = false;
                    }
                    //foto
                    if (estadoDocumento[0].Foto == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="foto"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                        boton = document.getElementById('btnDescargarFoto');
                        boton.disabled = true;
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="foto"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                        boton = document.getElementById('btnDescargarFoto');
                        boton.disabled = false;
                    }
                    //Acta
                    if (estadoDocumento[0].ActaNacimiento == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="Acta"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                        boton = document.getElementById('btnDescargarActa');
                        boton.disabled = true;
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="Acta"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                        boton = document.getElementById('btnDescargarActa');
                        boton.disabled = false;
                    }
                    //EstadoBanco
                    if (estadoDocumento[0].EstadoCuentaBanco == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="EstadoBanco"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                        boton = document.getElementById('btnDescargarEstadoBanco');
                        boton.disabled = true;
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="EstadoBanco"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                        boton = document.getElementById('btnDescargarEstadoBanco');
                        boton.disabled = false;
                    }

                    //AltaSeguro
                    if (estadoDocumento[0].AltaSeguroSocial == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="AltaSeguro"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                        boton = document.getElementById('btnDescargarAltaSeguro');
                        boton.disabled = true;
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="AltaSeguro"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                        boton = document.getElementById('btnDescargarAltaSeguro');
                        boton.disabled = false;
                    }
                    //Cedula
                    if (estadoDocumento[0].CedulaProfecional == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="Cedula"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                        boton = document.getElementById('btnDescargarCedula');
                        boton.disabled = true;
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="Cedula"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                        boton = document.getElementById('btnDescargarCedula');
                        boton.disabled = false;
                    }
                    //Contrato
                    if (estadoDocumento[0].CopiaContrato == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="Contrato"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                        boton = document.getElementById('btnDescargarContrato');
                        boton.disabled = true;
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="Contrato"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                        boton = document.getElementById('btnDescargarContrato');
                        boton.disabled = false;
                    }
                    //ComprobanteDomicilio
                    if (estadoDocumento[0].ComprobanteDomicilio == "sin cambio") {
                        // Obtén la referencia a la fila que deseas cambiar
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="ComprobanteDomicilio"]');
                        celda = fila.cells[1];
                        celda.textContent = 'sin subir';
                        boton = document.getElementById('btnDescargarComprobanteDomicilio');
                        boton.disabled = true;
                    }
                    else {
                        fila = document.getElementById(idtabla).querySelector('tbody tr[data-id="ComprobanteDomicilio"]');
                        celda = fila.cells[1];
                        celda.textContent = 'subido';
                        boton = document.getElementById('btnDescargarComprobanteDomicilio');
                        boton.disabled = false;
                    }

                }

            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    //oculta los fileinputs
    function ocultarFileInputs() {
        var fileInputs = document.getElementsByClassName('fileInputDocumentos');
        for (var i = 0; i < fileInputs.length; i++) {
            fileInputs[i].style.display = 'none';
        }
        document.getElementById('btnSubirDocumentosTabla').style.display = 'none';
    }
    //muestra los fileinputs
    function mostrarFileInputs() {
        var fileInputs = document.getElementsByClassName('fileInputDocumentos');
        for (var i = 0; i < fileInputs.length; i++) {
            fileInputs[i].style.display = 'inline-block';
        }
        document.getElementById('btnSubirDocumentosTabla').style.display = 'inline-block';
    }
    //oculta los botones de documentos
    function ocultarBotones() {
        var botones = document.getElementsByClassName('btnDescargarDocumento');
        for (var i = 0; i < botones.length; i++) {
            botones[i].style.display = 'none';
        }
    }

    //muestra los botones de documentos
    function mostrarBotones() {
        var botones = document.getElementsByClassName('btnDescargarDocumento');
        for (var i = 0; i < botones.length; i++) {
            botones[i].style.display = 'inline-block';
        }
    }

    //descargar documento
    function descargarDocumento(rutaDocumento, nombreDocumento, empleado) {
        // Obtén la referencia a la fila que deseas cambiar

        rutaDocumento = "../" + rutaDocumento;
        fetch(rutaDocumento)
            .then(response => {
                // Verifica si la solicitud fue exitosa (código de respuesta 200)
                if (!response.ok) {
                    throw new Error('Error al descargar el archivo PDF');
                }

                // Devuelve la respuesta como un blob (datos binarios)
                return response.blob();
            })
            .then(blob => {
                // Crea un enlace temporal y asigna el blob como su origen
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                NombreDocumento = empleado.trim() + "_" + nombreDocumento + '.' + obtenerExtension(rutaDocumento);
                // Asigna un nombre al archivo PDF descargable
                a.download = NombreDocumento;

                // Agrega el enlace al cuerpo del documento
                document.body.appendChild(a);

                // Simula un clic en el enlace para iniciar la descarga
                a.click();

                // Elimina el enlace del DOM después de la descarga
                window.URL.revokeObjectURL(url);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al descargar el archivo PDF');
            });
    }

    //Pedir ruta de documento
    function pedirRutaDocumento(id, tipoDocumento) {

        var dataObject = {};
        dataObject['id'] = id;
        dataObject['tipoDocumento'] = tipoDocumento;
        dataObject['opcion'] = 7; //pedir ruta
        dataJSON = JSON.stringify(dataObject);
        return fetch('../dashboard/bd/copiaCrud.php', {
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

                    return data;
                }

            })
            .catch(error => {
                console.error('Error:', error);
            });

    }



    //crear pdf en base a la plantilla html
    function crearPDF(datos, nombre, tipoDocumento, RutaImg) {
        var dataObject = {};

        dataObject['opcion'] = 3; //crear pdf
        dataObject['datos'] = datos;
        dataObject['nombre'] = nombre;
        dataObject['tipoDocumento'] = tipoDocumento;
        dataJSON = JSON.stringify(dataObject);

        //verificamos si se estan enviando los datos completos
        console.log(dataJSON);
        fetch('../upload.php', {
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
                    rutaArchivo = "../" + data.ruta;


                    subirRutaDocumento(data.Id, tipoDocumento, rutaArchivo);
                    if (confirm("¿Desea abrir el archivo?")) {
                        window.open(rutaArchivo, '_blank');
                    }


                }

            })
            .catch(error => {
                console.error('Error:', error);
            });






    }

    //Pedir todos los datos de una persona
    function pedirDatosPersona(id) {
        var dataObject = {};
        dataObject['id'] = id;
        dataObject['opcion'] = 3;
        dataJSON = JSON.stringify(dataObject);
        return fetch('../dashboard/bd/copiaCrud.php', {
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
                    return data;

                }

            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    //pedir datos de todas las personas
    function pedirDatosPersonas() {
        var dataObject = {};
        dataObject['opcion'] = 8; //pedir datos de todas las personas
        dataJSON = JSON.stringify(dataObject);
        return fetch('../dashboard/bd/copiaCrud.php', {
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
                    return data;

                }

            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    //funcion para resetear los campos del formulario
    function resetForm() {
        // La operación fue exitosa, puedes realizar otras acciones aquí
        //datos personales
        $("#nombre").val("");
        $("#fechaNacimiento").val("");
        $("#curp").val("");
        $("#rfc").val("");
        $("#numeroFijo").val("");
        $("#numeroCelular").val("");
        $("#direccion").val("");
        $("#numeroLicencia").val("");
        $("#numeroPasaporte").val("");
        $("#fechaIngreso").val("");
        $("#correo").val("");
        //datos medicos
        $("#alergias").val("");
        $("#enfermedadesCronicas").val("");
        $("#lesiones").val("");
        $("#alergiasMedicamentos").val("");
        $("#numeroSeguro").val("");
        $("#nombreEmergencia").val("");
        $("#numeroEmergencia").val("");
        $("#tipoSangre").val("");

        //datos academicos
        $("#cedula").val("");
        $("#carrera").val("");
        $("#expLaboral").val("");
        $("#certificaciones").val("");
        $("#gradoEstudios").val("");
    }

    //funcion para obtener extencion del archivo
    function obtenerExtension(archivo) {
        var extension = archivo.split('.').pop();
        return extension;
    }



    //añadir fila a la tabla de personas
    function añadirFilaPersonas(id, nombre, fechaNacimiento, curp, rfc, numeroFijo, correo, numeroCelular, direccion, numeroLicencia, numeroPasaporte, fechaIngreso, estado, tipoContrato, InicioContrato, finContrato) {

        rolUsuario = obtenerRolUsuario();
        rolUsuario = rolUsuario.trim();
        
        if (rolUsuario == "Administrador") {

            var botones = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button><button class='btn btn-secondary btnOpciones' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Opciones</button><div class='dropdown-menu' aria-labelledby='opcionesDropdown'><a class='dropdown-item btnSubirArchivo' href='#'>Subir Archivo</a><a class='dropdown-item btnDescargarArchivo' href='#'>Descargar Archivo</a><a class='dropdown-item btnGenerarReporte' href='#'>Generar Reporte</a><a class='dropdown-item btnGenerarCredencial' href='#'>Generar Credencial</a><a class='dropdown-item btnDetalles' href='#'>Detalles</a></div></div></div>";
        } else {
            var botones = "<div class='text-center'><div class='btn-group'><button class='btn btn-secondary btnOpciones' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Opciones</button><div class='dropdown-menu' aria-labelledby='opcionesDropdown'><a class='dropdown-item btnDescargarArchivo' href='#'>Descargar Archivo</a><a class='dropdown-item btnGenerarReporte' href='#'>Generar Reporte</a><a class='dropdown-item btnGenerarCredencial' href='#'>Generar Credencial</a><a class='dropdown-item btnDetalles' href='#'>Detalles</a></div></div></div>";
        }



        if (estado == "activo") {
            estado = "<div class='badge badge-success'>" + estado + "</div>";
        } else {
            estado = "<div class = 'badge badge-danger' > " + estado + "</div>";
        }
        tablaPersonas.row.add([id, nombre, fechaNacimiento, curp, rfc, numeroFijo, correo, numeroCelular, direccion, numeroLicencia, numeroPasaporte, fechaIngreso, estado, tipoContrato, InicioContrato, finContrato, botones]).draw();

    }

    //actualizar tabla de personas
    function actualizarTablaPersonas() {
        //Buscamos la tabla de personas

        // Eliminamos todas las filas de la tabla
        tablaPersonas.clear().draw();
        //solicitamos los datos de las personas
        pedirDatosPersonas()
            .then(data => {
                //datos optenidos
                console.log(data);
                for (let i = 0; i < data.data.length; i++) {
                    const element = data.data[i];
                    var checkbox = document.getElementById("todoCheck1");
                    console.log(element.Correo)
                    if (checkbox.checked == true) {

                        añadirFilaPersonas(element.Id, element.Nombre, element.FechaNacimiento, element.Curp, element.Rfc, element.NumeroFijo, element.Correo, element.NumeroCelular, element.Direccion, element.NumeroLicencia, element.NumeroPasaporte, element.FechaIngreso, element.Estado, element.TipoContrato, element.InicioContrato, element.FinContrato);
                    } else {
                        if (element.Estado == "activo") {
                            añadirFilaPersonas(element.Id, element.Nombre, element.FechaNacimiento, element.Curp, element.Rfc, element.NumeroFijo, element.Correo, element.NumeroCelular, element.Direccion, element.NumeroLicencia, element.NumeroPasaporte, element.FechaIngreso, element.Estado, element.TipoContrato, element.InicioContrato, element.FinContrato);
                        }

                    }
                }
            });
        tablaPersonas.draw();
    }

    //funcion para vaciar fileInput
    function resetFileInputs() {


        for (var i = 0; i < documentos.length; i++) {
            inputId = "fileInput" + documentos[i];
            document.getElementById(inputId).value = "";

        }

    }

    //funcion para obtener datos de la session
    function obtenerRolUsuario() {
        var valor = document.getElementById('rolUsuario').textContent;
        return valor;
        
    }



});