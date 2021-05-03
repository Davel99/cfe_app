<?php

class database {

    public static function connect() {

        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'cfe_perm_app';
        
        $db = new mysqli($host, $username, $password, $dbname);

        $db->query("SET NAMES 'utf8'");
        return $db;
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

