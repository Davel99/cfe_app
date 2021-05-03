<?php

function app_autoload($class){
  $path = 'controllers/'.$class.'.php';
  if(file_exists($path)){
    require_once $path;
  }

}

spl_autoload_register('app_autoload');


 ?>
