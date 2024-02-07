<style>
    .section {
        display: none;
    }

    .section.active {
        display: block;
    }
</style>

<form id="formPersonas2" method="post">
    <div class="modal-body">
        <!-- Sección 1 -->
        <div class="section active" id="seccion1">
            <?php require_once "vistas/form_datos_basicos.php" ?>

        </div>

        <!-- Sección 2 -->
        <div class="section" id="seccion2">
            <?php require_once "vistas/form_datos_medicos.php" ?>
        </div>

        <!-- Sección 3 -->
        <div class="section" id="seccion3">
            <?php require_once "vistas/form_datos_academicos.php" ?>
        </div>
        <div class="button-container">
            <button type="button" class="btn" onclick="mostrarSeccion(1)">Siguiente</button>
            <button type="button" class="btn" onclick="mostrarSeccion(-1)">Anterior</button>
            <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
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

    document.getElementById('formPersonas2').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto del formulario
        console.log("metodo fetch");
        // Obtener los datos del formulario
        var formData = new FormData(document.getElementById('formPersonas2'));
        // Crear un objeto vacío para almacenar los datos
        var formDataObject = {};
        // Iterar sobre las entradas de formData y agregarlas al objeto
        formData.forEach(function (value, key) {
            if (value === '') {
                value = 'vacio';
            }

            formDataObject[key] = value;
        });
        // Agregar la opción al objeto en este caso para insertar los datos
        formDataObject['opcion'] = 1;

        // Convertir el objeto a una cadena JSON
        var formDataJSON = JSON.stringify(formDataObject);
        //console.log('Datos en formato JSON:', formDataJSON);
        console.log('Datos codificados:', formDataJSON);

        // Realizar la solicitud POST
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
                console.log('Datos recibidos:', data);
            })
            .catch(error => {
                console.error('Error:', error);
            });

    });
</script>