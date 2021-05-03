<?php

class permisionario {

        protected $db;

        public function __construct() {
                $this->db = database::connect();
        }

        public function traerDivs($div = false) {

                if ($div == false) {
                        $query = "SELECT * FROM divisiones";
                } else {
                        $query = "SELECT * FROM divisiones WHERE div_id = '$div'";
                }


                $divisiones = $this->db->query($query);

                if ($divisiones and $divisiones->num_rows > 0) {
                        return $divisiones;
                } else {
                        return false;
                }
        }

        public function traerPerm($div = false) {

                if ($div == false) {
                        $query = "SELECT * FROM permisionarios ORDER BY div_id";
                } else {
                        $query = "SELECT * FROM permisionarios WHERE div_id = '$div'";
                }

                $perm = $this->db->query($query);

                if ($perm and $perm->num_rows > 0) {
                        return $perm;
                } else {
                        return false;
                }
        }

        public function modificar($nombre, $id, $permiso, $id_base) {
                $query = "UPDATE permisionarios SET nombre = '$nombre', perm_id = '$id', permiso='$permiso' WHERE perm_id='$id_base'";
                if ($this->db->query($query)) {
                        return true;
                } else {
                        return false;
                }
        }

        public function eliminar($id) {

                if (!$id) {
                        return false;
                }

                $query = "DELETE FROM permisionarios WHERE perm_id = '$id'";
                if ($this->db->query($query)) {
                        return true;
                } else {
                        return false;
                }
        }

        public function insertar($div, $acron, $nombre, $permiso) {

                if (!$acron) {
                        return false;
                }

                if (!$nombre) {
                        return false;
                }

                $query = "INSERT INTO permisionarios VALUES('$acron', '$div', '$nombre', '$permiso')";
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

