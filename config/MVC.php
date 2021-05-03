<?php

class mvc {

        protected $controller;
        protected $action;

        public function setController($controller) {
                if (!empty($controller) and $controller) {
                        $this->controller = $controller;
                        return true;
                } else {
                        $this->controller = false;
                        return false;
                }
        }

        public function setAction($action) {
                if (!empty($action) and $action) {
                        $this->action = $action;
                        return true;
                } else {
                        $this->action = false;
                        return false;
                }
        }

        public function getController() {
                $controller = $this->controller . 'Controller';
                return $controller;
        }

        public function getAction() {
                return $this->action;
        }

        public function isWeb() {
                if (!empty($this->controller) and!empty($this->action)) {
                        if (strpos($this->action, '_')) {
                                return false;
                        } else {
                                return true;
                        }
                }
        }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

