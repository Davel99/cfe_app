<?php

class unsetController {

        public function user_sess() {
                unset($_SESSION['user']);
                header('Location:' . base_url);
        }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

