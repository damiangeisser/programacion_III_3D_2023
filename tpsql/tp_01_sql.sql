/*Parte 7 - (MySql)
TP 01 SQL (ABM con listado)
Tabla: usuario
(id autoincrement ,nombre,apellido, clave,mail,fecha_de_registro )
Tabla:producto
(id autoincremental,código_de_barra (6 cifras ),nombre ,tipo, stock,
precio,fecha_de_creación,fecha_de_modificación )
Tabla:venta
(id autoincremental,id_producto ,id_usuario, cantidad,fecha_de_venta, )
Hacer todos los script necesarios y entregarlos por GDB
NOTA:insertar los siguientes datos en sus consultas SQL correspondientes.

Alumno: Damián Geisser*/

CREATE TABLE `tp_01_sql`.`usuario`
( `id` INT NOT NULL AUTO_INCREMENT ,
 `nombre` VARCHAR(100) NOT NULL ,
 `apellido` VARCHAR(100) NOT NULL ,
 `clave` VARCHAR(100) NOT NULL ,
 `mail` VARCHAR(100) NOT NULL ,
 `fecha_de_registro` DATE NOT NULL ,
 `localidad` VARCHAR(100) NOT NULL ,
 PRIMARY KEY (`id`))
 ENGINE = InnoDB;
 
ALTER TABLE usuario AUTO_INCREMENT=101;
 
CREATE TABLE `tp_01_sql`.`producto`
( `id` INT NOT NULL AUTO_INCREMENT ,
`codigo_de_barra` INT(8) NOT NULL ,
`nombre` VARCHAR(100) NOT NULL ,
`tipo` VARCHAR(100) NOT NULL ,
`stock` INT NOT NULL ,
`precio` DECIMAL(6,2) NOT NULL ,
`fecha_de_creacion` DATE NOT NULL ,
`fecha_de_modificacion` DATE NOT NULL ,
PRIMARY KEY (`id`))
ENGINE = InnoDB;

ALTER TABLE producto AUTO_INCREMENT=1001;

