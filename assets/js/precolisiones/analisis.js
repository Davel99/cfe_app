
var datos;              //DECLARO VARIABLE PARA USARLA EN TODO EL DOCUMENTO
var checks = [];        //VARIABLE APRA GUARDAR CHECKS
var elect = 0;          //VARIABLE PARA GUARDAR ELECCION DEL USUARIO SOBRE PRELACIONES

//VARIABLES PARA DETECTAR QUÉ BOTONES FUERON PRESIONADOS
var New = false;
var Cam = false;
var Fal = false;
var Act = false;
//PROCEDO A ASIGNAR VARIABLES DONDE GUARDARÉ DATOS.
var Nuevos;
var Faltantes;
var CambiadosACT;
var CambiadosPAS;
var mesActual;
var template = '';

//VARIABLES RECURRENTES
var divisiones = $('#div_options');
var permisionarios = $('#perm_options');
var casilla_perm = $('#dato-perm');

//CUANDO EL DOCUMENTO CARGUE POR COMPLETO

$(document).ready(function () {

        $('#descargas').hide();

        traerDivs();

        $.post(base_url + 'precolisiones/api_ajax', {analizar: true}, function (response) {

                datos = JSON.parse(response); //Transformando datos para poder leerlos
//                $('#botones').show();          //Muestro el botón una vez que el documento esté listo.
//                $('#descarga_Mod').show();          //Muestro el botón una vez que el documento esté listo.
                $('.loader').fadeOut("slow");


                Nuevos = datos[0];
                Faltantes = datos[1];
                CambiadosACT = datos[2];
                CambiadosPAS = datos[3];
                mesActual = datos[4];
                News();

                $('#descargas').show();

        });
});



//FUNCIONES RECURRENTES

function traerDivs() {

        $.post(base_url + 'precolisiones/api_ajax', {divs: false}, function (response) {
                let datos = JSON.parse(response);
                templateList = '';
                datos.forEach(div => {
                        templateList += `

                        <option value= "${div.div}" >

                        ${div.div} - ${div.nombre}

                        </option>

                `;
                });
                divisiones.append(templateList);


                traerPerm(); //LEYENDO LA DIVISIÓN ELEGIDA



        });

}


function traerPerm() {
        var val = divisiones.val();
        $.post(base_url + 'precolisiones/api_ajax', {perm: val}, function (response) {
                permisionarios.html('');
                try {
                        let datos = JSON.parse(response);
                        templateList = '';
                        datos.forEach(perm => {
                                templateList += `
                        <tr>
                                <td>${perm.nombre}</td>
                                <td>${perm.id}</td>
                                <td align="center">
                                        <input type="checkbox" class="acronimo-perm" name="acronimo" value="${perm.id}">
                                </td>
                        </tr>

                `;
                        });
                        permisionarios.html(templateList);

                } catch (error) {

                        permisionarios.html('La división elegida no contiene permisionarios');
                        console.log('La división elegida no contiene permisionarios');

                }



        });
}


//LEER EVENTOS
casilla_perm.on('change', function () {
        var checkboxes = $('.acronimo-perm');


        for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = casilla_perm[0].checked;
        }

});

divisiones.on('change', function () {

        traerPerm();
        console.log('Trayendo perm');
        casilla_perm[0].checked = false;
});


//CONJUNTO DE INSTRUCCIONES QUE CONFORMAN LA APLICACIÓN


function reiniciarVal() {
        New = false;
        Cam = false;
        Fal = false;
        Act = false;

}

