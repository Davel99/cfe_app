CREATE DATABASE IF NOT EXISTS cfe_perm_app
DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE cfe_perm_app;

/*CREANDO LA TABLA DE ROLES*/
CREATE TABLE IF NOT EXISTS roles(
rol_id          int(10) auto_increment  not null,
nombre          varchar(255)            not null,
CONSTRAINT pk_roles        PRIMARY KEY(rol_id)
)ENGINE=InnoDb;


/*CREANDO LA TABLA DE DIVISIONES*/
CREATE TABLE IF NOT EXISTS divisiones(
div_id          varchar(10)    not null,
nombre          varchar(255)    not null,
CONSTRAINT pk_divisiones        PRIMARY KEY(div_id),
CONSTRAINT uq_nombre            UNIQUE(nombre)
)ENGINE=InnoDb
DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;


/*CREANDO LA TABLA DE PERMISIONARIOS*/
CREATE TABLE IF NOT EXISTS permisionarios(
perm_id         varchar(10)     not null,
div_id          varchar(10)     not null,
nombre          varchar(255)    not null,
permiso         varchar(255)    not null,
CONSTRAINT pk_permisionarios            PRIMARY KEY(perm_id),
CONSTRAINT fk_permisionarios_divisiones FOREIGN KEY(div_id)     REFERENCES divisiones(div_id)
)ENGINE=InnoDb;


/*CREANDO LA TABLA DE USUARIOS*/
CREATE TABLE IF NOT EXISTS usuarios(
user_id         int(255)        auto_increment  not null,
nombre          varchar(255)                    not null,
username        varchar(255)                    not null,
password        varchar(255)                    not null,
div_id          varchar(10)                     not null,
rol_id          int(10)                         not null,
activo          bit(1)                          not null,
CONSTRAINT pk_usuarios                  PRIMARY KEY(user_id),
CONSTRAINT uq_usuarios                  UNIQUE(username),
CONSTRAINT fk_usuarios_divisiones       FOREIGN KEY(div_id)     REFERENCES divisiones(div_id),
CONSTRAINT fk_usuarios_roles            FOREIGN KEY(rol_id)     REFERENCES roles(rol_id)
)ENGINE=InnoDb;


/*CREANDO LA TABLA DE SUBIDAS DE LOS ADMINISTRADORES
CREATE TABLE IF NOT EXISTS admin_uploads(
admin_upload_id int(255)        auto_increment  not null,
user_id         int(255)                        not null,
yearup          int(255)                        not null,
monthup         int(10)                         not null,
version         int(10)                         not null,
CONSTRAINT pk_admin_uploads             PRIMARY KEY(admin_upload_id),
CONSTRAINT fk_admin_uploads_usuarios    FOREIGN KEY(user_id)     REFERENCES usuarios(user_id)

)ENGINE=InnoDb;
*/

/**
 * Author:  joelm
 * Created: 18/04/2020
 */
