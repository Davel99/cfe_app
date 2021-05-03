<?php

class usuario {

        protected $db;

        public function __construct() {
                $this->db = database::connect();
        }

        public function comprobarPassword($password, $id, $username) {
                $query = "SELECT * FROM usuarios WHERE username = '$username'";
                $user = $this->db->query($query);

                if ($user and $user->num_rows == 1) {
                        $usuario = $user->fetch_array();
                        if (password_verify($password, $usuario['password'])) {
                                return true;
                        } else {
                                return false;
                        }
                } else{
                        return false;
                }
        }

        public function cambiarPassword($pass, $id) {

                $password = password_hash($this->db->real_escape_string($pass), PASSWORD_BCRYPT, ['cost' => 4]);
                $query = "UPDATE usuarios SET password = '$password' WHERE user_id = '$id'";
                
                if ($this->db->query($query)) {
                        return true;
                } else {
                        return false;
                }
        }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