function News() {
        reiniciarVal();
        New = true;
        for (var i = 0; i < Nuevos.length; i++) {
                var info = Nuevos[i];


                template += `
        <tr class="fila">
        `;
                for (var c = 0; c < info.length; c++) {

                        if (c == 1) {
                                template += `
                <td class='div-acronimo'>${info[c]}</td>
            `;
                        } else if (c >= 4 && c <= 13) {
                                if (info[c] != "") {
                                        template += `
                  <td class='perm-acronimo'>${info[c]}</td>
              `;

                                } else {
                                        template += `
                  <td>${info[c]}</td>
              `;
                                }

                        } else {
                                template += `
                <td>${info[c]}</td>
            `;
                        }
                }
                template += `
        </tr>
        `;

        }

        imprimir();
        filtrar();


}
function Falt() {

        reiniciarVal();
        Fal = true;

        for (var i = 0; i < Faltantes.length; i++) {
                var info = Faltantes[i];
                template += `
        <tr class="fila">
        `;
                for (var c = 0; c < info.length; c++) {

                        if (c == 1) {
                                template += `
                <td class='div-acronimo'>${info[c]}</td>
            `;

                        } else if (c >= 4 && c <= 13) {
                                if (info[c] != "") {
                                        template += `
                  <td class='perm-acronimo'>${info[c]}</td>
              `;

                                } else {
                                        template += `
                  <td>${info[c]}</td>
              `;
                                }

                        } else {
                                template += `
                <td>${info[c]}</td>
            `;
                        }

                }
                template += `
        </tr>
        `;
        }


        imprimir();
        filtrar();


}
function Camb() {

        reiniciarVal();
        Cam = true;
        for (var i = 0; i < CambiadosACT.length; i++) {
                var info = CambiadosACT[i];
                var infoPAS = CambiadosPAS[i];


                template += `
        <tr class="fila">
        `; //EMPIEZA FILA
                for (var c = 0; c < info.length; c++) {
                        if (c == 1) {
                                template += `
                <td class='div-acronimo'>${info[c]}</td>
            `;

                        } else if (c >= 4 && c <= 13) {
                                if (info[c] != "") {
                                        template += `
                  <td class='perm-acronimo'>${info[c]}</td>
              `;

                                } else {
                                        template += `
                  <td>${info[c]}</td>
              `;
                                }

                        } else {
                                template += `
                <td>${info[c]}</td>
            `;
                        }
                }
                template += `
        <td>ACTUAL</td>
        `;
                template += `
        </tr>
        `; //TERMINA FILA

                template += `
        <tr class="fila">
        `; //EMPIEZA FILA


                for (var c = 0; c < infoPAS.length; c++) {
                        if (c == 1) {
                                template += `
              <td class='div-acronimo'>${infoPAS[c]}</td>
          `;

                        } else if (c >= 4 && c <= 13) {
                                if (infoPAS[c] != "") {
                                        template += `
                <td class='perm-acronimo'>${infoPAS[c]}</td>
            `;

                                } else {
                                        template += `
                <td>${infoPAS[c]}</td>
            `;
                                }

                        } else {
                                template += `
              <td>${infoPAS[c]}</td>
          `;
                        }
                }
                template += `
      <td>PASADO</td>
      `;

                template += `
        </tr>
        `; //TERMINA FILA

                template += `
        <tr class="espaciado">
            <td style="border:none;"> - - </td>
        </tr>
        `;


        }

        imprimir();
        filtrar();
}


function Actual() {
        esperarAct(impActual);
}
function impActual() {

        reiniciarVal();
        Act = true;
        for (var i = 0; i < mesActual.length; i++) {
                var info = mesActual[i];


                template += `
        <tr class="fila">
        `;
                for (var c = 0; c < info.length; c++) {

                        if (c == 1) {
                                template += `
                <td class='div-acronimo'>${info[c]}</td>
            `;
                        } else if (c >= 4 && c <= 13) {
                                if (info[c] != "") {
                                        template += `
                  <td class='perm-acronimo'>${info[c]}</td>
              `;

                                } else {
                                        template += `
                  <td>${info[c]}</td>
              `;
                                }

                        } else {
                                template += `
                <td>${info[c]}</td>
            `;
                        }
                }
                template += `
        </tr>
        `;

        }
        imprimir();
        filtrar();


}
function esperarAct(callback) {
        $('.loader').fadeIn("slow");


        var delay = 500;

        setTimeout(function () {
                callback();
        }, delay);

        setTimeout(function () {
                $('.loader').fadeOut("slow");
        }, delay);



}




