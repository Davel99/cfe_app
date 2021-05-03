<?php

class login {

        protected $db;

        public function __construct() {
                $this->db = database::connect();
        }

        public function log($username, $password) {
                $query = "SELECT * FROM usuarios WHERE username = '$username'";
                $user = $this->db->query($query);

                if ($user and $user->num_rows == 1) {
                        $usuario = $user->fetch_array();

                        if ($usuario['activo']) {
                                if (password_verify($password, $usuario['password'])) {
                                        return $usuario;
                                }else{
                                        $_SESSION['login']['error'] = '¡Contraseña incorrecta!';                                        
                                }
                        }else{
                                $_SESSION['login']['error'] = '¡Tu usuario no ha sido aprobado! Pide al administrador que active tu cuenta';
                        }
                }else{
                        $_SESSION['login']['error'] = '¡Usuario incorrecto!';  
                }
                return false;
        }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

