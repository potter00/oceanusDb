<h5><strong>subcontratos</strong></h5>
<?php
if (!isset($_GET['edit'])) {

    ?>

    <table class="table table-sm table-striped table-bordered table-condensed text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>

            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i <= 10; $i++) { ?>
                <tr>
                    <td>8241</td>
                    <td>creacion de pro...</td>

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
                <th>#</th>
                <th>Nombre</th>
                <th>
                    <i class="fas fa-plus"></i>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i <= 10; $i++) { ?>
                <tr>
                    <td>8241</td>
                    <td>creacion de pro...</td>
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