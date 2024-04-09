<h5><strong>personal</strong></h5>
<?php
if (!isset($_GET['edit'])) {

    ?>

    <table class="table table-sm table-striped table-bordered table-condensed text-center">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Empresa</th>

            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i <= 10; $i++) { ?>
                <tr>
                    <td>juan carlos bodoque</td>
                    <td>31 minutos</td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php
} else {
    ?>
    <table class="table table-sm table-striped table-bordered table-condensed text-center">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Empresa</th>
                <th>
                    <i class="fas fa-plus"></i>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i <= 10; $i++) { ?>
                <tr>
                    <td>juan carlos bodoque</td>
                    <td>31 minutos</td>
                    <td>
                        <i class="fas fa-trash"></i>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
}
?>