//FUNCIONES PARA IMPRIMIR DATOS
function imprimir() {
        $('#verResultado').html(template);
        template = '';

}

function colorearDiv() {
        var datosDiv = document.getElementsByClassName('div-acronimo');
        var div = document.getElementById('division').value;

        if (div != "false") {

                for (var i = 0; i < datosDiv.length; i++) {
                        datosDiv[i].removeAttribute("noDelete");
                        if (datosDiv[i].innerHTML == div) {
                                datosDiv[i].style.background = "red";
                        }
                }


        } else {
                console.log("Ha elegido todas las divisiones");
        }




}
function colorearPerm(dataAcron) {

        var datosPerm = document.getElementsByClassName('perm-acronimo');

        //REINICIO COLORES DE TODO
        for (var i = 0; i < datosPerm.length; i++) {
                datosPerm[i].style.background = "rgba(0,0,0,0)";
        }


        //COLOREO LO NECESARIO
        for (var i = 0; i < datosPerm.length; i++) {
                var acron = '';
                acron += datosPerm[i].innerHTML[1];
                acron += datosPerm[i].innerHTML[2];
                acron += datosPerm[i].innerHTML[3];

                datosPerm[i].removeAttribute("noDelete");

                for (var x = 0; x < dataAcron.length; x++) {
                        if (dataAcron[x] == acron) {
                                datosPerm[i].style.background = "red";
                                datosPerm[i].setAttribute("noDelete", "1");
                        }
                }
        }



}
function delDiv() {
        var div = document.getElementById('div_options').value;
        var datosDiv = document.getElementsByClassName('div-acronimo');
        var dataD = [];

        if (div != "false") {

                for (var i = 0; i < datosDiv.length; i++) {

                        if (datosDiv[i].innerHTML != div) {
                                dataD.push(datosDiv[i].parentElement);
                        }

                }

                for (var i = 0; i < dataD.length; i++) {
                        dataD[i].remove();
                }

        }


} //CAMBIAR

function borrar() {


        //ACCEDO A TODAS LAS FILAS
        var filas = document.getElementsByClassName('fila');
        var delFilas = [];
        var filaActual = 0;
        var hijos = 0;
        var ctrl = 0;

        for (var i = 0; i < filas.length; i++) {
                //ACCEDO A LA FILA INDICADA
                filaActual = filas[i];
                hijos = filas[i].children;
                ctrl = 0;


                //EMPEZAMOS DESDE LA COLUMNA CUATRO PORQUE LAS OTRAS NO IMPORTAN
                for (var x = 4; x < hijos.length; x++) {
                        if (hijos[x].getAttribute("noDelete") == "1") {
                                ctrl++;
                        }
                }


                if (ctrl == 0) {
                        delFilas.push(filaActual);
                }




        }

        for (var i = 0; i < delFilas.length; i++) {
                delFilas[i].remove();
        }




}

function delEspaciados() {
        var espaciados = document.getElementsByClassName("espaciado");

        while (espaciados.length > 0) {
                espaciados[0].remove(this);
        }

}

