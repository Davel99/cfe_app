<div class="form-min">

        <div class="form form-min-in">

                <form action="<?= base_url ?>login/log_user" method="post">

                        <div class="info">
                                <h5>INGRESE SUS DATOS</h5>
                                <hr>
                                <p>Si olvidó su contraseña, puede pedir 
                                        al administrador que la resetee, en cuyo caso será
                                        simplemente "CFE_app0".</p>
                        </div>


                        <?php if (isset($_SESSION['login'])): ?>

                                <?php foreach ($_SESSION['login'] as $key => $value): ?>

                                        <div class="alert alert-danger" role="alert">
                                                <?= $value ?>
                                        </div>

                                <?php endforeach; ?>

                        <?php endif; ?>

                        <div class="inputs">

                                <input type="text" name="usuario" class="form-control" placeholder="NOMBRE DE USUARIO">
                                <input type="password" name="password" class="form-control" placeholder="CONTRASEÑA">

                        </div>

                        <div class="form-button">
                                <input type="submit" class="btn btn-warning btn-block" value="INGRESAR">                                                                
                        </div>


                </form>


        </div>



</div>


<?php unset($_SESSION['login']); ?>