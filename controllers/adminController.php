<?php

require './models/archivos.php'; //MODELO DE LOS ARCHIVOS
require './models/admin.php';

class adminController {

        public function __construct() {
                if (!isset($_SESSION['user']['admin'])) {
                        header('Location:' . base_url . 'login/');
                }
        }

        public function usuarios() {
                $admin = new admin();
                $usuarios = $admin->usuarios();

                require './views/admin/usuarios.php';
        }

        public function archivos() {
                $archivos = new archivos;
                $datos = $archivos->obtenerArchivos();

                require './views/admin/archivos.php';
        }

//        COMIENZAN OPERACIONES QUE NO MUESTRAN NADA EN PANTALLA

        public function reset_pass() {
                if (isset($_GET['id']) and!empty($_GET['id'])) {
                        $id = $_GET['id'];
                        $admin = new admin();
                        if ($admin->resetear($id)) {
                                $_SESSION['admin']['reset'] = "Contraseña reseteada correctamente";
                        } else {
                                $_SESSION['admin']['reset'] = "Hubo un error al resetear la contraseña";
                        }
                        require './views/back.php';
                }
        }

        public function cambiar_edo() {

                if (isset($_GET['id']) and!empty($_GET['id'])) {
                        $id = $_GET['id'];
                        $admin = new admin();
                        if ($admin->cambiarEdo($id)) {
                                $_SESSION['admin']['edo'] = "Estado del usuario cambiado";
                        } else {
                                $_SESSION['admin']['edo'] = "Hubo un error al cambiar el estado";
                        }
                }

                require './views/back.php';
        }

        public function del_user() {

                if (isset($_GET['id']) and!empty($_GET['id'])) {
                        $id = $_GET['id'];
                        $admin = new admin();
                        if($admin->eliminar($id)){
                                $_SESSION['admin']['del'] = 'Usuario eliminado correctamente';
                        }else{                               
                                $_SESSION['admin']['del'] = 'Error al eliminar el usuario'; 
                        }    
                }                
                require './views/back.php';
                
        }

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

        public function subir_archivo() {

                if (count($_FILES) == 1 and $_FILES['archivo'] > 0) {
                        $año = isset($_POST['year']) ? $_POST['year'] : false;
                        $mes = isset($_POST['month']) ? $_POST['month'] : false;
                        $v = isset($_POST['version']) ? $_POST['version'] : false;

                        $archivos = new archivos;
                        if (!$archivos->subirAdmin($_FILES['archivo'], $año, $mes, $v)) {
                                require './views/redirect.php';
                        }
                }

                require './views/back.php';
        }

}
