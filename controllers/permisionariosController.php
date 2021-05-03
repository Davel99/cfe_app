<?php

require './models/permisionario.php';
require './models/archivos.php';

class permisionariosController {

        public function __construct() {
                if (!isset($_SESSION['user']) or isset($_SESSION['user']['admin'])) {
                        header('Location:' . base_url . 'login/');
                }
        }

        public function index() {
                require './views/redirect.php';
        }

        public function lista() {
                $perm = new permisionario();
                $archivos = new archivos();

                if (isset($_POST['div'])) {
                        if ($_POST['div'] == 'null') {
                                $div = false;
                        } else {
                                $div = $_POST['div'];
                        }
                } else {
                        $div = false;
                }

                $permisionarios = $perm->traerPerm($div);
                $divisiones = $perm->traerDivs();
                $lista = $archivos->generarLista($permisionarios, $_SESSION['user']['id']);


                require './views/permisionarios/lista.php';

                unset($_SESSION['div']);
        }

        public function modificar() {
                $perm = new permisionario();
                $division = $perm->traerDivs($_SESSION['user']['div']);
                $permisionarios = $perm->traerPerm($_SESSION['user']['div']);
                require './views/permisionarios/modificar.php';
        }

        public function eliminar() {
                $perm = new permisionario();
                $permisionarios = $perm->traerPerm($_SESSION['user']['div']);
                require './views/permisionarios/eliminar.php';
        }

//        COMIENZAN ACCIONES QUE NO MUESTRAN NADA EN PANTALLA


        public function del_perm() {
                if (isset($_GET)) {

                        $id = $_GET['id'] ? $_GET['id'] : false;


                        $perm = new permisionario();
                        if ($perm->eliminar($id)) {
                                $_SESSION['del'] = "El permisionario de id '$id' ha sido eliminado correctamente";
                        } else {
                                $_SESSION['del'] = "El permisionario no pudo ser eliminado correctamente.";
                        }
                }

                require './views/back.php';
        }

        public function carga_i() {
                if (isset($_POST)) {

                        $acron = $_POST['acron'] ? $_POST['acron'] : false;
                        $permiso = $_POST['permiso'] ? $_POST['permiso'] : 'sin especificar';
                        $nombre = $_POST['name'] ? $_POST['name'] : 'sin especificar';

                        $perm = new permisionario();
                        if ($perm->insertar($_SESSION['user']['div'], $acron, $nombre, $permiso)) {
                                $_SESSION['insert'] = "El permisionario $nombre ha sido insertado correctamente";
                        } else {
                                $_SESSION['insert'] = "El permisionario de acrónimo: - $acron - , no pudo ser insertado correctamente. Verifique que su acrónimo no coincida con otros en su lista";
                        }
                }

                require './views/back.php';
        }

        public function carga_m() {
                if ($_FILES['excel'] > 0) {
                        $archivos = new archivos();
                        $path = $archivos->subirMasivo($_FILES['excel'], $_SESSION['user']['id']);
                        if ($path) {
                                $conteo = $archivos->cargaMasiva($path, $_SESSION['user']['div']);
                                if ($conteo != 0 OR $conteo != false) {
                                        $_SESSION['carga'] = "$conteo Permisionarios han sido insertados en la base de datos" .
                                                '. Si faltó alguno, verifique que los datos sean correctos y vuelva a intentarlo';
                                } else {
                                        $_SESSION['carga'] = 'No se pudieron leer los datos.'
                                                . ' Asegúrese de que los acrónimos de las divisiones existan y los acrónimos de sus permisionarios no se repitan con oros existentes.';
                                }
                        } else {
                                $_SESSION['carga'] = 'Hubo un error al subir el archivo';
                        }
                        $archivos->borrarArchivo($path);
                }

                require './views/back.php';
        }

        public function mod_perm() {
                if (isset($_POST)) {
                        $id_base = $_POST['id_base'] ? $_POST['id_base'] : false;
                        $id = $_POST['id'] ? $_POST['id'] : false;
                        $nombre = $_POST['nombre'] ? $_POST['nombre'] : false;
                        $permiso = $_POST['permiso'] ? $_POST['permiso'] : false;


                        $perm = new permisionario();
                        if ($perm->modificar($nombre, $id, $permiso, $id_base)) {
                                $_SESSION['mod'] = 'Cambios realizados correctamente en el permisionario ' . $nombre;
                        } else {
                                $_SESSION['mod'] = 'Ocurrió un error al realizar los cambios';
                        }
                }
                require './views/back.php';
        }

        public function descargar_lista() {
                if (isset($_POST['ruta'])) {
                        $ruta = $_POST['ruta'];
                        $archivo = new archivos();
                        $archivo->descargarLista($ruta);
                } else {
                        require './views/redirect.php';
                }
        }

}
