<?php

require 'php-office.php';

class archivos {

        protected $db;
        protected $actual;
        protected $pasado;

        public function __construct() {
                $this->db = database::connect();
        }

//        FUNCIONES SET

        public function setActual($actual) {
                $this->actual = $actual;
        }

        public function setPasado($pasado) {
                $this->pasado = $pasado;
        }

//        OTRAS FUNCIONES
        public function descargarLista($ruta) {

                if (!empty($ruta) && file_exists($ruta)) {
                        $numdia = date("d"); //Obtengo el número del día con respecto al mes
                        $mes = date("F"); //Obtengo el número del mes
                        header("Content-Description: File Transfer");
                        header("Content-Transfer-Encoding:binary");
                        header('Expires: 0');
                        header("Cache-Control: must-revalidate");
                        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($ruta));
                        header("Content-Disposition: attachment; filename=Lista-($mes-$numdia).xlsx");
                        header('Cache-Control: max-age=0');

                        readfile($ruta);
                        $ruta->save("php//output");
                        return true;
                } else {
                        return false;
                }
        }

        public function descargarSinFiltro($id) {
                $ruta = "./assets/uploads/$id/Analisis.xlsx";
                if (file_exists($ruta)) {
                        $numdia = date("d"); //Obtengo el número del día con respecto al mes
                        $mes = date("F"); //Obtengo el número del mes
                        header("Content-Description: File Transfer");
                        header("Content-Transfer-Encoding:binary");
                        header('Expires: 0');
                        header("Cache-Control: must-revalidate");
                        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($ruta));
                        header("Content-Disposition: attachment; filename=AnalisisGeneral-($mes-$numdia).xlsx");
                        header('Cache-Control: max-age=0');

                        readfile($ruta);
                        $ruta->save("php//output");
                        return true;
                } else {
                        return false;
                }
        }

        public function descargarConFiltro($id) {
                $ruta = "./assets/uploads/$id/datosFiltrados.xlsx";
                if (file_exists($ruta)) {
                        $numdia = date("d"); //Obtengo el número del día con respecto al mes
                        $mes = date("F"); //Obtengo el número del mes
                        header("Content-Description: File Transfer");
                        header("Content-Transfer-Encoding:binary");
                        header('Expires: 0');
                        header("Cache-Control: must-revalidate");
                        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($ruta));
                        header("Content-Disposition: attachment; filename=datosFiltrados-($mes-$numdia).xlsx");
                        header('Cache-Control: max-age=0');

                        readfile($ruta);
                        $ruta->save("php//output");
                        return true;
                } else {
                        return false;
                }
        }

        public function comprobarRuta($year, $mes, $v) {
                $ruta = "./assets/uploads/admin/$year/$mes/$v";
                if (file_exists($ruta)) {
                        return $ruta;
                } else {
                        return false;
                }
        }

        public function prepararAnalisis($id) {
                $actual = $this->actual;
                $pasado = $this->pasado;

                if (!file_exists("./assets/uploads/$id")) {
                        mkdir("./assets/uploads/$id", 0777, true);
                }

                $ruta_act = "./assets/uploads/$id/actual.csv";
                $ruta_pas = "./assets/uploads/$id/pasado.csv";

                $act = copy($actual, $ruta_act);
                $pas = copy($pasado, $ruta_pas);

                if ($act and $pas) {
                        return true;
                } else {
                        return false;
                }
        }

        public function ejecutarAnalisis($id) {
                $actual = "./assets/uploads/$id/actual.csv";
                $pasado = "./assets/uploads/$id/pasado.csv";

                $Guardar = "./assets/uploads/$id/Analisis.xlsx";

                if (!is_readable($actual) or!is_readable($pasado)) {
                        return false;
                }
                //GUARDO DATOS DEL ARCHIVO DEL MES ACTUAL
                $archivo = fopen($actual, "r");
                $colRPUsACT = array();
                $colNombresACT = array();
                $colPermACT = array();
                $totalACT = array();
                //GESTIONO DATOS OBTENIDOS EN EL ARCHIVO CSV
                while (($datos = fgetcsv($archivo, 0, "|")) == TRUE) {

                        $totalACT[] = array($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7], $datos[8], $datos[9], $datos[10], $datos[11], $datos[12], $datos[13]);
                        $colRPUsACT[] = $datos[0];
                        $colNombresACT[] = $datos[2];
                        $colPermACT[] = array($datos[4], $datos[5], $datos[6], $datos[7], $datos[8], $datos[9], $datos[10], $datos[11], $datos[12], $datos[13]);
                }


                //GUARDO DATOS DEL ARCHIVO DEL MES PASADO
                $archivo2 = fopen($pasado, "r");
                $colRPUsPAS = array();
                $colNombresPAS = array();
                $colPermPAS = array();
                $totalPAS = array();

                //GESTIONO DATOS OBTENIDOS EN EL ARCHIVO CSV
                while (($datos = fgetcsv($archivo2, 0, "|")) == TRUE) {

                        $totalPAS[] = array($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7], $datos[8], $datos[9], $datos[10], $datos[11], $datos[12], $datos[13]);
                        $colRPUsPAS[] = $datos[0];
                        $colNombresPAS[] = $datos[2];
                        $colPermPAS[] = array($datos[4], $datos[5], $datos[6], $datos[7], $datos[8], $datos[9], $datos[10], $datos[11], $datos[12], $datos[13]);
                }




                $regNew = array(); //Aquí guardarás todos los registros nuevos del mes (no aparecen en el anterior)
                $regFaltantes = array(); //Aquí guardarás los registros faltentes (no aparecen en el mes actual)
                $regPAS = array(); //Aquí guardarás todos los registros que coincidan del mes pasado
                $regACT = array(); //Aquí guardarás todos los registros que coincidan del mes actual
