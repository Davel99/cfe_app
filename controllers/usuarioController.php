<?php

require './models/usuario.php';
require 'validate.php';

class usuarioController {

        public function __construct() {
                if (!isset($_SESSION['user'])) {
                        header('Location:' . base_url . 'login/');
                }
        }

        public function contraseña() {
                require './views/usuario/contraseña.php';
        }

        public function cambiar_pass() {
                if (isset($_POST['actual'])
                        and isset($_POST['nueva'])
                        and isset($_POST['nueva-2'])
                        and isset($_SESSION['user']['id'])) {

                        $pass = $_POST['actual'];
                        $nueva = $_POST['nueva'];
                        $confirm = $_POST['nueva-2'];

                        $validate = new validate();
                        ;



                        if ($validate->password($nueva)) {

                                if ($nueva == $confirm) {
                                        $user = new usuario();
                                        $r = $user->comprobarPassword($pass, $_SESSION['user']['id'], $_SESSION['user']['username']);

                                        if ($r) {
                                                if ($user->cambiarPassword($nueva, $_SESSION['user']['id'])) {
                                                        $_SESSION['cambio'] = 'Cambio realizado correctamente';
                                                } else {
                                                        $_SESSION['cambio'] = 'Hubo un error al hacer el cambio';
                                                }
                                        } else {
                                                $_SESSION['cambio'] = 'Su password no coincide';
                                        }
                                } else {
                                        $_SESSION['cambio'] = 'Las contraseñas no coinciden';
                                }
                        } else {
                                $_SESSION['cambio'] = 'Ingrese una contraseña con al menos una mayúscula y un número';
                        }
                }
                require './views/back.php';
        }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

