$(document).ready(function () {

    //inicializar la tabla
    var tablaEmpresas = $("#tablaEmpresas").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": true,
        "buttons": [
            
            {
                extend: 'excel',
                className: 'btn btn-primary',
                text: 'Exportar a Excel'
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

    tablaEmpresas.buttons().container().appendTo('#tablaEmpresas_wrapper .col-md-6:eq(0)');
    tablaEmpresas.column(2).visible(false);
    tablaEmpresas.column(3).visible(false);
    tablaEmpresas.column(6).visible(false);
    //fin de la tabla Empresas
    
    



    $("#btnGuardarEmpresa").click(function () {
        var razonSocial = $("#empresaRazonSocial").val();
        var rfc = $("#empresaRFC").val();
        var tipoRegimen = $("#empresaTipoRegimen").val();
        var representante = $("#empresaRepresentante").val();
        var corre = $("#empresaCorreo").val();
        var telefono = $("#empresaTelefono").val();
        var idEmpresa = getQueryParam('idEmpresa');
        var logo = $("#empresaLogo").val();



        var data = {
            id: idEmpresa,
            razonSocial: razonSocial,
            rfc: rfc,
            tipoRegimen: tipoRegimen,
            representanteLegal: representante,
            correo: corre,
            telefono: telefono,
            logo: logo,
            opcion: 'editarEmpresa'
        };

        editarEmpresa(data);
    });

    $("#btnEmpresaNuevo").click(function () {
        var data = {

            opcion: 'añadirEmpresa'

        };
        fetch('bd/crudEmpresas.php', {
            method: 'POST',
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
            
                if (data.errores && data.errores.length > 0) {
                    // Mostrar los errores en el contenedor
                    console.log('Errores:', data.errores);

                } else {
                    // La operación fue exitosa, puedes realizar otras acciones aquí
                    console.log(data);
                   
                    try {
                        window.location.href = "indexdb.php?table=empresas&edit=true&idEmpresa=" + data.data.id ;
                    } catch (error) {
                        console.log('error', error);
                    }
                    


                }

            })
            .catch(error => {
                // Handle the error
            });
    });

    function editarEmpresa(data) {
        fetch('bd/crudEmpresas.php', {
            method: 'POST',
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if (data.errores && data.errores.length > 0) {
                    // Mostrar los errores en el contenedor
                    console.log('Errores:', data.errores);

                } else {
                    // La operación fue exitosa, puedes realizar otras acciones aquí
                    console.log(data);
                    window.location.reload();


                }

            })
            .catch(error => {
                // Handle the error
            });
    }

    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }



}); //fin Documento
