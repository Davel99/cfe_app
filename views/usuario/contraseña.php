<div class="form-min">

        <div class="form form-min-in">

                <form action="<?= base_url ?>usuario/cambiar_pass" method="post">

                        <div class="info">

                                <?php if (isset($_SESSION['cambio'])): ?>

                                        <div class="alert alert-warning">
                                                <?= $_SESSION['cambio'] ?>
                                        </div>


                                <?php endif; ?>


                                <h5>CAMBIE SU CONTRASEÑA</h5>
                                <hr>
                                <p>Guarde bien su información. En caso 
                                        de olvidar su contraseña, puede pedir al 
                                        administrador que la resetee, en cuyo caso será
                                        simplemente "CFE_app0".</p>
                        </div>

                        <div class="inputs">

                                <input type="text" name="actual" class="form-control" placeholder="CONTRASEÑA ACTUAL">
                                <input type="text" name="nueva" class="form-control" placeholder="CONTRASEÑA NUEVA">
                                <input type="text" name="nueva-2" class="form-control" placeholder="CONFIRME LA CONTRASEÑA">

                        </div>

                        <div class="form-button">
                                <input type="submit" class="btn btn-warning btn-block" value="ACEPTAR ">                                                                
                        </div>


                </form>


        </div>



</div>

<?php unset($_SESSION['cambio']); ?>
