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
    tablaEmpresas.column(5).visible(false);
    tablaEmpresas.column(7).visible(false);
    tablaEmpresas.column(8).visible(false);
    tablaEmpresas.column(9).visible(false);
    tablaEmpresas.column(10).visible(false);
    tablaEmpresas.column(11).visible(false);
    //fin de la tabla Empresas


    //inicializar la tabla de subcontratados
    var tablaSubContratados = $("#tablaSubContratados").DataTable({
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

    tablaSubContratados.buttons().container().appendTo('#tablaSubContratados_wrapper .col-md-6:eq(0)');
    tablaSubContratados.column(4).visible(false);
    tablaSubContratados.column(3).visible(false);

    //fin de la tabla subcontratados

    //inicializar la tabla de tablaContratos
    var tablaContratos = $("#tablaContratos").DataTable({
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
    tablaContratos.buttons().container().appendTo('#tablaContratos_wrapper .col-md-6:eq(0)');

    tablaContratos.column(2).visible(false);
    tablaContratos.column(4).visible(false);
    tablaContratos.column(6).visible(false);
    tablaContratos.column(7).visible(false);
    tablaContratos.column(8).visible(false);
    tablaContratos.column(9).visible(false);
    tablaContratos.column(10).visible(false);
    //tablaContratos.column(11).visible(false);
    //fin de la tabla tablaContratos


    //inicializar la tabla de facturas
    var tablaFacturas = $("#tablaFacturas").DataTable({
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
    tablaFacturas.buttons().container().appendTo('#tablaFacturas_wrapper .col-md-6:eq(0)');

    //fin de la tabla de facturas

    var idsSeleccionados = [];

    // Obtener todos los checkboxes
    var checkboxes = document.querySelectorAll('.checkBoxContrato');

    // Agregar un event listener a cada checkbox
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // Obtener el ID de la fila correspondiente al checkbox
            var id = this.parentNode.parentNode.querySelector('td:first-child').textContent;

            //si el checkbox esta seleccionando guardar el id en una variable
            if (this.checked) {
                idsSeleccionados.push(id);
            } else {
                //si el checkbox esta deseleccionado eliminar el id de la variable
                var index = idsSeleccionados.indexOf(id);
                if (index > -1) {
                    idsSeleccionados.splice(index, 1);
                }
            }

            

            // Imprimir los IDs seleccionados en la consola (puedes enviarlos al servidor aquí)


            if (idsSeleccionados.length > 0) {
                //guardamos el id seleccionado en una variable de _SESSION
                enviarCheckboxAlServidor(idsSeleccionados['0']);

                
            }else{
                enviarCheckboxAlServidor(0);
            }
            
        });

    });
    

    //inicializamos selects
    $('#selectPersonalTerceros').select2({
        placeholder: 'Selecciona una opción'
    });

    $('#selectPersonalOceanus').select2({
        placeholder: 'Selecciona una opción'
    });

    $('#selectFacturaContrato').select2();

    $('#selectFacturaEmpresa').select2();
    
    $("#btnGuardarEmpresa").click(function () {
        var razonSocial = $("#empresaRazonSocial").val();
        var rfc = $("#empresaRFC").val();
        var tipoRegimen = $("#empresaTipoRegimen").val();
        var representante = $("#empresaRepresentantes").val();
        var corre = $("#empresaCorreo").val();
        var telefono = $("#empresaTelefono").val();
        var idEmpresa = getQueryParam('idEmpresa');
        var logo = $("#empresaLogo").val();
        var contacto = $("#empresaNombreContacto").val();
        var correoFacturacion = $("#empresaCorreoFacturacion").val();
        var numeroCuenta = $("#empresaNumeroCuenta").val();
        var banco = $("#empresaBanco").val();
        var fechaVencimientoConstancia = $("#empresaFechaVencimientoConstancia").val();



        var data = {
            id: idEmpresa,
            razonSocial: razonSocial,
            rfc: rfc,
            tipoRegimen: tipoRegimen,
            representanteLegal: representante,
            correo: corre,
            telefono: telefono,
            logo: logo,
            contacto: contacto,
            correoFacturacion: correoFacturacion,
            numeroCuenta: numeroCuenta,
            banco: banco,
            fechaVencimientoConstancia: fechaVencimientoConstancia,
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
                        window.location.href = "indexdb.php?table=empresas&edit=true&idEmpresa=" + data.data.id;
                    } catch (error) {
                        console.log('error', error);
                    }



                }

            })
            .catch(error => {
                // Handle the error
            });
    });


    $("#btnActualizarPersonal").click(function () {
        var idSubContratado = getQueryParam('idSubContratado');
        var nombre = $("#personalNombre").val();
        var RFC = $("#personalRFC").val();
        var Inss = $("#personalInss").val();
        var Ine = $("#personalIne").val();
        var Curp = $("#personalCurp").val();
        var Estado = $("#personalEstado").val();
        var data = {
            idSubContratado: idSubContratado,
            nombre: nombre,
            rfc: RFC,
            inss: Inss,
            ine: Ine,
            curp: Curp,
            estado: Estado,
            opcion: 'editarPersonal'
        };

        editarPersonal(data);
    });

    $("#btnSubContratadoNuevo").click(function () {
        var data = {
            opcion: 'añadirPersonal'
        };
        fetch('bd/crudPersonal.php', {
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
                        window.location.href = "indexdb.php?table=personal&edit=true&idSubContratado=" + data.data.idSubContratado;
                    } catch (error) {
                        console.log('error', error);
                    }
                }
            })
            .catch(error => {
                console.log('error', error);
            });
    });

    $("#btnEliminarPersonal").click(function () {
        var idSubContratado = getQueryParam('idSubContratado');
        var data = {
            idSubContratado: idSubContratado,
            opcion: 'eliminarPersonal'
        };

        eliminarPersonal(data);
    });

    $("#btnEliminarEmpresa").click(function () {
        var idEmpresa = getQueryParam('idEmpresa');
        var data = {
            id: idEmpresa,
            opcion: 'eliminarEmpresa'
        };

        eliminarEmpresa(data);
    });

    $("#btnActualizarContrato").click(function () {
        //inicio obtener los valores de los campos
        var idContrato = getQueryParam('idContrato');
        var titulo = $("#contratoTitulo").val();
        var nombreContrato = $("#contratoNombreContrato").val();
        var direccion = $("#contratoDireccion").val();
        var contratante = $("#contratoContratante").val();
        var contratado = 38;
        var tipoContrato = $("#contratoTipoContrato").val();
        var contratoFuente = $("#contratoFuente").val();
        var fechaInicio = $("#contratoInicio").val();
        var fechaFin = $("#contratoFin").val();
        var monto = $("#contratoMonto").val();
        var anticipo = $("#contratoAnticipo").val();
        var numero = $("#contratoNumero").val();
        var convenio = $("#contratoConvenio").val();
        var fianzaCumplimientoInicio = $("#contratoFianzaCumplimientoInicio").val();
        var fianzaCumplimientoFin = $("#contratoFianzaCumplimientoFin").val();
        var fianzaCumplimientoMonto = $("#contratoFianzaCumplimientoMonto").val();
        var fianzaCumplimientoPoliza = $("#contratoFianzaCumplimientoPoliza").val();
        var fianzaCumplimientoAseguradora = $("#contratoFianzaCumplimientoAseguradora").val();
        var fianzaAnticipoInicio = $("#contratoFianzaAnticipoInicio").val();
        var fianzaAnticipoFin = $("#contratoFianzaAnticipoFin").val();
        var fianzaAnticipoMonto = $("#contratoFianzaAnticipoMonto").val();
        var fianzaAnticipoPoliza = $("#contratoFianzaAnticipoPoliza").val();
        var fianzaAnticipoAseguradora = $("#contratoFianzaAnticipoAseguradora").val();
        var fianzaViciosOcultosInicio = $("#contratoFianzaViciosOcultosInicio").val();
        var fianzaViciosOcultosFin = $("#contratoFianzaViciosOcultosFin").val();
        var fianzaViciosOcultosMonto = $("#contratoFianzaViciosOcultosMonto").val();
        var fianzaViciosOcultosPoliza = $("#contratoFianzaViciosOcultosPoliza").val();
        var fianzaViciosOcultosAseguradora = $("#contratoFianzaViciosOcultosAseguradora").val();
        //fin obtener los valores de los campos

        //inicio de la creacion del objeto data
        var data = {
            idContrato: idContrato,
            titulo: titulo,
            nombreContrato: nombreContrato,
            direccion: direccion,
            contratante: contratante,
            contratado: contratado,
            tipoContrato: tipoContrato,
            contratoFuente: contratoFuente,
            fechaInicio: fechaInicio,
            fechaFin: fechaFin,
            monto: monto,
            anticipo: anticipo,
            numero: numero,
            convenio: convenio,
            fianzaCumplimiento: {
                inicio: fianzaCumplimientoInicio,
                fin: fianzaCumplimientoFin,
                monto: fianzaCumplimientoMonto,
                poliza: fianzaCumplimientoPoliza,
                aseguradora: fianzaCumplimientoAseguradora
            },
            fianzaAnticipo: {
                inicio: fianzaAnticipoInicio,
                fin: fianzaAnticipoFin,
                monto: fianzaAnticipoMonto,
                poliza: fianzaAnticipoPoliza,
                aseguradora: fianzaAnticipoAseguradora

            },
            fianzaViciosOcultos: {
                inicio: fianzaViciosOcultosInicio,
                fin: fianzaViciosOcultosFin,
                monto: fianzaViciosOcultosMonto,
                poliza: fianzaViciosOcultosPoliza,
                aseguradora: fianzaViciosOcultosAseguradora
            },

            opcion: 'editarContrato'
        };
        actualizarContrato(data);

    });

    $("#btnContratoNuevo").click(function () {
        var data = {
            opcion: 'añadirContrato'
        };
        fetch('bd/crudContrato.php', {
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
                        window.location.href = "indexdb.php?table=contratos&edit=true&idContrato=" + data.data.idContrato;
                    } catch (error) {
                        console.log('error', error);
                    }
                }
            })
            .catch(error => {
                console.log('error', error);
            });
    });

    $("#btnNuevaRelacionContratoPersonal").click(function () {
        var idContrato = getQueryParam('idContrato');
        var idSubContratado = $("#relacionPersonal").val();
        var data = {
            idContrato: idContrato,
            idSubContratado: idSubContratado,
            opcion: 'añadirRelacionContratoPersonal'
        };
        fetch('bd/crudContratoPersonal.php', {
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
                        window.location.reload();
                    } catch (error) {
                        console.log('error', error);
                    }
                }
            })
            .catch(error => {
                console.log('error', error);
            });

    });

    $("#btnNuevaRelacionContratoPersonalTerceros").click(function () {
        
        var idContrato = getQueryParam('idContrato');
        var idSubContratado = $("#selectPersonalTerceros").val();
        var data = {
            idContrato: idContrato,
            idSubContratado: idSubContratado,
            tipo: 'terceros',
            opcion: 'añadirRelacionContratoPersonal'
        };
        añadirRelacionContratoPersonal(data);



    });
    $("#btnNuevaRelacionContratoPersonalOceanus").click(function () {
        
        var idContrato = getQueryParam('idContrato');
        var idSubContratado = $("#selectPersonalOceanus").val();
        var data = {
            idContrato: idContrato,
            idSubContratado: idSubContratado,
            tipo: 'oceanus',
            opcion: 'añadirRelacionContratoPersonal'
        };
        añadirRelacionContratoPersonal(data);



    });

    $(".btnEliminarRelacionContratoPersonal").click(function () {
        var idContrato = getQueryParam('idContrato');
        var idSubContratado = $(this).attr('data-id');
        var data = {
            idContrato: idContrato,
            idPersonal: idSubContratado,
            opcion: 'eliminarRelacionContratoPersonal'
        };
        fetch('bd/crudContratoPersonal.php', {
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
                        window.location.reload();
                    } catch (error) {
                        console.log('error', error);
                    }
                }
            })
            .catch(error => {
                console.log('error', error);
            });
    });

    $("#btnFacturaNueva").click(function () {
        
        
        var data = {
            opcion: 'añadirFactura'
        };
        fetch('bd/crudFactura.php', {
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
                        console.log(data.data.id);

                        window.location.href = "indexdb.php?table=facturas&edit=true&idFactura=" + data.data.id;
                    } catch (error) {
                        console.log('error', error);
                    }
                }
            })
            .catch(error => {
                console.log('error', error);
            });


    });

    $("#btnActualizarFactura").click(function () {
        var idFactura = getQueryParam('idFactura');
        var idContrato = $("#selectFacturaContrato").val();
        var idEmpresa = $("#selectFacturaEmpresa").val();
        var fecha = $("#fechaFactura").val();
        var importe = $("#importeFactura").val();
        var titulo = $("#tituloFactura").val();
        var numero = $("#numeroFactura").val();
        var data = {
            idFactura: idFactura,
            idContrato: idContrato,
            idEmpresa: idEmpresa,
            fecha: fecha,
            importe: importe,
            titulo: titulo,
            numero: numero,
            opcion: 'editarFactura'
        };
        fetch('bd/crudFactura.php', {
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
                        window.location.reload();
                    } catch (error) {
                        console.log('error', error);
                    }
                }
            })
            .catch(error => {
                console.log('error', error);
            });
    });

    $("#btnEliminarFactura").click(function () {
        var idFactura = getQueryParam('idFactura');
        var data = {
            idFactura: idFactura,
            opcion: 'eliminarFactura'
        };
        fetch('bd/crudFactura.php', {
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
                        window.location.href = "indexdb.php?table=facturas";
                    } catch (error) {
                        console.log('error', error);
                    }
                }
            })
            .catch(error => {
                console.log('error', error);
            });
    });

    $("#btnEliminarContrato").click(function () {
        var idContrato = getQueryParam('idContrato');
        var data = {
            idContrato: idContrato,
            opcion: 'eliminarContrato'
        };
        fetch('bd/crudContrato.php', {
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
                        window.location.href = "indexdb.php?table=contratos";
                    } catch (error) {
                        console.log('error', error);
                    }
                }
            })
            .catch(error => {
                console.log('error', error);
            });
    });

    $(".btnSubirArchivo").click(function () {
        //obtener el id del contrato
        
        if (getQueryParam('idContrato') == null) {
            var idContrato = $(this).attr('data-idContrato');
            
        }else{
            var idContrato = getQueryParam('idContrato');

            
        }


        //obtenemos el tipo de archivo
        var tipoArchivo = $(this).attr('data-tipoArchivo');
        //obtener el id del input file
        var idInputFile = $(this).attr('data-inputFile');
        //agregamos el nombre del archivo
        var nombreArchivo = $(this).attr('data-nombreArchivo');

        //posible dato extra en caso de existir

        if ($(this).attr('data-datoExtra') == null) {
            var datoExtra = '';
        } else {
            var datoExtra = $(this).attr('data-datoExtra');
        }
        




        //obtener el archivo seleccionado
        var archivo = document.getElementById(idInputFile).files[0];
        //creamos un objeto FormData
        var formData = new FormData();
        //agregamos el archivo al objeto FormData
        formData.append('archivo', archivo);
        //agregamos el nombre del acrhivo
        formData.append('nombreDocumento', nombreArchivo);
        //agregamos el posible dato extra
        formData.append('datoExtra', datoExtra);

        //agregamos el id del contrato al objeto FormData
        formData.append('id', idContrato);
        //agregamos el tipo de archivo al objeto FormData
        formData.append('tipoDocumento', tipoArchivo);
        //agregamos la opcion al objeto FormData
        formData.append('opcion', '4');
        //realizamos la peticion al servidor
        fetch('../upload.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.errores && data.errores.length > 0) {
                    // Mostrar los errores en el contenedor
                    console.log('Errores:', data.errores);
                } else {
                    // La operación fue exitosa, puedes realizar otras acciones aquí
                    console.log(data);

                    console.log(data.message);
                    try {
                        window.location.reload();
                    } catch (error) {
                        console.log('error', error);
                    }
                }
            })
            .catch(error => {
                console.log('error', error);
            });

    });


    $("#btnInputFileExecelContratos").click(function () {
        //obtenemos el archivo seleccionado
        var archivo = document.getElementById('inputFileExecelContratos').files[0];
        //creamos un objeto FormData
        var formData = new FormData();
        //agregamos el archivo al objeto FormData
        formData.append('archivo', archivo);
        //agregamos la opcion al objeto FormData
        formData.append('opcion', '5');
        //realizamos la peticion al servidor
        fetch('../upload.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.errores && data.errores.length > 0) {
                    // Mostrar los errores en el contenedor
                    console.log('Errores:', data.errores);
                } else {
                    // La operación fue exitosa, puedes realizar otras acciones aquí
                    console.log(data);

                    console.log(data.message);
                    try {
                        window.location.reload();
                    } catch (error) {
                        console.log('error', error);
                    }
                }
            })
            .catch(error => {
                console.log('error', error);
            });
    });

    function eliminarEmpresa(data) {
        fetch('bd/crudEmpresas.php', {
            method: 'POST',
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                // Handle the response data
                if (data.errores && data.errores.length > 0) {
                    // Mostrar los errores en el contenedor
                    console.log('Errores:', data.errores);
                } else {
                    // La operación fue exitosa, puedes realizar otras acciones aquí
                    console.log(data);
                    try {
                        window.location.href = "indexdb.php?table=empresas";
                    } catch (error) {
                        console.log('error', error);
                    }
                }
            })
            .catch(error => {

                // Handle the error

            });
    }


    function eliminarPersonal(data) {
        fetch('bd/crudPersonal.php', {
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
                        window.location.href = "indexdb.php?table=personal";
                    } catch (error) {
                        console.log('error', error);
                    }
                }
            })
            .catch(error => {
                console.log('error', error);
            });
    }

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
                console.log('error', error);
            });
    }

    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    function editarPersonal(data) {
        fetch('bd/crudPersonal.php', {
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

    function actualizarContrato(data) {
        // Aquí va la lógica para actualizar el contrato
        fetch('bd/crudContrato.php', {
            method: 'POST',
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                // Handle the response data
                if (data.errores && data.errores.length > 0) {
                    // Mostrar los errores en el contenedor
                    console.log('Errores:', data.errores);
                } else {
                    // La operación fue exitosa, puedes realizar otras acciones aquí
                    console.log(data);
                    try {
                        window.location.reload();
                    } catch (error) {
                        console.log('error', error);
                    }
                }
            })
            .catch(error => {
                // Handle the error
            });

    }

    function enviarCheckboxAlServidor(valor) {
        // Realizar una solicitud AJAX al servidor para guardar el estado del checkbox
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'bd/sesion.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            // Manejar la respuesta del servidor si es necesario
            console.log(xhr.responseText);
        };
        xhr.send('estado=' + valor);
    }

    function añadirRelacionContratoPersonal(data) {
        fetch('bd/crudContratoPersonal.php', {
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
                        window.location.reload();
                    } catch (error) {
                        console.log('error', error);
                    }
                }
            })
            .catch(error => {
                console.log('error', error);
            });

    }









}); //fin Documento
