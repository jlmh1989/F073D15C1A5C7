CREATE TABLE `e24db`.`tbl_e24_cat_material_detail` (
  `pk_material_detail` INT NOT NULL AUTO_INCREMENT COMMENT 'Campo indice de la tabla',
  `material_code` VARCHAR(45) NULL COMMENT 'contiene el codigo de los libros, es para su identificacion ',
  `comment` VARCHAR(300) NULL COMMENT 'Comentarios espesificos del libro',
  `availability` TINYINT(1) NULL DEFAULT 1 COMMENT 'Indica la disponibilidad del material: 0 = no dispobible / Prestado, 1= DISPONIBLE',
  `fk_cat_material` SMALLINT(5) NULL COMMENT 'corresponde al campo referencia en la tabla catalogo de materiales',
  PRIMARY KEY (`pk_material_detail`),
  UNIQUE INDEX `codigo_UNIQUE` (`material_code` ASC, `fk_cat_material` ASC),
  INDEX `XIF1e24_material_detail` (`fk_cat_material` ASC))
COMMENT = 'Tabla generada para contener informacion detallada de los libros y materiales con los que cuenta el maestro';


ALTER TABLE `e24db`.`tbl_e24_cat_material_detail` 
CHANGE COLUMN `fk_cat_material` `fk_cat_material` SMALLINT(5) UNSIGNED NOT NULL COMMENT 'corresponde al campo referencia en la tabla catalogo de materiales' ;
ALTER TABLE `e24db`.`tbl_e24_cat_material_detail` 
ADD CONSTRAINT `fk_material_detail_pk_material`
  FOREIGN KEY (`fk_cat_material`)
  REFERENCES `e24db`.`tbl_e24_cat_material` (`pk_material`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  
  
  
INSERT INTO `e24db`.`tbl_e24_cat_material` (`pk_material`, `desc_material`, `fk_type_material`) VALUES ('3', 'Libro Prueba ', '9');
commit;  
  
INSERT INTO `e24db`.`tbl_e24_cat_material_detail` (`material_code`, `comment`, `availability`, `fk_cat_material`) VALUES ('LP1-0001', 'la hoja 123 esta rota.', '1', '3');
INSERT INTO `e24db`.`tbl_e24_cat_material_detail` (`material_code`, `comment`, `availability`, `fk_cat_material`) VALUES ('LP1-0002', 'la hoja 124 esta rota.', '1', '3');
INSERT INTO `e24db`.`tbl_e24_cat_material_detail` (`material_code`, `comment`, `availability`, `fk_cat_material`) VALUES ('LP1-0003', 'la hoja 125 esta rota.', '1', '3');
INSERT INTO `e24db`.`tbl_e24_cat_material_detail` (`material_code`, `comment`, `availability`, `fk_cat_material`) VALUES ('LP1-0004', 'la hoja 126 esta rota.', '1', '3');
INSERT INTO `e24db`.`tbl_e24_cat_material_detail` (`material_code`, `comment`, `availability`, `fk_cat_material`) VALUES ('LP1-0005', 'la hoja 127 esta rota.', '1', '3');
INSERT INTO `e24db`.`tbl_e24_cat_material_detail` (`material_code`, `comment`, `availability`, `fk_cat_material`) VALUES ('LP1-0006', 'la hoja 128 esta rota.', '1', '3');
INSERT INTO `e24db`.`tbl_e24_cat_material_detail` (`material_code`, `comment`, `availability`, `fk_cat_material`) VALUES ('LP1-0007', 'la hoja 129 esta rota.', '1', '3');
INSERT INTO `e24db`.`tbl_e24_cat_material_detail` (`material_code`, `comment`, `availability`, `fk_cat_material`) VALUES ('LP1-0008', 'la hoja 130 esta rota.', '1', '3');
INSERT INTO `e24db`.`tbl_e24_cat_material_detail` (`material_code`, `comment`, `availability`, `fk_cat_material`) VALUES ('LP1-0009', 'la hoja 131 esta rota.', '1', '3');

INSERT INTO `e24db`.`tbl_e24_cat_material_detail` (`material_code`, `comment`, `availability`, `fk_cat_material`) VALUES ('ABP1-0001', 'sin detalles.', '1', '3');
INSERT INTO `e24db`.`tbl_e24_cat_material_detail` (`material_code`, `comment`, `availability`, `fk_cat_material`) VALUES ('ABP1-0002', 'es de pasta dura.', '1', '3');

INSERT INTO `e24db`.`tbl_e24_cat_material_detail` (`material_code`, `comment`, `availability`, `fk_cat_material`) VALUES ('ABC1-0001', 'es verde.', '1', '3');
INSERT INTO `e24db`.`tbl_e24_cat_material_detail` (`material_code`, `comment`, `availability`, `fk_cat_material`) VALUES ('ABC1-0002', 'no tiene nada.', '1', '3');

commit;

UPDATE `e24db`.`tbl_e24_cat_material_detail` SET `fk_cat_material`='1' WHERE `pk_material_detail`='11';
UPDATE `e24db`.`tbl_e24_cat_material_detail` SET `availability`='0', `fk_cat_material`='1' WHERE `pk_material_detail`='12';
UPDATE `e24db`.`tbl_e24_cat_material_detail` SET `fk_cat_material`='2' WHERE `pk_material_detail`='13';
UPDATE `e24db`.`tbl_e24_cat_material_detail` SET `availability`='0', `fk_cat_material`='2' WHERE `pk_material_detail`='14';
commit;


INSERT INTO `e24db`.`tbl_e24_material_level` (`fk_level`, `fk_material`, `status`) VALUES ('3', '3', '1');
commit;