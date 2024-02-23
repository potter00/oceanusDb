<style>
    .section {
        display: none;
    }

    .section.active {
        display: block;
    }

    .required {
        color: #e74c3c;
        /* Color rojo */
        margin-left: 5px;
    }
</style>
<div id="erroresContainer" style="color: red;"></div>
<form id="formPersonas2" method="post">
    <div class="modal-body">
        <!-- Sección 1 -->
        <div class="section active" id="seccion1">
            <h1>Datos personales</h1>
            <?php require_once "vistas/form_datos_basicos.php" ?>

        </div>

        <!-- Sección 2 -->
        <div class="section" id="seccion2">
            <h1>Datos Medicos</h1>
            <?php require_once "vistas/form_datos_medicos.php" ?>
        </div>

        <!-- Sección 3 -->
        <div class="section" id="seccion3">
            <h1>Datos Academicos</h1>
            <?php require_once "vistas/form_datos_academicos.php" ?>
        </div>
        
       
        
    </div>
</form>
<script>
    var currentSection = 0;
    var sections = document.getElementsByClassName('section');
    console.log("sections");
    function mostrarSeccion(n) {
        sections[currentSection].classList.remove('active');
        currentSection = Math.min(Math.max(currentSection + n, 0), sections.length - 1);
        sections[currentSection].classList.add('active');

    }
    function volverPrimeraSeccion() {
        console.log("volverPrimeraSeccion");
        sections[currentSection].classList.remove('active');
        currentSection = 0;
        sections[currentSection].classList.add('active');
    }
    document.getElementById('btnCerrarModalCrud').addEventListener('click', function () {
        
        console.log("cerrar modal");
        volverPrimeraSeccion();
    });
    document.getElementById('formPersonas2').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto del formulario
        
        // Obtener los datos del formulario
        var formData = new FormData(document.getElementById('formPersonas2'));
        // Crear un objeto vacío para almacenar los datos
        var formDataObject = {};
        // Iterar sobre las entradas de formData y agregarlas al objeto
        formData.forEach(function (value, key) {
            if (value === '') {
                value = 'NA';
            }

            formDataObject[key] = value;
        });
        // Agregar la opción al objeto en este caso para insertar los datos
        formDataObject['opcion'] = opcion;
        // Agregar el id al objeto en caso de que se esté actualizando
        try {
            formDataObject['id'] = id;
        } catch (error) {
            console.log("No se está actualizando");
        }
        

        // Convertir el objeto a una cadena JSON
        var formDataJSON = JSON.stringify(formDataObject);
        //console.log('Datos en formato JSON:', formDataJSON);
        

        // Realizar la solicitud POST con fetch
        fetch('bd/CopiaCrud.php', {
            method: 'POST',
            body: formDataJSON,
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
                    mostrarErrores(data.errores);
                } else {
                    // La operación fue exitosa, puedes realizar otras acciones aquí
                    location.reload();
                }
                console.log('Datos recibidos:', data);
            })
            .catch(error => {
                console.error('Error:', error);
            });

    });

    //mostrar los errores
    function mostrarErrores(errores) {
        const erroresContainer = document.getElementById('erroresContainer');
        erroresContainer.innerHTML = ''; // Limpiar cualquier mensaje de error existente

        const listaErrores = document.createElement('ul');
        errores.forEach(error => {
            const li = document.createElement('li');
            li.textContent = error;
            listaErrores.appendChild(li);
        });

        erroresContainer.appendChild(listaErrores);
    }
</script>