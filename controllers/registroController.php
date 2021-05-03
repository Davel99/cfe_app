<?php

require './models/registro.php';
require 'validate.php';

class registroController {

    public function __construct() {
        if (isset($_SESSION['user']) and!isset($_SESSION['user']['admin'])) {
            header('Location:' . base_url);
        } else if (isset($_SESSION['user']) and isset($_SESSION['user']['admin'])) {
            header('Location:' . base_url . 'admin/');
        }
    }

    public function index() {
        //DATOS PARA LISTAR DIVISIONES
        $registro = new registro();
        if (!$datos = $registro->traerDiv()) {
            echo '<h1 class="text-center">Ha ocurrido un error al consultar información con la base de datos</h1>';
        } else {
            //SOLICITANDO VISTA
            require './views/registro/index.php';
        }
    }

    public function reg_user() {
        $name = $_POST['nombre'] ? $_POST['nombre'] : false;
        $username = $_POST['usuario'] ? $_POST['usuario'] : false;
        $password = $_POST['password'] ? $_POST['password'] : false;
        $pass_confirm = $_POST['password-confirm'] ? $_POST['password-confirm'] : false;
        $div = $_POST['division'] ? $_POST['division'] : false;

        if ($password != $pass_confirm) {
            $_SESSION['error']['igual'] = "Las contraseñas no coinciden, vuelve a intentarlo.";
        }

        $validate = new validate();
        if (!$validate->name($name)) {
            $_SESSION['error']['nombre'] = "Rellene correctamente el nombre. No se admiten números";
        }

        if (!$validate->username($username)) {
            $_SESSION['error']['usuario'] = "Relleno correctamente el usuario. No se admiten espacios en blanco.";
        }

        if (!$validate->password($password)) {
            $_SESSION['error']['password'] = "Password insuficiente. Es necesaria una letra mayúscula y un número al menos";
        }

        if (!$validate->verify()) {
            $_SESSION['error']['form'] = "Rellene correctamente el formulario";
        } else {
            //REGISTRAR USUARIO
            $registro = new registro();
            if ($registro->registrar($name, $username, $password, $div)) {
                $_SESSION['alert']['success'] = 'Su usuario ha sido registrado con éxito' .
                        ', podrá hacer login cuando su administrador active su cuenta';
            } else {
                $_SESSION['alert']['fatal'] = 'Hubo un eror al insertar sus datos en la ' .
                        'base de datos, pruebe con otro usuario y asegúrese de que la división marcada exista';
            }
        }


        require './views/back.php';
    }

}
