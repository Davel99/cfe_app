<?php

class admin {

        protected $db;

        public function __construct() {
                $this->db = database::connect();
        }

        public function usuarios() {
                $query = "SELECT * FROM usuarios WHERE rol_id='2'";
                $result = $this->db->query($query);

                if ($result and $result->num_rows > 0) {
                        return $result;
                } else {
                        return false;
                }
        }

        public function resetear($id) {
                $password = password_hash('CFE_app0', PASSWORD_BCRYPT, ['cost' => 4]);
                $query = "UPDATE usuarios SET password = '$password' WHERE user_id = '$id'";
                if ($this->db->query($query)) {
                        return true;
                } else {
                        return false;
                }
        }

        public function cambiarEdo($id) {
                $query = "SELECT activo FROM usuarios WHERE user_id = '$id'";
                $activo = $this->db->query($query);



                if ($activo and $activo->num_rows == 1) {
                        $resultado = $activo->fetch_array();

                        if ($resultado['activo'] == '1') {
                                $query = "UPDATE usuarios SET activo = b'0' WHERE user_id = '$id'";
                        } else {
                                $query = "UPDATE usuarios SET activo = b'1' WHERE user_id = '$id'";
                        }
                } else {

                        return false;
                }
                
                

                if ($this->db->query($query)) {
                        return true;
                } else {
                        return false;
                }
        }
        
        public function eliminar($id){
                
                $query = "DELETE FROM usuarios WHERE user_id = '$id'";
                if($this->db->query($query)){
                        return true;
                }else{
                        return false;
                }
                
        }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

