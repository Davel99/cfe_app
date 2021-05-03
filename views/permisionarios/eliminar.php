<div class="info text-center">
        <h5>ELIMINE A SUS PERMISIONARIOS</h5>
        <hr>
        <p>Oprima el botón rojo correspondiente a cada registro</p>
</div>

<?php if (isset($_SESSION['del'])): ?>

        <div class="alert alert-danger" role="alert">
                <?= $_SESSION['del'] ?>
        </div>
<?php endif; ?>




<div class="" id="table-container">

        <table class="table table-bordered table-dark">
                <thead>
                        <tr>
                                <th scope="col">PERMISIONARIO</th>
                                <th scope="col">ACRÓNIMO</th>
                                <th scope="col">PERMISO</th>
                                <th scope="col">ELIMINAR</th>

                        </tr>
                </thead>
                <tbody>

                        <?php if (!empty($permisionarios)): ?>
                                <?php foreach ($permisionarios as $reg): ?>
                                        <tr>

                                                <td><?= $reg['perm_id'] ?></td>                                       
                                                <td><?= $reg['nombre'] ?></td>
                                                <td><?= $reg['permiso'] ?></td>
                                                <td>
                                                        <form action="<?= base_url ?>permisionarios/del_perm&id=<?= $reg['perm_id'] ?>" method="post">

                                                                <button type="submit" class="btn btn-danger btn-block">
                                                                        <img src="<?= base_url ?>vendor/bootstrap/icons/trash.svg" width="20" height="20">
                                                                </button>

                                                        </form>

                                                </td>

                                        </tr>
                                <?php endforeach; ?>


                                <?php else: ?>

                                        <div class="alert alert-danger" role="alert">
                                                La lista de permisionarios está vacía.                               
                                        </div>


                        <?php endif; ?>

                </tbody>
        </table>




</div>

<?php
unset($_SESSION['del']);
?>