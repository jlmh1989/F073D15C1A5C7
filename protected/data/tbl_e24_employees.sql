
--
-- Estructura de tabla para la tabla `tbl_e24_students`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_employees` (
  `pk_employee` int(10) unsigned NOT NULL AUTO_INCREMENT,  
  `fk_user` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `neigborhod` varchar(100) NOT NULL,
  `county` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `birthdate` date NOT NULL,
  `street` varchar(100) NOT NULL,
  `street_number` smallint(5) unsigned NOT NULL,
  `street_number_int` varchar(5) DEFAULT NULL,
  `fk_state_dir` mediumint(8) unsigned NOT NULL,
  `entrance_date` date NOT NULL, 
  PRIMARY KEY (`pk_employee`),
  UNIQUE KEY `XPKe24_employee` (`pk_employee`),
  KEY `fk_user` (`fk_user`),
  KEY `fk_state_dir` (`fk_state_dir`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

 

--
-- Filtros para la tabla `tbl_e24_students`
--
ALTER TABLE `tbl_e24_employees`
  ADD CONSTRAINT `fkState_pkCatDetail_employee` FOREIGN KEY (`fk_state_dir`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_pk_user_employee` FOREIGN KEY (`fk_user`) REFERENCES `tbl_e24_users` (`pk_user`) ON DELETE CASCADE ON UPDATE CASCADE;


