<style>
    .section {
        display: none;
        transition: opacity 0.5s;
    }

    .section.active {
        display: block;
        opacity: 1;
    }
</style>

<form id="formPersonas">
    <div class="modal-body">
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

    </div>
</form>
<script>
    var currentSection = 0;
    var sections = document.getElementsByClassName('section');

    function mostrarSeccion(n) {
        sections[currentSection].classList.remove('active');
        currentSection = Math.min(Math.max(currentSection + n, 0), sections.length - 1);
        sections[currentSection].classList.add('active');
    

    }
</script>