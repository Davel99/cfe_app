<?php

session_start();    

error_reporting(E_ALL ^ E_WARNING);
require 'autoload.php';
require 'config/db.php';
require 'config/constantes.php';
require 'config/MVC.php';

$mvc = new mvc();
$isWeb = $mvc->isWeb();
$cont = '';
$action = '';

if (isset($_GET['controller']) and!empty($_GET['controller'])) {
        $cont = $_GET['controller'];
        $mvc->setController($cont);

        $controller_name = $mvc->getController();

        if (class_exists($controller_name)) {

                $controller = new $controller_name();

                if (isset($_GET['action']) and!empty($_GET['action'])) {
                        $mvc->setAction($_GET['action']);
                        $action = $mvc->getAction();
                } else {
                        $mvc->setAction('index');
                        $action = $mvc->getAction();
                }


                if (method_exists($controller, $action)) {
                        if ($mvc->isWeb()) {
//#################################### H E A D E R #############################
                                require_once 'views/base/header.php';
//##############################################################################                                             
                        }
//#################################### R E Q U E S T ###########################
                        $controller->$action();
//##############################################################################
                } else {
                        header('Location:' . base_url);
                }
        } else {

                header('Location:' . base_url);
        }
} else {

                //################# M A I N   P A G E ###############################
                require_once 'views/base/header.php';
                require_once 'views/base/main.php';
                require_once 'views/base/footer.php';
                //###################################################################
}





if ($mvc->isWeb()) {
        //################# F O O T E R #####################################
        require_once 'views/base/footer.php';
        //###################################################################
}
?>
