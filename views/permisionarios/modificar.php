<div class="col-md-12 col-int row">

        <div class="col-md-6 form">

                <?php if (isset($_SESSION['insert'])): ?>

                        <div class="alert alert-warning" role="alert">
                                <?= $_SESSION['insert'] ?>
                        </div>

                <?php endif; ?>

                <form action="<?= base_url ?>permisionarios/carga_i" method="post" id="perm-ind">
                        <div class="info col-md-12">
                                <h5>AGREGUE UN PERMISIONARIO A SU LISTA</h5>
                                <p>Rellene todos los campos abajo y oprima el botón "AGREGAR".</p>

                        </div>

                        <div class="inputs col-md-12">

                                <label for="divisiones">ACRÓNIMO DE LA DIVISIÓN: </label>

                                <select disabled class="col-md-12" id="divisiones">
                                        <?php foreach ($division as $div): ?>

                                                <option value="<?= $div['div_id'] ?>">
                                                        <?= $div['div_id'] . ' - ' . $div['nombre'] ?>
                                                </option>                                        

                                        <?php endforeach; ?>
                                </select>  

                                <br>
                                <br>

                                <input id="name" name="name" type="text" class="form-control" placeholder="NOMBRE DEL PERMISIONARIO">
                                <input id="acron" name="acron" type="text" class="form-control" placeholder="ACRÓNIMO DEL PERMISIONARIO">
                                <input id="tipo" name="permiso" type="text" class="form-control" placeholder="TIPO DE PERMISO">


                        </div>

                        <div class="form-button">
                                <input type="submit" class="btn btn-primary btn-block" value="AGREGAR">                                
                        </div>

                </form>


        </div>


        <div class="col-md-6 form">

                <?php if (isset($_SESSION['carga'])): ?>

                        <div class="alert alert-warning" role="alert">
                                <?= $_SESSION['carga'] ?>
                        </div>


                <?php endif; ?>

                <form id="perm-mas" action="<?= base_url ?>permisionarios/carga_m" method="post" enctype="multipart/form-data" >
                        <div class="info col-md-12">
                                <h5>CARGA MASIVA DE PERMISIONARIOS</h5>
                                <p> Si desea agregar muchos permisionarios, puede 
                                        hacerlo mediante un archivo excel. Es 
                                        importante que siga el formato que se 
                                        imprime aquí abajo. Es posible que algún 
                                        registro no sea admitido en caso de que 
                                        el acrónimo de la división no corresponda 
                                        a ninguna división registrada, revise 
                                        sus datos antes de enviarlos</p>

                        </div>

                        <div class="info col-md-12 table-responsive">
                                <table class="table table-bordered table-min table-sm">
                                        <thead class="bg-success">
                                                <tr>
                                                        <th scope="col">DIVISIÓN</th>
                                                        <th scope="col">PERMISIONARIO</th>
                                                        <th scope="col">ACRÓNIMO</th>
                                                        <th scope="col">PERMISO</th>

                                                </tr>
                                        </thead>
                                        <tbody>

                                                <tr>
                                                        <td>ACRÓNIMO</td>
                                                        <td>NOMBRE</td>
                                                        <td>ACRÓNIMO DEL PERMISIONARIO</td>
                                                        <td>TIPO DE PERMISO</td>
                                                </tr>





                                        </tbody>
                                </table>



                        </div>

                        <div class="inputs">

                                <label class="label" for="excel">INTRODUZCA SU ARCHIVO</label>

                                <input type="file" class="form-control" name="excel" id="excel">

                        </div>




                        <div class="form-button">
                                <input type="submit" class="btn btn-primary btn-block" value="CARGAR EXCEL">                                
                        </div>

                </form>


        </div>




</div>

<div class="form no-border col-md-12 col-int">
        <div class="info">
                <h5>MODIFIQUE LOS DATOS DE SUS PERMISIONARIOS</h5>
                <hr>
                <p>Si algún dato de su lista está desactualizado, diríjase al
                        registro correspondiente, cámbielo y oprima el botón
                        amarillo con el engranaje</p>
        </div>

</div>

<?php if (isset($_SESSION['mod'])): ?>

        <div class="alert alert-warning" role="alert">
                <?= $_SESSION['mod'] ?>
        </div>

<?php endif; ?>


<div class="col-md-12 col-int" id="table-container">


        <table class="table table-bordered table-hover table-sm">
                <thead class="bg-success">
                        <tr>
                                <th scope="col">ACRÓNIMO</th>
                                <th scope="col">PERMISIONARIO</th>                                
                                <th scope="col">PERMISO</th>
                                <th scope="col">MOD</th>

                        </tr>
                </thead>
                <tbody class="bg-light">

                        <?php if (!empty($permisionarios)): ?>
                                <?php foreach ($permisionarios as $reg): ?>
                                <form action="<?= base_url ?>permisionarios/mod_perm" method="post">
                                        <tr>
                                        <input type="hidden" name="id_base" value="<?= $reg['perm_id'] ?>">
                                        <td><input type="text" class="form-control" name="id" value="<?= $reg['perm_id'] ?>"></td>                                       
                                        <td><input type="text" class="form-control" name="nombre" value="<?= $reg['nombre'] ?>"></td>
                                        <td><input type="text" class="form-control" name="permiso" value="<?= $reg['permiso'] ?>"></td>
                                        <td>

                                                <button type="submit" class="btn btn-warning btn-block">
                                                        <img src="<?= base_url ?>vendor/bootstrap/icons/gear.svg" width="20" height="20">
                                                </button>
                                        </td>

                                        </tr>
                                </form>
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
unset($_SESSION['carga']);
unset($_SESSION['mod']);
unset($_SESSION['insert']);
?>