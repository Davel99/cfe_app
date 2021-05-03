<?php if (isset($_SESSION['alert']['success'])): ?>
    <script>
        window.alert("<?= $_SESSION['alert']['success'] ?>")
    </script>

<?php elseif (isset($_SESSION['alert']['fatal'])): ?>

    <script>
        window.alert("<?= $_SESSION['alert']['fatal'] ?>")
    </script>

<?php endif; ?>
    

<div class="form-min">

        <div class="form form-min-in">

                <form action="<?= base_url ?>registro/reg_user" method="post">

                        <div class="info">
                                <h5>REGÍSTRESE</h5>
                                <hr>
                        </div>

                        <div class="inputs">

                                <?php if (isset($_SESSION['error'])): ?>

                                        <?php foreach ($_SESSION['error'] as $key => $value): ?>

                                                <div class="alert alert-danger" role="alert">
                                                        <?= $value ?>
                                                </div>



                                        <?php endforeach; ?>

                                <?php endif; ?>

                                <input type="text" name="nombre" class="form-control" placeholder="NOMBRE COMPLETO">
                                <input type="text" name="usuario" class="form-control" placeholder="NOMBRE DE USUARIO">
                                <input type="text" name="password" class="form-control" placeholder="CONTRASEÑA">
                                <input type="text" name="password-confirm" class="form-control" placeholder="CONFIRME CONTRASEÑA">

                                <label for="division">DIVISIÓN: </label>

                                <select class="col-md-12" id="division" name="division">

                                        <?php while ($div = $datos->fetch_assoc()): ?>
                                                <option value ="<?= $div['div_id'] ?>">
                                                        <?= $div['div_id'] . ' - ' . $div['nombre']; ?>
                                                </option>

                                        <?php endwhile; ?>
                                </select>  

                        </div>

                        <div class="form-button">
                                <input type="submit" class="btn btn-warning btn-block" value="INGRESAR">                                                                
                        </div>


                </form>


        </div>



</div>



<?php unset($_SESSION['error']);
unset($_SESSION['alert']);
?>

