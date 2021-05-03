<div class="col-md-12 col-int row">

        <div class="col-md-6 form">

                <form action="<?= base_url ?>permisionarios/lista" method="post" id="perm-list">
                        <div class="info col-md-12">
                                <h5>SOLICITE LA LISTA DE PERMISIONARIOS</h5>
                                <p>Seleccione una división y oprima el botón "SOLCITAR LISTA". Abajo se imprimirá una tabla
                                        con los datos que solicitó. Se generará un archivo excel automáticamente.</p>

                        </div>

                        <div class="inputs col-md-12">

                                <label for="divisiones">SELECCIONE UNA DIVISIÓN: </label>

                                <select class="col-md-12" id="divisiones" name="div">
                                        <option value="null">
                                                TODAS LAS DIVISIONES
                                        </option>

                                        <?php foreach ($divisiones as $div): ?>

                                                <option value="<?= $div['div_id'] ?>">
                                                        <?= $div['div_id'] . ' - ' . $div['nombre'] ?>
                                                </option>                                        

                                        <?php endforeach; ?>


                                </select>                              


                        </div>

                        <div class="form-button">
                                <input type="submit" class="btn btn-primary btn-block" value="SOLICITAR LISTA">                                
                        </div>

                </form>


        </div>


        <div class="col-md-6 form">

                <form action="<?= base_url ?>permisionarios/descargar_lista" method="post" id="descarga-list">
                        <div class="info col-md-12">
                                <h5>DESCARGUE SU DOCUMENTO</h5>
                                <p>La tabla que usted ve abajo también ha sido cargada a un archivo excel. 
                                        Si desea descargarlo, pulse el botón "SOLICITAR EXCEL". </p>

                        </div>

                        <div class="inputs">

                                <input type="hidden" name="ruta" value="<?= $lista ?>">

                        </div>

                        <div class="form-button">
                                <input type="submit" class="btn btn-primary btn-block" value="SOLICITAR EXCEL">                                
                        </div>

                </form>


        </div>




</div>

<div class="form no-border">


        <div class="info">
                <h5> LISTA DE PERMISIONARIOS </h5>
                <hr>
                <p>A continuación se imprimen las tablas que usted solicita.</p>
        </div>

</div>

<div class="col-md-12 col-int" id="table-container">
        <table class="table table-bordered">
                <thead class="bg-success">
                        <tr>
                                <th scope="col">DIVISIÓN</th>
                                <th scope="col">PERMISIONARIO</th>
                                <th scope="col">ACRÓNIMO</th>
                                <th scope="col">PERMISO</th>

                        </tr>
                </thead>
                <tbody>
                        <?php if (!empty($permisionarios)): ?>
                                <?php foreach ($permisionarios as $perm): ?>
                                        <tr>
                                                <td><?= $perm['div_id'] ?></td>
                                                <td><?= $perm['nombre'] ?></td>
                                                <td><?= $perm['perm_id'] ?></td>
                                                <td><?= $perm['permiso'] ?></td>
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