//CALCULANDO REGISTROS NUEVOS, COMPARANDO MES ACTUAL CON EL ANTERIOR
                for ($i = 1; $i < count($colRPUsACT); $i++) { //RECORRO EL COMPARADO (MES ACTUAL)
                        //Se está comparando cada registro del mes actual, con el mes anterior.
                        for ($x = 1; $x < count($colRPUsPAS); $x++) { //RECORRO EL COMPARADOR (MES ANTERIOR)
                                if ($colRPUsPAS[$x] !== $colRPUsACT[$i]) {//SI EL COMPARADOR Y EL COMPARADO NO SON IGUALES ENTONCES CONTINÚA EL CICLO
                                        if ($x == (count($colRPUsPAS)) - 1) {//SI SE LLEGA AL FINAL Y NO SE ENCONTRÓ UN IGUAL, ENTONCES REGISTRA COMO NUEVO.
                                                $regNew[] = $i;
                                        }
                                } else { //CUANDO LOS REGISTROS SEAN IGUALES, GUARDARLO Y SALIR DEL BUCLE PARA AHORAR TIEMPO
                                        $regACT[] = $i;
                                        $regPAS[] = $x;
                                        break;
                                }
                        }
                }



// INVERTIR VALORES DE CICLOS ANTERIORES PARA DETECTAR LOS FALTANTES
                for ($i = 1; $i < count($colRPUsPAS); $i++) { //RECORRO EL COMPARADO (MES ANTERIOR)
                        //Se está comparando cada registro del mes anterior, con el mes actual. Esto para  detectar faltantes.
                        for ($x = 1; $x < count($colRPUsACT); $x++) { //RECORRO EL COMPARADOR (MES ACTUAL)
                                if ($colRPUsACT[$x] !== $colRPUsPAS[$i]) {//SI EL COMPARADOR Y EL COMPARADO NO SON IGUALES ENTONCES CONTINÚA EL CICLO
                                        if ($x == (count($colRPUsACT)) - 1) {//SI SE LLEGA AL FINAL Y NO SE ENCONTRÓ UN IGUAL, ENTONCES REGISTRA COMO FALTANTE.
                                                $regFaltantes[] = $i;
                                        }
                                } else { //CUANDO LOS REGISTROS SEAN IGUALES SALIR DEL BUCLE PARA AHORAR TIEMPO
                                        break;
                                }
                        }
                }




