<div class="row">


        <div class="col-md-6">

                <div class="form no-border">
                        <form action="" method="post">

                                <div class="info">
                                        <h5>LISTA DE ARCHIVOS SUBIDOS</h5>
                                        <hr>
                                        <p>
                                                Estos son los archivos que usted ha subido.
                                        </p>
                                </div>

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
                                                                                        <a href="<?= base_url ?>admin/descargar_ind&year=<?= $year ?>&mes=<?= $mes ?>&v=<?= $csv ?>" class="list-group-item list-group-item-action bg-dark sub-list2 icon-container">
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

                        </form>

                </div>

        </div>



        <div class="col-md-6">

                <div class="form">
                        <form action="<?= base_url ?>admin/subir_archivo" method="post" enctype="multipart/form-data">

                                <div class="info">
                                        <h5>SUBA UN ARCHIVO</h5>
                                        <hr>
                                        <p>
                                                Asegúrese de especificar el año
                                                y el mes al que corresponde el
                                                archivo, así como la version
                                                (se admiten cinco). 
                                        </p>

                                        <p>
                                                <b>¡IMPORTANTE!</b>
                                                Solo se admiten archivos csv separados por "|".
                                                Si no sigue esta instrucción la
                                                aplicación no podrá procesar la información.
                                        </p>

                                </div>

                                <div class="inputs">
                                        <label class="label-form" for="year">AÑO: </label>

                                        <select class="col-md-12" name="year" id="year">
                                                <?php
                                                $añoBase = 2020;
                                                $añoActual = date('Y');

                                                for ($i = $añoBase; $i <= $añoActual; $i++):
                                                        ?>                                                                                      
                                                        <option>
                                                                <?= $i ?>
                                                        </option>
                                                <?php endfor; ?>
                                        </select>

                                        <label class="label-form" for="month">MES: </label>

                                        <select class="col-md-12" name="month" id="month">

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

                                        <label class="label-form" for="version">VERSIÓN: </label>

                                        <select class="col-md-12" name="version" id="version">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                        <option>
                                                                <?= $i ?>
                                                        </option>
                                                <?php endfor; ?>
                                        </select>

                                        <label class="label-form" for="archivo">SUBA SU ARCHIVO: </label>
                                        <input type="file" class="form-control" name="archivo" id="archivo">

                                </div>


                                <div class="form-button">
                                        <input type="submit" class="btn btn-info btn-block" value="SUBIR ARCHIVO">
                                </div>





                        </form>

                </div>

        </div>

</div>