function leerEleccion() {

        var eleccion = document.getElementsByName('eleccion');
        elect = 0;

        for (var i = 0; i < eleccion.length; i++) {
                if (eleccion[i].checked) {
                        elect = eleccion[i].value;
                }
        }

        if (elect == 2) {
                console.log("Eliminando NO prelaciones");
                calcularPrecol();
        } else if (elect == 3) {
                console.log("Eliminando Prelaciones");
                calcularNOPrecol();
        }



}
function calcularPrecol() {
        var allFiles = document.getElementsByClassName('fila');
        var filaActual;
        var cols;
        var texto;
        var ctrl = 0;
        var delFilas = [];

        for (var i = 0; i < allFiles.length; i++) {
                ctrl = 0;
                filaActual = allFiles[i];
                cols = filaActual.children;
                for (var x = 4; x < cols.length - 1; x++) {
                        texto = cols[x].innerHTML;

                        if (texto != "") {
                                if (texto[texto.length - 1] == "1") {
                                        ctrl++;
                                } else {
                                        cols[x].style.background = "rgba(215,168,0,0.5)";
                                } //termina else

                        } // termina if


                } //termina for

                if (ctrl == 1 || ctrl == 0) {
                        delFilas.push(filaActual);
                }


        }//termina primer for
        for (var i = 0; i < delFilas.length; i++) {
                delFilas[i].remove();
        }

}
function calcularNOPrecol() {

        var allFiles = document.getElementsByClassName('fila');
        var filaActual;
        var cols;
        var texto;
        var ctrl = 0;
        var delFilas = [];

        for (var i = 0; i < allFiles.length; i++) {
                ctrl = 0;
                filaActual = allFiles[i];
                cols = filaActual.children;
                for (var x = 4; x < cols.length - 1; x++) {
                        texto = cols[x].innerHTML;

                        if (texto != "") {
                                if (texto[texto.length - 1] == "1") {
                                        ctrl++;
                                } else {
                                        cols[x].style.background = "rgba(215,168,0,0.5)";
                                } //termina else

                        } // termina if


                } //termina for

                if (ctrl > 1) {
                        delFilas.push(filaActual);
                }


        }//termina primer for

        for (var i = 0; i < delFilas.length; i++) {
                delFilas[i].remove();
        }

}



function reImprimir() {
        if (New == true) {
                News();
        } else if (Cam == true) {
                Camb();
        } else if (Fal == true) {
                Falt();
        } else if (Act == true) {
                Actual();
        }

}


$('#filter').on('click', function () {
        reImprimir();
})

function filtrar() {
        console.log('Haciendo filtrado...');

        $('.loader').fadeIn("slow");
        $('#descarga-con-filtro').hide();    //Escondo botones de descarga del archivo modificado

        //REINICIO VALORES DE LOS CHECKS
        checks.length = 0;

        //ELIJO TODOS LOS ELEMENTOS DE ACRÓNIMO.
        var elementsCheck = document.getElementsByName("acronimo");

        for (var i = 0; i < elementsCheck.length; i++) {
                if (elementsCheck[i].checked) {
                        checks.push(elementsCheck[i].value);
                }
        }

        delDiv();

        if (checks.length != 0) {
                colorearPerm(checks);     //Coloreando permisionarios elegidos
                borrar();
                delEspaciados();
        }


        setTimeout(() => {
                console.log("Haciendo filtrado de prelaciones");
                leerEleccion();
        }, 500);

        setTimeout(() => {

                let data;

                if (checks.length != 0) {
                        data = checks;
                } else {
                        data = "";
                }


                var filas = document.getElementsByClassName('fila');


                var fila = [];
                for (var i = 0; i < filas.length; i++) {
                        fila.push([]);
                        var hijos = filas[i].children;
                        for (var x = 0; x < hijos.length; x++) {
                                fila[i].push(hijos[x].innerHTML);
                        }
                }




                var postData = {
                        datos: data,
                        filas: fila
                }

                $.post(base_url + 'precolisiones/api_filter', postData, function (response) {
                        var res = JSON.parse(response);
                        if (res == true) {
                                alert("Datos generados correctamente");
                                $('#descarga-con-filtro').show();//Escondo botones de descarga del archivo modificado
                        } else {
                                alert("Filas vacías");
                                $('#descarga-con-filtro').hide();//Escondo botones de descarga del archivo modificado
                        }

                        $('.loader').fadeOut("slow");




                })


        }, 500);


}
