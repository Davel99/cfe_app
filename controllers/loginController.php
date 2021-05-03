<?php

require './models/login.php';

class loginController {

        public function __construct() {
                if (isset($_SESSION['user']) and!isset($_SESSION['user']['admin'])) {
                        header('Location:' . base_url);
                } else if (isset($_SESSION['user']) and isset($_SESSION['user']['admin'])) {
                        header('Location:' . base_url . 'admin/');
                }
        }

        public function index() {
                require './views/login/index.php';
        }

        public function log_user() {
                $username = $_POST['usuario'] ? $_POST['usuario'] : false;
                $password = $_POST['password'] ? $_POST['password'] : false;

                $login = new login();
                $usuario = $login->log($username, $password);
                if ($usuario) {
                        
                        $_SESSION['user']['username'] = $usuario['username'];
                        $_SESSION['user']['name'] = $usuario['nombre'];
                        $_SESSION['user']['id'] = $usuario['user_id'];
                        $_SESSION['user']['div'] = $usuario['div_id'];
                        if ($usuario['rol_id'] == '1') {
                                $_SESSION['user']['admin'] = true;
                        }                        
                         header('Location:' . base_url);
                } else {
                        require './views/back.php';
                }


               
        }

}
