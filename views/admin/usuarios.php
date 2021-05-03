<div class="info text-center">
        <h5>LISTA DE CUENTAS DE USUARIOS</h5>
        <hr>
        <p>
                Puede resetear contraseñas, en cuyo caso su valor se modifica 
                al de "CFE_app0"; activar o desactivar usuarios; o eliminarlos.
        </p>
        
        <hr>
        
</div>
<!--
<div class="form-min">
        <div class="form form-min-in">
                <form action="" method="post">
                        <div class="info text-center">
                                <h5>FILTRO DE BÚSQUEDA</h5>

                                <p>
                                        Busque registros específicos con este formulario
                                </p>
                        </div>

                        <div class="inputs">

                                <label class="label-form" for="divisiones">SELECCIONE UNA DIVISIÓN: </label>

                                <select class="col-md-12" id="divisiones">
                                        <option>
                                                TODAS
                                        </option>
                                </select>

                                <label class="label-form" for="tip-cuenta">TIPO DE CUENTA: </label>

                                <select class="col-md-12" id="tip-cuenta">
                                        <option value="null">
                                                TODOS
                                        </option>
                                        <option value="0">
                                                DESACTIVADA
                                        </option> 
                                        <option value="1">
                                                ACTIVADA
                                        </option>
                                </select>    


                        </div>

                        <div class="form-button">

                                <input type="submit" class="btn btn-info btn-block" value="APLICAR FILTROS">

                        </div>
                </form>
        </div>
</div>-->
<!--BLOQUE PARA MOSTRAR RESULTADO DE LOS RESETS-->
<?php if (isset($_SESSION['admin']['reset'])): ?>

        <div class="alert alert-warning" role="alert">
                <?= $_SESSION['admin']['reset'] ?>
        </div>
<?php endif; ?>

<!--BLOQUE PARA MOSTRAR RESULTADO DE CAMBIO DE ESTADO-->
<?php if (isset($_SESSION['admin']['edo'])): ?>

        <div class="alert alert-warning" role="alert">
                <?= $_SESSION['admin']['edo'] ?>
        </div>
<?php endif; ?>


<!--BLOQUE PARA MOSTRAR RESULTADO DE LA ELIMINACIÓN-->
<?php if (isset($_SESSION['admin']['del'])): ?>

        <div class="alert alert-warning" role="alert">
                <?= $_SESSION['admin']['del'] ?>
        </div>

<?php endif; ?>



<div class="table-responsive" id="table-container">

        <table class="table table-bordered table-dark">
                <thead>
                        <tr>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">USUARIO</th>
                                <th scope="col">DIVISIÓN</th>
                                <th scope="col">ESTADO</th>
                                <th scope="col">RESETEAR<br>CONTRASEÑA</th>
                                <th scope="col">CAMBIAR<br>ESTADO</th>
                                <th scope="col">ELIMINAR</th>

                        </tr>
                </thead>
                <tbody>
                        <?php foreach ($usuarios as $user): ?>
                                <tr>

                                        <td><?= $user['nombre'] ?></td>
                                        <td><?= $user['username'] ?></td>
                                        <td><?= $user['div_id'] ?></td>

                                        <?php if ($user['activo'] == '1'): ?>
                                                <td class="bg-success">ACTIVADA</td>
                                        <?php else: ?>
                                                <td class="bg-danger">NO ACTIVADA</td>
                                        <?php endif; ?>

                                        <td>
                                                <form action="<?= base_url ?>admin/reset_pass&id=<?= $user['user_id'] ?>">
                                                        <button type="submit" class="btn btn-warning btn-block">
                                                                <img src="<?= base_url ?>vendor/bootstrap/icons/hammer.svg" width="20" height="20">
                                                        </button>
                                                </form>
                                        </td>
                                        <td>

                                                <form action="<?= base_url ?>admin/cambiar_edo&id=<?= $user['user_id'] ?>">

                                                        <?php if ($user['activo'] == '1'): ?>
                                                                <button class="btn btn-danger btn-block">
                                                                        <img src="<?= base_url ?>vendor/bootstrap/icons/power.svg" width="20" height="20">
                                                                </button>
                                                        <?php else: ?>
                                                                <button class="btn btn-success btn-block">
                                                                        <img src="<?= base_url ?>vendor/bootstrap/icons/power.svg" width="20" height="20">
                                                                </button>
                                                        <?php endif; ?>

                                                </form>
                                        </td>
                                        <td>
                                                <form action="<?= base_url ?>admin/del_user&id=<?= $user['user_id'] ?>">
                                                        <button class="btn btn-danger btn-block">
                                                                <img src="<?= base_url ?>vendor/bootstrap/icons/trash.svg" width="20" height="20">
                                                        </button>
                                                </form>
                                        </td>

                                </tr>

                        <?php endforeach; ?>



                </tbody>
        </table>




</div>

<?php
unset($_SESSION['admin']['reset']);
unset($_SESSION['admin']['edo']);
unset($_SESSION['admin']['del']);
?>

