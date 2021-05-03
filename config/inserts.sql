/*RELLENANDO LA TABLA DE ROLES*/
INSERT INTO roles VALUES(NULL, 'ADMIN');
INSERT INTO roles VALUES(NULL, 'normal');

/*RELLENANDO LA TABLA DE DIVISIONES*/
INSERT INTO divisiones VALUES('DA', 'Baja California');
INSERT INTO divisiones VALUES('DB', 'Noroeste');
INSERT INTO divisiones VALUES('DC', 'Norte');
INSERT INTO divisiones VALUES('DD', 'Golfo Norte');
INSERT INTO divisiones VALUES('DF', 'Centro Occidente');
INSERT INTO divisiones VALUES('DG', 'Centro Sur');
INSERT INTO divisiones VALUES('DJ', 'Oriente');
INSERT INTO divisiones VALUES('DK', 'Sureste');
INSERT INTO divisiones VALUES('DL', 'Valle de México Norte');
INSERT INTO divisiones VALUES('DM', 'Valle de México Centro');
INSERT INTO divisiones VALUES('DN', 'Valle de México Sur');
INSERT INTO divisiones VALUES('DP', 'Bajío');
INSERT INTO divisiones VALUES('DU', 'Golfo Centro');
INSERT INTO divisiones VALUES('DV', 'Centro Oriente');
INSERT INTO divisiones VALUES('DW', 'Peninsular');
INSERT INTO divisiones VALUES('DX', 'Jalisco');


/*INSERTANDO UN ADMINISTRADOR*/
INSERT INTO usuarios VALUES(NULL, 'Admin CFE', 'cfe_admin', '$2y$04$m0US6DV1cchVkTBeTDJc6OQocSZxCAK12yyd0wJEHhaKa9mn2.ADu', 'DU', 1, 1);
/*CONTRASEÑA: DU_tamp_2511 */

/**
 * Author:  joelm
 * Created: 22/04/2020
 */

