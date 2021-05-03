<?php

require './models/archivos.php';
require './models/permisionario.php';

class precolisionesController {

        public function __construct() {
                if (!isset($_SESSION['user']) or isset($_SESSION['user']['admin'])) {
                        header('Location:' . base_url . 'login/');
                }
        }

        public function seleccionar() {

                $archivos = new archivos();
                $datos = $archivos->obtenerArchivos();

                require './views/precolisiones/seleccionar.php';

                if (isset($_SESSION['error_precol'])) {
                        unset($_SESSION['error_precol']);
                }
        }

        public function analisis() {
                if (isset($_POST)) {
                        $confirm = array();

                        $A_year = $_POST['actual-year'] ? $_POST['actual-year'] : false;
                        $A_mes = $_POST['actual-mes'] ? $_POST['actual-mes'] : false;
                        $A_v = $_POST['actual-v'] ? $_POST['actual-v'] : false;

                        $confirm = array();

                        $P_year = $_POST['past-year'] ? $_POST['past-year'] : false;
                        $P_mes = $_POST['past-mes'] ? $_POST['past-mes'] : false;
                        $P_v = $_POST['past-v'] ? $_POST['past-v'] : false;

                        $confirm[] = $A_year;
                        $confirm[] = $A_mes;
                        $confirm[] = $A_v;

                        $confirm[] = $P_year;
                        $confirm[] = $P_mes;
                        $confirm[] = $P_v;

                        $c = true;
                        foreach ($confirm as $value) {
                                if ($value == false) {
                                        $_SESSION['error_precol'] = 'Los datos no se recibieron correcamente';
                                        $c = false;
                                        break;
                                }
                        }

                        if ($P_year == $A_year and $P_mes == $A_mes and $P_v == $A_v) {
                                $c = false;
                                $_SESSION['error_precol'] = 'Seleccione dos archivos que sean diferentes';
                        }

                        $archivo = new archivos();
                        $actual = $archivo->comprobarRuta($A_year, $A_mes, $A_v);
                        $pasado = $archivo->comprobarRuta($P_year, $P_mes, $P_v);

                        if (!$actual or!$pasado) {
                                $c = false;
                                $_SESSION['error_precol'] = 'Seleccione archivos que existan en la aplicación, puede verlos aquí abajo';
                        } else {

                                $archivo->setActual($actual);
                                $archivo->setPasado($pasado);

//                                CREAR FUNCIÓN PARA GUARDAR ARCHIVOS EN CARPETA DEL USUARIO Y LEERLOS DESDE AHÍ
                                if (!$archivo->prepararAnalisis($_SESSION['user']['id'])) {
                                        $c = false;
                                        $_SESSION['error_precol'] = 'Error al copiar archivos';
                                }
                        }




                        if ($c == false) {
                                require './views/back.php';
                        } else {
                                require './views/precolisiones/analisis.php';
                        }
                } else {
                        require './views/back.php';
                }
        }

//        FUNCIONES QUE NO IMPRIMEN NADA POR PANTALLA


        public function descargar_ind() {
                if (isset($_GET['year']) and isset($_GET['mes']) and isset($_GET['v'])) {
                        $year = $_GET['year'];
                        $mes = $_GET['mes'];
                        $v = $_GET['v'];

                        $archivos = new archivos;
                        $archivos->descargar($year, $mes, $v);
                } else {
                        require './views/redirect.php';
                }
        }

        public function descarga_sin_filtro() {
                $archivos = new archivos();
                $archivos->descargarSinFiltro($_SESSION['user']['id']);
        }

        public function descarga_filtro() {
                $archivos = new archivos();
                $archivos->descargarConFiltro($_SESSION['user']['id']);
        }

//        FUNCIONES PARA LA API DE AJAX

        public function api_ajax() {
                if (isset($_POST['divs'])) {
                        $div = $_POST['divs'];
                        if ($div == 'false') {
                                $div = false;
                        }
                        $perm = new permisionario();
                        $divisiones = $perm->traerDivs($div);

                        if ($divisiones) {
                                $resultado = array();
                                foreach ($divisiones as $div) {
                                        $resultado[] = array(
                                            'nombre' => $div['nombre'],
                                            'div' => $div['div_id']
                                        );
                                }
                                $resultado = json_encode($resultado);
                                echo $resultado;
                        } else {
                                echo false;
                        }
                } elseif (isset($_POST['perm'])) {

                        $div = $_POST['perm'];
                        if ($div == 'false') {
                                $div = false;
                        }


                        $perm = new permisionario();
                        $permisionario = $perm->traerPerm($div);

                        if ($permisionario) {
                                $resultado = array();
                                foreach ($permisionario as $perm) {
                                        $resultado[] = array(
                                            'nombre' => $perm['nombre'],
                                            'id' => $perm['perm_id']
                                        );
                                }
                                $resultado = json_encode($resultado);
                                echo $resultado;
                        } else {
                                echo false;
                        }
                } elseif (isset($_POST['analizar'])) {
                        $archivo = new archivos();
                        $resultado = $archivo->ejecutarAnalisis($_SESSION['user']['id']);
                        //Resultado ya está convertido a json.
                        echo $resultado;
                }
        }

        public function api_filter() {
                if (isset($_POST['datos']) and isset($_POST['filas'])) {
                        $datos = $_POST['datos'];
                        $filas = $_POST['filas'];
                        $archivo = new archivos();
                        $resultado = $archivo->aplicarFiltro($datos, $filas, $_SESSION['user']['id']);
                        if ($resultado) {
                                echo 'true';
                        } else {
                                echo 'false';
                        }
                }else{
                  echo 'false';
                }
        }

}
