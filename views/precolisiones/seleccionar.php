<?php if (isset($_SESSION['error_precol'])): ?>

        <div class="alert alert-warning" role="alert">
                <?= $_SESSION['error_precol'] ?>
        </div>

<?php endif; ?>


<div class="col-md-12 col-int" style="margin-bottom: 20px;">
        <?php foreach ($datos as $year => $valorYear): ?>
                <a href="#y<?= $year ?>" data-toggle="collapse" class="noHover-icon icon-container list-group-item list-group-item-action bg-dark" aria-expanded="false" class="dropdown-toggle">
                        <img src="<?= base_url ?>vendor/bootstrap/icons/inboxes.svg">
                        <h6><?= $year ?></h6>
                </a>

                <ul class="collapse list-unstyled" id="y<?= $year ?>">
                        <?php foreach ($datos[$year] as $mes => $valorMes): ?>
                                <li>
                                        <a href="#m<?= $year . $mes ?>" data-toggle="collapse" class="noHover-icon list-group-item list-group-item-action bg-dark sub-list icon-container" aria-expanded="false" class="dropdown-toggle">
                                                <img src="<?= base_url ?>vendor/bootstrap/icons/three-dots.svg">
                                                <h6><?= $mes ?></h6>
                                        </a>

                                        <ul class="collapse list-unstyled" id="m<?= $year . $mes ?>">

                                                <?php foreach ($datos[$year][$mes] as $csv): ?>

                                                        <li>
                                                                <a href="<?= base_url ?>precolisiones/descargar_ind&year=<?= $year ?>&mes=<?= $mes ?>&v=<?= $csv ?>" class="list-group-item list-group-item-action bg-dark sub-list2 icon-container">
                                                                        <img src="<?= base_url ?>vendor/bootstrap/icons/file-earmark-check.svg">
                                                                        <h6>ARCHIVO <?= $csv ?> </h6>
                                                                </a>
                                                        </li>

                                                <?php endforeach; ?>

                                        </ul>
                                </li>       
                        <?php endforeach; ?>
                </ul>              
        <?php endforeach; ?>

</div>






<form id="precol-select" action="<?= base_url ?>precolisiones/analisis" method="post">

        <div class="info col-md-12 col-int">
                <h5>SELECCIONE EL MES ANTERIOR Y EL MES ACTUAL</h5>
                <hr>
                <p>Seleccione un año y un mes en cada formulario. Al comparar los archivos, la aplicación asignará nombres en base a su elección.</p>
<!--                <table class="table table-bordered table-dark">
                        <tr>
                                <td><b>NUEVOS</b></td>
                                <td>Son los registros que aparecen en el "mes actual", pero que no lo hacen en el "mes anterior".</td>
                        </tr>
                        <tr>
                                <td><b>FALTANTES</b></td>
                                <td>Son los registros que aparecen en el "mes anterior", pero no lo hacen en el "mes actual".</td>
                        </tr>
                        <tr>
                                <td><b>CAMBIADOS</b></td>
                                <td>Son los registros que aparecen en ambos meses, pero cuyos permisionarios hayan de cambiado (esto engloba cualquier diferencia, tanto cambios de posición como desapariciones).</td>
                        </tr>
                </table>-->




        </div>

        <div class="col-md-12 col-int row">





                <div class="col-md-6 form">

                        <div class="info col-md-12">
                                <h5>MES ANTERIOR</h5>
                        </div>

                        <div class="inputs col-md-12">

                                <label for="past-year" class="label">AÑO: </label>

                                <select class="col-md-12" id="past-year" name="past-year">
                                        <?php foreach ($datos as $year => $valorYear): ?>
                                                <option value="<?= $year ?>">
                                                        <?= $year ?>
                                                </option>
                                        <?php endforeach; ?>
                                </select>  

                                <label for="past-mes" class="label">MES: </label>

                                <select class="col-md-12" id="past-mes" name="past-mes">
                                        <?php for ($i = 0; $i < 12; $i++): ?>
                                                <option <?php
                                                $mes = date('n') - 1;
                                                if ($mes == $i) {
                                                        echo 'selected';
                                                }
                                                ?> >
                                                                <?= meses[$i]; ?>
                                                </option>
                                        <?php endfor; ?>
                                </select>  

                                <label for="past-v">ARCHIVO: </label>

                                <select class="col-md-12" id="past-v" name="past-v">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <option>
                                                        <?= $i ?>
                                                </option>
                                        <?php endfor; ?>
                                </select>  




                        </div>






                </div>


                <div class="col-md-6 form">

                        <div class="info col-md-12">
                                <h5>MES ACTUAL</h5>
                        </div>

                        <div class="inputs col-md-12">

                                <label for="actual-year">AÑO: </label>

                                <select class="col-md-12" id="actual-year" name="actual-year">

                                        <?php foreach ($datos as $year => $valorYear): ?>
                                                <option value="<?= $year ?>">
                                                        <?= $year ?>
                                                </option>
                                        <?php endforeach; ?>

                                </select>  

                                <label for="actual-mes">MES: </label>

                                <select class="col-md-12" id="actual-mes" name="actual-mes">
                                        <?php for ($i = 0; $i < 12; $i++): ?>
                                                <option <?php
                                                $mes = date('n') - 1;
                                                if ($mes == $i) {
                                                        echo 'selected';
                                                }
                                                ?> >
                                                                <?= meses[$i]; ?>
                                                </option>
                                        <?php endfor; ?>
                                </select>  

                                <label for="actual-v">ARCHIVO: </label>

                                <select class="col-md-12" id="actual-v" name="actual-v">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <option value="<?= $i ?>">
                                                        <?= $i ?>
                                                </option>
                                        <?php endfor; ?>
                                </select>  




                        </div>

                </div>




        </div>

        <div class="form-button">
                <input type="submit" class="btn btn-primary btn-block" value="ANALIZAR ARCHIVOS">                                
        </div>

</form>

