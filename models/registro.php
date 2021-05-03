<?php

class registro {

    protected $db;

    public function __construct() {
        $this->db = database::connect();
    }

    public function traerDiv() {
        $query = 'SELECT * FROM divisiones';
        $data = $this->db->query($query);

        return $data;
    }

    public function registrar($name, $username, $password, $div) {
        $name = $this->db->real_escape_string($name);
        $username = $this->db->real_escape_string($username);

        //HASHING DEL PASSWORD
        $pass = password_hash($this->db->real_escape_string($password), PASSWORD_BCRYPT, ['cost' => 4]);
        $query = "INSERT INTO usuarios VALUES(NULL, '$name', '$username', '$pass', '$div', 2, 0)";
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