//CALCULA CASOS EN QUE PERMISIONARIOS CAMBIAN DE LUGAR
                $regErroresACT = array();
                $regErroresPAS = array();
                for ($i = 0; $i < count($regACT); $i++) {
                        //Recorro registros donde hubo coincidencias
                        $reg = $regACT[$i]; //Guardo el número de registro en $reg
                        $reg2 = $regPAS[$i];
                        $AUX = $colPermACT[$reg]; // Guardo en AUX el array de permisonarios en ese registro

                        for ($x = 0; $x < count($AUX); $x++) {
                                $actual = $colPermACT[$reg];
                                $pasado = $colPermPAS[$reg2];

                                if ($actual[$x] !== $pasado[$x]) {
                                        $regErroresACT[] = $reg;
                                        $regErroresPAS[] = $reg2;
                                        break;
                                }
                        }
                } //FIN ciclo FOR


                require './vendor/autoload.php';
                $spread = new PhpOffice\PhpSpreadsheet\Spreadsheet();
                $spread //Genero características del documento
                        ->getProperties()
                        ->setCreator("JD")
                        ->setTitle("Archivo generado por consulta")
                        ->setDescription("Documento generado para APP CFE. Prácticas profesionales.");


                //COMENZAMOS ASIGNACIÓN DE VALORES. Columnas van del 0 al 13, son catorce en total.
                $abc = ['A', // 0 Corresponde al RPU
                    'B', // 1 Corresponde a la división
                    'C', // 2 Corresponde al nombre del cliente
                    'D', // 3 Corresponde al código o número indicado
                    'E', // 4 De aquí en adelante son los diez permisionarios
                    'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N'];


                $office = new officedoc();


                //ASIGNAMOS A CADA HOJA SUS ENCABEZADOS
                $hojaNuevos = $spread->getActiveSheet();        //Obtengo hoja actual
                $hojaNuevos->setTitle("RPUs Nuevos");           //Asigno título a la hoja
                $hojaNuevos = $office->encabezados($hojaNuevos);      //Establezco encabezados de la Hoja
                $hojaNuevos = $office->formatear($hojaNuevos, $abc); //Hago que las columnas adquieran tamaño automático

                $hojaFaltantes = $spread->createSheet();        //Obtengo hoja actual
                $hojaFaltantes->setTitle("RPUs Faltantes");           //Asigno título a la hoja
                $hojaFaltantes = $office->encabezados($hojaFaltantes);      //Establezco encabezados de la Hoja
                $hojaFaltantes = $office->formatear($hojaFaltantes, $abc); //Hago que las columnas adquieran tamaño automático

                $hojaDiferencias = $spread->createSheet();        //Obtengo hoja actual
                $hojaDiferencias->setTitle("Perm cambiados");           //Asigno título a la hoja
                $hojaDiferencias = $office->encabezados($hojaDiferencias);      //Establezco encabezados de la Hoja
                $hojaDiferencias = $office->formatear($hojaDiferencias, $abc); //Hago que las columnas adquieran tamaño automático
                //GENERANDO HOJA DE NUEVOS
                $row = 2; //INDICANDO LA FILA DONDE VAMOS A COMENZAR
                for ($i = 0; $i < count($regNew); $i++) {
                        //Los registros nuevos corresponden al mes actual, por eso uso el total de registros ACT.
                        $AUX = $regNew[$i];     //Guardo el registro contenido en mi array de nuevos.
                        $REG = $totalACT[$AUX]; //Guardo el array contenido en el total de registros
                        for ($x = 0; $x < count($REG); $x++) {
                                $letra = $abc[$x];    //Guardo la letra contenida en mi array $abc
                                $CELL = $letra . $row;  //Combino la letra y la fila para obtener coordinada de la celda
                                $dato = $REG[$x];     //Obtengo el dato ubicado en el array de datos de los registros.
                                $hojaNuevos->setCellValueExplicit($CELL, $dato, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                        }
                        $row++;
                }


                //GENERANDO HOJA DE FALTANTES.
                $row = 2; //INDICANDO LA FILA DONDE VAMOS A COMENZAR
                for ($i = 0; $i < count($regFaltantes); $i++) {
                        //Los registros faltantes corresponden al mes anterior, por eso uso el total de registros PAS
                        $AUX = $regFaltantes[$i];   //Guardo el registro contenido en mi array de Faltantes
                        $REG = $totalPAS[$AUX];     //Guardo el array contenido en el total de registros
                        for ($x = 0; $x < count($REG); $x++) {
                                $letra = $abc[$x];    //Guardo la letra contenida en mi array $abc
                                $CELL = $letra . $row;  //Combino la letra y la fila para obtener coordinada de la celda
                                $dato = $REG[$x];     //Obtengo el dato ubicado en el array de datos de los registros.
                                $hojaFaltantes->setCellValueExplicit($CELL, $dato, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                        }
                        $row++;
                }


                //GENERANDO HOJA DE FALTANTES.
                $row = 2; //INDICANDO LA FILA DONDE VAMOS A COMENZAR
                for ($i = 0; $i < count($regErroresACT); $i++) {
                        //Para visualizar errores tenemos que alternar ente registros del mes actual y anterior.
                        $AUXact = $regErroresACT[$i];   //Guardo registro de errores del mes actual
                        $AUXpas = $regErroresPAS[$i];   //Guardo registro de errores del mes anterior
                        $REGact = $totalACT[$AUXact];   //Obtengo datos del registro del mes actual
                        $REGpas = $totalPAS[$AUXpas];   //Obtengo datos del registro del mes anterior
                        for ($x = 0; $x < count($REGact); $x++) {
                                //MES ACTUAL
                                $letra = $abc[$x];
                                $CELL = $letra . $row;
                                $dato = $REGact[$x];
                                $hojaDiferencias->setCellValueExplicit($CELL, $dato, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                                $hojaDiferencias->setCellValue('O' . $row, "MES ACTUAL");
                        }
                        $row++;

                        for ($x = 0; $x < count($REGpas); $x++) {
                                //MES ANTERIOR
                                $letra = $abc[$x];
                                $CELL = $letra . $row;
                                $dato = $REGpas[$x];
                                $hojaDiferencias->setCellValueExplicit($CELL, $dato, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                                $hojaDiferencias->setCellValue('O' . $row, "MES ANTERIOR");
                        }

                        $row++;
                        $row++;
                }

                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spread);
                $writer->save($Guardar);


                //REINICIO VALORES
                $spread = 0;
                $writer = 0;



                //CREANDO DATOS PARA ENVIARSE A JAVASCRIPT.
                $json = array();            //Aquí se enviará la información
                $datosNuevos = array();     //Aquí se guardarán los registros de los registros de los nuevos
                $datosFaltantes = array();  //Aquí se guardarán los registros de los faltantes
                $datosPermACT = array();    //Aquí se guardarán los permisionarios cambiados actuales
                $datosPermPAS = array();    //Aquí se guardarán los permisionarios cambiados pasados
                $datosMesActu = array();    //Aquí se guardarán los datos del mes actual
//OBTENIENDO REGISTROS DE LOS RPUS NUEVOS.
                for ($i = 0; $i < count($regNew); $i++) {
                        $num = $regNew[$i];
                        $datosNuevos[] = $totalACT[$num];
                }
                $json[] = $datosNuevos;


//OBTENIENDO REGISTROS DE LOS RPUS FALTANTES
                for ($i = 0; $i < count($regFaltantes); $i++) {
                        $num = $regFaltantes[$i];
                        $datosFaltantes[] = $totalPAS[$num];
                }
                $json[] = $datosFaltantes;


//OBTENIENDO REGISTROS DE LOS RPUS ACTUALES CON CAMBIOS
                for ($i = 0; $i < count($regErroresACT); $i++) {
                        $num = $regErroresACT[$i];
                        $datosPermACT[] = $totalACT[$num];
                }
                $json[] = $datosPermACT;

//OBTENIENDO REGISTROS DE LOS RPUS PASADOS CON CAMBIOS
                for ($i = 0; $i < count($regErroresPAS); $i++) {
                        $num = $regErroresPAS[$i];
                        $datosPermPAS[] = $totalPAS[$num];
                }
                $json[] = $datosPermPAS;

                for ($i = 1; $i < count($totalACT); $i++) {
                        $datosMesActu[] = $totalACT[$i];
                }

                $json[] = $datosMesActu;


                $jsonstring = json_encode($json);

                echo $jsonstring;
        }

        public function aplicarFiltro($datos, $filas, $id) {
                $Guardar = "./assets/uploads/$id/datosFiltrados.xlsx";

                if (!file_exists("./assets/uploads/$id")) {
                        mkdir("./assets/uploads/$id", 0777, true);
                }


                if (!$filas or empty($filas)) {
                        return false;
                }

                require './vendor/autoload.php';

                $spread = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
                $office = new officedoc();

                $spread //Genero características del documento
                        ->getProperties()
                        ->setCreator("Joel David Gómez Ortega")
                        ->setTitle("Archivo")
                        ->setDescription("Documento generado para APP CFE. Prácticas profesionales. ICEST 2000 IM");

                $abc = ['A', // 0 Corresponde al RPU
                    'B', // 1 Corresponde a la división
                    'C', // 2 Corresponde al nombre del cliente
                    'D', // 3 Corresponde al código o número indicado
                    'E', // 4 De aquí en adelante son los diez permisionarios
                    'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O'];


                //ASIGNAMOS A CADA HOJA SUS ENCABEZADOS
                $hojaUNO = $spread->getActiveSheet();           //Obtengo hoja actual
                $hojaUNO->setTitle("Datos");                    //Asigno título a la hoja
                $hojaUNO = $office->encabezados($hojaUNO);      //Establezco encabezados de la Hoja
                $hojaUNO = $office->formatear($hojaUNO, $abc);  //Hago que las columnas adquieran tamaño automático
                //GENERANDO HOJA DE NUEVOS
                $row = 2; //INDICANDO LA FILA DONDE VAMOS A COMENZAR
                for ($i = 0; $i < count($filas); $i++) {

                        $fila = $filas[$i];     //Guardo el registro contenido en mi array de nuevos.
                        for ($x = 0; $x < count($fila); $x++) {
                                $letra = $abc[$x];    //Guardo la letra contenida en mi array $abc
                                $CELL = $letra . $row;  //Combino la letra y la fila para obtener coordinada de la celda
                                $dato = $fila[$x];     //Obtengo el dato ubicado en el array de datos de los registros.
                                $hojaUNO->setCellValueExplicit($CELL, $dato, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                        }
                        $row++;
                }


                if (!empty($datos)) {


                        $numRows = $hojaUNO->getHighestRow();   //Adquiero el total de filas

                        for ($i = 2; $i <= $numRows; $i++) {

                                /*    PINTAR 'DU' DE ROJO
                                  $valor = $hojaUNO->getCell("B".$i)->getValue();
                                  $celda = "B".$i;
                                  if($valor == "DU"){
                                  $hojaUNO->getStyle($celda)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');
                                  }
                                 */

                                for ($y = 4; $y < count($abc); $y++) {
                                        $celda = $abc[$y] . $i;
                                        $valor = $hojaUNO->getCell($celda)->getValue();

                                        if (!empty($valor)) {
                                                $acronimo = $valor[1] . $valor[2] . $valor[3];
                                                for ($x = 0; $x < count($datos); $x++) {
                                                        if ($acronimo == $datos[$x]) {

                                                                $hojaUNO->getStyle($celda)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');
                                                        }
                                                }
                                        }
                                }
                        }
                } //FIN DEL EMPTY DE DATOS
                //GUARDAR DATOS

                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spread);
                $writer->save($Guardar);
                return true;
        }

        public function descargar($year, $mes, $v) {

                $ruta = "./assets/uploads/admin/$year/$mes/$v";
                if (!empty($ruta) && file_exists($ruta)) {
//                        $dia = date("D"); //Obtengo el nombre del día
//                        $numdia = date("d"); //Obtengo el número del día con respecto al mes
//                        $mes = date("F"); //Obtengo el número del mes
                        header("Content-Description: File Transfer");
                        header("Content-Transfer-Encoding:binary");
                        header('Expires: 0');
                        header("Cache-Control: must-revalidate");
                        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($ruta));
                        header("Content-Disposition: attachment; filename=CSV-($year-$mes-$v).csv");
                        header('Cache-Control: max-age=0');

                        readfile($ruta);
                        $ruta->save("php//output");
                        return true;
                } else {
                        return false;
                }
        }

        public function obtenerArchivos() {
                $path = './assets/uploads/admin';
                $dir = opendir($path);

                $archivos = array();

                while ($años = readdir($dir)) {

                        if (($años == ".") or ($años == ".."))
                                continue;

                        $dirYear = "$path/$años";
                        if (is_dir($dirYear)) {
                                $dirMes = opendir($dirYear);

                                while ($meses = readdir($dirMes)) {

                                        if (($meses == ".") or ($meses == ".."))
                                                continue;

                                        $dirMeses = "$dirYear/$meses";
                                        if (is_dir($dirMeses)) {

                                                $dirCSV = opendir($dirMeses);

                                                while ($csv = readdir($dirCSV)) {
                                                        if (($csv == ".") or ($csv == ".."))
                                                                continue;

                                                        $filename = "$dirMeses/$csv";
                                                        if (is_file($filename)) {

                                                                $archivos[$años][$meses][] = $csv;
                                                        }
                                                }
                                                closedir();
                                        }
                                }
                                closedir();
                        }
                }
                closedir();



                return $archivos;
        }

        public function subirAdmin($file, $año, $mes, $v) {

                if (!$año or!$mes or!$v) {
                        return false;
                }


                if (!file_exists('./assets/uploads/admin')) {
                        mkdir('./assets/uploads/admin', 0777, true);
                }
                if (!file_exists("./assets/uploads/admin/$año")) {
                        mkdir('./assets/uploads/admin/' . $año, 0777, true);
                }
                if (!file_exists("./assets/uploads/admin/$año/$mes")) {
                        mkdir('./assets/uploads/admin/' . $año . '/' . $mes, 0777, true);
                }

                $path = "./assets/uploads/admin/$año/$mes/";
                $fichero = $path . $v;

                move_uploaded_file($file['tmp_name'], $fichero);

                return true;
        }

        public function generarLista($permisionarios, $id) {
                require './vendor/autoload.php';

                $spread = new PhpOffice\PhpSpreadsheet\Spreadsheet();
                $spread //Genero características del documento
                        ->getProperties()
                        ->setCreator("Joel David Gómez Ortega")
                        ->setTitle("Archivo")
                        ->setDescription("Documento generado para APP CFE. Prácticas profesionales. ICEST 2000 IM");

                $abc = ['A', 'B', 'C', 'D'];

                $hoja = $spread->getActiveSheet();
                $hoja->setTitle('Lista del usuario');

                $hoja->setCellValue('A1', 'DIV');
                $hoja->setCellValue('B1', 'NOMBRE DEL PERMISIONARIO');
                $hoja->setCellValue('C1', 'ACRÓNIMO DEL PERMISIONARIO');
                $hoja->setCellValue('D1', 'TIPO DE PERMISO');

                for ($i = 0; $i < count($abc); $i++) {
                        $hoja->getColumnDimension($abc[$i])->setAutoSize(true);
                }

                $row = 2;

                foreach ($permisionarios as $perm) {
                        foreach ($perm as $key => $value) {
                                if ($key == 'div_id') {
                                        $le = 0;
                                } elseif ($key == 'nombre') {
                                        $le = 1;
                                } elseif ($key == 'perm_id') {
                                        $le = 2;
                                } else {
                                        $le = 3;
                                }

                                $cell = $abc[$le] . $row;
                                $hoja->setCellValueExplicit($cell, $value, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                        }
                        $row++;
                }




                $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spread);

                $ruta = './assets/uploads';
                $carpeta = "$ruta/$id";

                if (!file_exists($carpeta)) {
                        mkdir($carpeta, 0777, true);
                }

                $archivo = "$carpeta/lista.xlsx";

                $writer->save($archivo);
                return $archivo;
        }

        public function subirMasivo($file, $id) {
                $directorio = './assets/uploads/';
                $carpeta = $directorio . $id;

                if (!file_exists($carpeta)) {
                        mkdir($carpeta, 0777, true);
                }

                $fichero = $carpeta . '/cargaMasiva.xlsx';

                if (move_uploaded_file($file['tmp_name'], $fichero)) {
                        return $fichero;
                } else {
                        return false;
                }
        }

        public function borrarArchivo($path) {
                if (unlink($path)) {
                        return true;
                } else {
                        return false;
                }
        }

        public function cargaMasiva($path, $div_id, $num = false) {
//cambiar $num a 'true' si se quiere subir masivamente TODOS los perm de TODAS las divisiones
//LEER CON PHP EXCEL;
                require './vendor/autoload.php';

                $doc = PhpOffice\PhpSpreadsheet\IOFactory::load($path);

                if ($doc->getSheetCount() != 1) {
                        return false;
                }

                $doc->setActiveSheetIndex(0);
                $hojaActual = $doc->getActiveSheet();
                $numRows = $hojaActual->getHighestRow();

                $registros = $numRows - 1;

                $abc = ['A', 'B', 'C', 'D'];
                $cols = array(array());


                foreach ($abc as $letra) {
                        $ctr = 0;
                        for ($i = 2; $i <= $numRows; $i++) {
                                $celda = $hojaActual->getCell($letra . $i);
                                $valor = $celda->getValue();
                                $cols[$letra][$ctr] = $valor;
                                $ctr++;
                        }
                }

                $conteo = 0;
                for ($i = 0; $i < $registros; $i++) {
                        if ($num == true) {
                                $div = $cols['A'][$i];
                        } else {
                                $div = $div_id;
                        }

                        $nombre = $cols['B'][$i];
                        $acron = $cols['C'][$i];
                        $tipo = $cols['D'][$i];

                        $query = "INSERT INTO permisionarios VALUES('$acron','$div','$nombre','$tipo')";

                        if ($this->db->query($query)) {
                                $conteo++;
                        }
                }






                return $conteo;
        }

}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

