ALTER TABLE `e24db`.`tbl_e24_cat_material_detail` 
CHANGE COLUMN `pk_material_detail` `pk_material_detail` INT(10) UNSIGNED NOT NULL COMMENT 'Campo indice de la tabla' ;



CREATE TABLE `e24db`.`tbl_e24_loan_material` (
  `pk_loan_material` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fk_course` INT(10) UNSIGNED NOT NULL,
  `fk_teacher` MEDIUMINT(8) UNSIGNED NOT NULL,
  `fk_material_detail` INT(10) UNSIGNED NOT NULL,
  `pick_date` DATE NOT NULL,
  `drop_date` DATE NULL,
  `comment` VARCHAR(300) NULL,
  PRIMARY KEY (`pk_loan_material`) ,
  INDEX `XIF1_loan_material` (`fk_course` ASC),
  INDEX `XIF2_loan_material` (`fk_teacher` ASC),
  INDEX `XIF3_loan_material` (`fk_material_detail` ASC)  ,
  CONSTRAINT `fk_loanmat_course_pk_course`
    FOREIGN KEY (`fk_course`)
    REFERENCES `e24db`.`tbl_e24_courses` (`pk_course`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION ,
  CONSTRAINT `fk_loanmat_teacher_pk_teacher`
    FOREIGN KEY (`fk_teacher`)
    REFERENCES `e24db`.`tbl_e24_teachers` (`pk_teacher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION 
)
COMMENT = 'tabla que contiene el record de prestamos de materiales por maestro';