CREATE TABLE `tp_01_sql`.`venta`
( `id` INT NOT NULL AUTO_INCREMENT ,
`id_producto` INT NOT NULL ,
`id_usuario` INT NOT NULL ,
`cantidad` INT NOT NULL ,
`fecha_de_venta` DATE NOT NULL ,
PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO `usuario` VALUES
(0,'Esteban','Madou','2345','dkantor0@example.com','2021-1-7','Quilmes'),
(0,'German','Gerram','1234','ggerram1@hud.gov','2020-5-8','Berazategui'),
(0,'Deloris','Fosis','5678','bsharpe2@wisc.edu','2020-11-28','Avellaneda'),
(0,'Brok','Neiner','4567','bblazic3@desdev.cn','2020-12-8','Quilmes'),
(0,'Garrick','Brent','6789','gbrent4@theguardian.com','2020-12-17','Moron'),
(0,'Bili','Baus','0123','bhoff5@addthis.com','2020-11-27','Moreno');

INSERT INTO `producto` VALUES
(0,'77900361','Westmacott','liquido',33,15.87,'2021-2-9','2020-9-26'),
(0,'77900362','Spirit','solido',45,69.74,'2020-9-18','2020-4-14'),
(0,'77900363','Newgrosh','polvo',14,68.19,'2020-11-29','2021-2-11'),
(0,'77900364','McNickle','polvo',19,53.51,'2020-11-28','2020-4-17'),
(0,'77900365','Hudd','solido',68,26.56,'2020-12-19','2020-6-19'),
(0,'77900366','Schrader','polvo',17,96.54,'2020-8-2','2020-4-18'),
(0,'77900367','Bachellier','solido',59,69.17,'2021-1-30','2020-6-7'),
(0,'77900368','Fleming','solido',38,66.77,'2020-10-26','2020-10-3'),
(0,'77900369','Hurry','solido',44,43.01,'2020-7-4','2020-5-30'),
(0,'77900310','Krauss','polvo',73,35.73,'2021-3-3','2020-8-30');

INSERT INTO `venta`
(`id_producto`,`id_usuario`,`cantidad`,`fecha_de_venta`) VALUES
('1001','101',2,'2020-7-19'),
('1008','102',3,'2020-8-16'),
('1007','102',4,'2021-1-24'),
('1006','103',5,'2021-1-14'),
('1003','104',6,'2021-3-20'),
('1005','105',7,'2021-2-22'),
('1003','104',6,'2020-12-2'),
('1003','106',6,'2020-6-10'),
('1002','106',6,'2021-2-4'),
('1001','106',1,'2020-5-17');

/*1. Obtener los detalles completos de todos los usuarios, ordenados alfabéticamente.*/
SELECT * FROM `usuario` ORDER BY apellido, nombre;

/*2. Obtener los detalles completos de todos los productos líquidos*/
SELECT * FROM `producto` WHERE tipo = 'liquido';

/*3. Obtener todas las compras en los cuales la cantidad esté entre 6 y 10 inclusive.*/
SELECT * FROM `venta` WHERE cantidad BETWEEN 6 AND 10;

/*4. Obtener la cantidad total de todos los productos vendidos.*/
SELECT SUM(cantidad) FROM `venta`;

/*5. Mostrar los primeros 3 números de productos que se han enviado.*/
SELECT P.id FROM `producto` P INNER JOIN `venta` V ON V.id_producto = P.id ORDER BY V.fecha_de_venta LIMIT 3;

/*6. Mostrar los nombres del usuario y los nombres de los productos de cada venta.*/
SELECT U.nombre AS 'Usuario', P.nombre AS 'Producto' FROM `venta` V INNER JOIN `producto` P ON P.id = V.id_producto INNER JOIN `usuario` U ON U.id = V.id_usuario;

/*7. Indicar el monto (cantidad * precio) por cada una de las ventas.*/
SELECT V.cantidad * P.precio AS 'Monto' FROM `venta` V INNER JOIN `producto` P ON P.id = V.id_producto;

/*8. Obtener la cantidad total del producto 1003 vendido por el usuario 104.*/
SELECT SUM(cantidad) AS 'Total' FROM `venta` WHERE id_producto = 1003 AND id_usuario = 104;

/*9. Obtener todos los números de los productos vendidos por algún usuario de ‘Avellaneda’.*/
SELECT V.id_producto AS 'Usuario' FROM `venta` V INNER JOIN `usuario` U ON U.id = V.id_usuario WHERE U.localidad = 'Avellaneda';

/*10.Obtener los datos completos de los usuarios cuyos nombres contengan la letra ‘u’*/
SELECT * FROM `usuario` WHERE nombre LIKE '%u%';

/*11. Traer las ventas entre junio del 2020 y febrero 2021.*/
SELECT * FROM `venta` WHERE fecha_de_venta BETWEEN '2020-06-01' AND '2021-02-01';

/*12. Obtener los usuarios registrados antes del 2021.*/
SELECT * FROM `usuario` WHERE fecha_de_registro < '2021-01-01';

/*13.Agregar el producto llamado ‘Chocolate’, de tipo Sólido y con un precio de 25,35.*/
INSERT INTO `producto` (`codigo_de_barra`,`nombre`,`tipo`,`stock`,`precio`,`fecha_de_creacion`,`fecha_de_modificacion`)
VALUES ('77900311','Chocolate','solido',0,25.35,'2022-9-20','2022-9-20');

/*14.Insertar un nuevo usuario.*/
INSERT INTO `usuario` (`nombre`, `apellido`, `clave`, `mail`, `fecha_de_registro`, `localidad`) VALUES
('Dario','Lopez','5423','dlopez@example.com','2021-9-20','Lanus');

/*15.Cambiar los precios de los productos de tipo sólido a 66,60.*/
UPDATE `producto` SET precio = 66.60 WHERE tipo = 'solido';

/*16.Cambiar el stock a 0 de todos los productos cuyas cantidades de stock sean menores a 20 inclusive.*/
UPDATE `producto` SET stock = 0
WHERE stock <= 20;

/*17.Eliminar el producto número 1010.*/
DELETE FROM `producto`
WHERE id = 1010

/*18.Eliminar a todos los usuarios que no han vendido productos.*/
DELETE FROM `usuario` WHERE id NOT IN (SELECT id_usuario FROM `venta` V);