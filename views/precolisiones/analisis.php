<div class="loader">
        <h1 class="loadText">CARGANDO INFORMACIÓN SOLICITADA, POR FAVOR ESPERE...</h1>
</div>


<div class="row  col-md-12 col-int">

        <div class="col-md-6 form no-border text-center">
                <h6>Mes pasado</h6>
                <?= $P_year ?> / <?= $P_mes ?> / (versión): <?= $P_v ?> 

        </div>

        <div class="col-md-6 form no-border text-center">
                <h6>Mes actual</h6>
                <?= $A_year ?> / <?= $A_mes ?> / (versión): <?= $A_v ?> 

        </div>


</div>


<div class="col-md-12 col-int">

        <div class="row">

                <div class="col-md-6 col-int">

                        <div class="row form" id="divisiones">
                                <div class="info">
                                        <h5>DIVISIONES</h5>
                                        <p>La división que elija será la única que 
                                                se le muestre en la tabla abajo cuando active
                                                el filtro. Si NO desea filtrar por división (quiere verlas todas), 
                                                seleccione "SIN FILTRO".</p>
                                </div>

                                <div class="inputs">

                                        <label for="div_options">DIVISIÓN: </label>

                                        <select class="col-md-12" id="div_options" name="division">
                                                <option value="false">
                                                        SIN FILTRO
                                                </option>
                                        </select>  


                                </div>
                        </div>

                        <div class="row form" id="prelaciones">

                                <div class="info">
                                        <h5>PRELACIONES</h5>
                                </div>

                                <div class="row col-md-12 col-int">
                                        <div class="col-md-4">
                                                <label><input type="radio" name="eleccion" value="1" checked> Todas</label>

                                        </div>
                                        <div class="col-md-4">
                                                <label><input type="radio" name="eleccion" value="2">         Prelaciones</label>

                                        </div>
                                        <div class="col-md-4">
                                                <label><input type="radio" name="eleccion" value="3">         Sin Prelación</label>

                                        </div>
                                </div>




                        </div>

                </div>

                <div class="col-md-6 form" id="permisionarios">
                        <div class="info">
                                <h5>PERMISIONARIOS</h5>
                                <p>Seleccione los permisionarios que desee ver.
                                        Solo se mostrarán los registros donde aparezcan 
                                        los permisionarios que usted marque. Si no desea
                                        aplicar este filtro, deje todas las casillas en
                                        blanco.</p>
                        </div>

                        <div class="row col-md-12" id="checkboxesPerm">
                                <table class="table table-hover table-sm">
                                        <tr>
                                                <th scope="col">MARCAR TODOS LOS PERMISIONARIOS</th>
                                                <th scope="col"><input class="col-md-4"type="checkbox" name="dato-perm" id="dato-perm"></th>

                                        </tr>
                                </table>




                                <!--                        <div class="inputs">
                                
                                                                <label for="perm-check">DIVISIÓN: </label>
                                
                                                                <select class="col-md-12" id="perm-check" name="perm-check">
                                                                        <option value="false">
                                                                                perm #1
                                                                        </option>
                                                                </select>  
                                
                                                        </div>-->

                                <div class="scroll col-md-12 col-int">


                                        <table class="table table-bordered table-hover table-sm">
                                                <thead class="bg-success">
                                                        <tr>
                                                                <th scope="col">NOMBRE DEL PERMISIONARIO</th>
                                                                <th scope="col">ACRÓNIMO</th>
                                                                <th scope="col">CHECK</th>

                                                        </tr>
                                                </thead>

                                                <tbody id="perm_options">



                                                </tbody>
                                        </table>

                                </div>
                        </div>


                </div>

                <div class="row col-md-12 col-int">
                        <button class="btn btn-danger btn-block" id="filter">APLICAR FILTROS</button>
                </div>

                <div class="row" id="descargas">

                        <div class="col-md-6 form" id="descarga-sin-filtro">
                                <div class="row">
                                        <div class="info">
                                                <h5>DESCARGAR EXCEL SIN FILTRO</h5>
                                                <p>Oprima el botón abajo para descargar el excel generado sin ningún filtro aplicado.
                                                        Se generará una archivo con todas las tablas de información analizada.</p>
                                        </div>
                                </div>

                                <div class="row">

                                        <form action="<?= base_url ?>precolisiones/descarga_sin_filtro" method="post" class="col-md-12">
                                                <input type="submit" class="btn btn-outline-info btn-block" id="excel-1" value="DESCARGAR">
                                        </form>
                                </div>


                        </div>

                        <div class="col-md-6 form" id="descarga-con-filtro">

                                <div class="row">
                                        <div class="info">
                                                <h5>DESCARGAR EXCEL CON FILTRO</h5>
                                                <p>Oprima el botón abajo para descargar el excel generado con el último filtro que aplicó. Solo
                                                        se descargará la tabla que usted tenga activada.</p>
                                        </div>
                                </div>

                                <div class="row">
                                        <form action="<?= base_url ?>precolisiones/descarga_filtro" method="post" class="col-md-12">
                                                <input type="submit" class="btn btn-outline-info btn-block" id="excel-2" value="DESCARGAR">
                                        </form>
                                </div>




                        </div>


                </div>


                <div class="row col-md-12 col-int" id="botones">
                        <div class="col-md-3">
                                <button class="btn btn-warning btn-block" id="Nuevos" onclick="News()">NUEVOS</button>
                        </div>
                        <div class="col-md-3">
                                <button class="btn btn-warning btn-block" id="Faltantes" onclick="Falt()">FALTANTES</button>
                        </div>
                        <div class="col-md-3"F>
                                <button class="btn btn-warning btn-block" id="Cambiados" onclick="Camb()">CAMBIADOS</button>
                        </div>
                        <div class="col-md-3">
                                <button class="btn btn-warning btn-block" id="Actual" onclick="Actual()">DATOS DEL MES ACTUAL</button>
                        </div>
                </div>


                <div class="row table-responsive" id="table-container">

                        <table class="table table-bordered table-hover table-sm">
                                <thead class="bg-success">
                                        <tr>
                                                <th scope="col">RPU</th>
                                                <th scope="col">DIVISIÓN</th>
                                                <th scope="col">NOMBRE</th>
                                                <th scope="col">TFA</th>

                                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                                        <th scope="col">P<?= $i ?></th>
                                                <?php endfor; ?>


                                        </tr>
                                </thead>
                                <tbody id="verResultado">




                                </tbody>
                        </table>

                </div>









        </div>


