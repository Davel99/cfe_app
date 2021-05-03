
<?php

class officedoc {

        public function encabezados($hoja) {

                $hoja->setCellValue("A1", "RPU");
                $hoja->setCellValue("B1", "DIV");
                $hoja->setCellValue("C1", "NOMBRE");
                $hoja->setCellValue("D1", "TFA");
                $hoja->setCellValue("E1", "P1");
                $hoja->setCellValue("F1", "P2");
                $hoja->setCellValue("G1", "P3");
                $hoja->setCellValue("H1", "P4");
                $hoja->setCellValue("I1", "P5");
                $hoja->setCellValue("J1", "P6");
                $hoja->setCellValue("K1", "P7");
                $hoja->setCellValue("L1", "P8");
                $hoja->setCellValue("M1", "P9");
                $hoja->setCellValue("N1", "P10");

                return $hoja;
        }
        

        public function formatear($hoja, $abc) {
                for ($i = 0; $i < count($abc); $i++) {
                        $hoja->getColumnDimension($abc[$i])->setAutoSize(true);
                }
                return $hoja;
        }

}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

