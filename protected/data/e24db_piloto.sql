-- phpMyAdmin SQL Dump
-- version 3.3.7deb8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-02-2015 a las 06:08:15
-- Versión del servidor: 5.1.73
-- Versión de PHP: 5.3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db2676070-main`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_assistance_record`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_assistance_record` (
  `pk_assistance` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_date` date NOT NULL,
  `fk_course` int(10) unsigned NOT NULL,
  `fk_client` int(10) unsigned NOT NULL,
  `fk_student` int(10) unsigned DEFAULT NULL,
  `fk_status_class` tinyint(3) unsigned NOT NULL,
  `reschedule_date` date DEFAULT NULL,
  `reschedule_time` time DEFAULT NULL,
  `cancellation_reason` varchar(100) DEFAULT NULL,
  `fk_level_detail` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`pk_assistance`),
  UNIQUE KEY `XPKe24_assistance_record` (`pk_assistance`,`fk_course`,`fk_student`,`fk_client`),
  KEY `fk_curse` (`fk_course`),
  KEY `fk_student` (`fk_student`),
  KEY `fk_client` (`fk_client`),
  KEY `XIF1e24_assistance_record` (`fk_course`,`fk_client`),
  KEY `XIF3e24_assistance_record` (`fk_status_class`),
  KEY `fk_level_detail` (`fk_level_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_assistance_record`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_billing_data`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_billing_data` (
  `pk_billing_data` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_client` int(10) unsigned NOT NULL,
  `street` varchar(100) NOT NULL,
  `street_number` smallint(5) unsigned NOT NULL,
  `street_number_int` varchar(5) DEFAULT NULL,
  `bussiness_name` varchar(100) NOT NULL,
  `county` varchar(100) NOT NULL,
  `neighborhood` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `rfc` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk_billing_data`),
  UNIQUE KEY `XPKe24_billing_data` (`pk_billing_data`,`fk_client`),
  KEY `fk_client` (`fk_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_billing_data`
--

INSERT INTO `tbl_e24_billing_data` (`pk_billing_data`, `fk_client`, `street`, `street_number`, `street_number_int`, `bussiness_name`, `county`, `neighborhood`, `state`, `country`, `zipcode`, `rfc`, `status`) VALUES
(1, 1, 'Matamoros', 311, '', 'Administradora de Naves Industriales S. de R.L. de C.V.', 'Monterrey', 'Centro', 'Nuevo Le?n', 'M?xico ', '64000', 'ANI0104257ZA', 1),
(2, 2, 'Jose Vasconcelos', 15010, '', 'Centro Empresarial Morin SA de CV', 'San pedro', 'Del Valle', 'Nuevo Le?n', 'M?xico', '66220', 'CEM111208LX1', 1),
(3, 3, 'Frida Kahlo', 195, '810', 'Traust Accounting S de RL de CV', 'San pedro', 'Valle Oriente', 'Nuevo Le?n', 'M?xico', '66269', 'TAC111025SD5', 1),
(4, 5, 'CALZADA DEL VALLE', 255, 'ote', 'SOLUCIONES Y ASESOR?A TECNOL?GICA EN ENSAYOS NO DESTRUCTIVOS SA DE CV', 'San pedro', 'Del Valle', 'Nuevo Le?n', 'M?xico', '66220', 'SAT1207319S9', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_cat_bss_day`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_cat_bss_day` (
  `pk_bss_day` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `desc_day` varchar(50) NOT NULL,
  `initial_hour` time NOT NULL,
  `final_hour` time NOT NULL,
  `range_time` time NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk_bss_day`),
  UNIQUE KEY `XPKe24_cat_bss_day` (`pk_bss_day`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_cat_bss_day`
--

INSERT INTO `tbl_e24_cat_bss_day` (`pk_bss_day`, `desc_day`, `initial_hour`, `final_hour`, `range_time`, `status`) VALUES
(1, 'Monday', '07:00:00', '20:00:00', '01:30:00', 1),
(2, 'Tuesday', '07:00:00', '20:00:00', '01:30:00', 1),
(3, 'Wednesday', '07:00:00', '20:00:00', '01:30:00', 1),
(4, 'Thursday', '07:00:00', '20:00:00', '01:30:00', 1),
(5, 'Friday', '07:00:00', '20:00:00', '01:30:00', 1),
(6, 'Saturday', '09:00:00', '13:00:00', '03:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_cat_bss_hours`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_cat_bss_hours` (
  `pk_bss_hour` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `initial_hour` time NOT NULL,
  `final_hour` time NOT NULL,
  `range_time` time NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk_bss_hour`),
  UNIQUE KEY `XPKe24_cat_bss_hours` (`pk_bss_hour`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_cat_bss_hours`
--

INSERT INTO `tbl_e24_cat_bss_hours` (`pk_bss_hour`, `initial_hour`, `final_hour`, `range_time`, `status`) VALUES
(2, '06:30:00', '07:00:00', '00:30:00', 1),
(3, '07:00:00', '07:30:00', '00:30:00', 1),
(4, '07:30:00', '08:00:00', '00:30:00', 1),
(5, '08:00:00', '08:30:00', '00:30:00', 1),
(6, '08:30:00', '09:00:00', '00:30:00', 1),
(7, '09:00:00', '09:30:00', '00:30:00', 1),
(8, '09:30:00', '10:00:00', '00:30:00', 1),
(9, '10:00:00', '10:30:00', '00:30:00', 1),
(10, '10:30:00', '11:00:00', '00:30:00', 1),
(11, '11:00:00', '11:30:00', '00:30:00', 1),
(12, '11:30:00', '12:00:00', '00:30:00', 1),
(13, '12:00:00', '12:30:00', '00:30:00', 1),
(14, '12:30:00', '13:00:00', '00:30:00', 1),
(15, '13:00:00', '13:30:00', '00:30:00', 1),
(16, '13:30:00', '14:00:00', '00:30:00', 1),
(17, '14:00:00', '14:30:00', '00:30:00', 1),
(18, '14:30:00', '15:00:00', '00:30:00', 1),
(19, '15:00:00', '15:30:00', '00:30:00', 1),
(20, '15:30:00', '16:00:00', '00:30:00', 1),
(21, '16:00:00', '16:30:00', '00:30:00', 1),
(22, '16:30:00', '17:00:00', '00:30:00', 1),
(23, '17:00:00', '17:30:00', '00:30:00', 1),
(24, '17:30:00', '18:00:00', '00:30:00', 1),
(25, '18:00:00', '18:30:00', '00:30:00', 1),
(26, '18:30:00', '19:00:00', '00:30:00', 1),
(27, '19:00:00', '19:30:00', '00:30:00', 1),
(28, '19:30:00', '20:00:00', '00:30:00', 1),
(29, '20:00:00', '20:30:00', '00:30:00', 1),
(30, '20:30:00', '21:00:00', '00:30:00', 1),
(31, '21:00:00', '21:30:00', '00:30:00', 1),
(32, '21:30:00', '20:00:00', '00:30:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_cat_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_cat_detail` (
  `pk_cat_detail` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `desc_cat_detail_es` varchar(20) NOT NULL,
  `desc_cat_detail_en` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `fk_cat_master` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`pk_cat_detail`),
  UNIQUE KEY `XPKtbl_e24_cat_detail` (`pk_cat_detail`,`fk_cat_master`),
  KEY `fk_cat_master` (`fk_cat_master`),
  KEY `XIF1tbl_e24_cat_detail` (`fk_cat_master`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_cat_detail`
--

INSERT INTO `tbl_e24_cat_detail` (`pk_cat_detail`, `desc_cat_detail_es`, `desc_cat_detail_en`, `status`, `fk_cat_master`) VALUES
(2, 'Empresa', 'Company', 1, 25),
(3, 'Particular', 'Private', 1, 25),
(4, 'Individual', 'Personal', 1, 26),
(5, 'Grupal', 'Group', 1, 26),
(6, 'Maestro', 'Teacher', 1, 27),
(7, 'Alumno', 'Student', 1, 27),
(8, 'Ambos', 'Both', 1, 27),
(9, 'Libro', 'Book', 1, 28),
(10, 'Cuaderno', 'Notebook', 1, 28),
(11, 'Mexicana', 'Mexican', 1, 29),
(12, 'Otra', 'Other', 1, 29),
(13, 'Aguascalientes', 'Aguascalientes', 1, 30),
(14, 'Baja California', 'Baja California', 1, 30),
(15, 'Baja California Sur', 'Baja California Sur', 1, 30),
(16, 'Campeche', 'Campeche', 1, 30),
(17, 'Chiapas', 'Chiapas', 1, 30),
(18, 'Chihuahua', 'Chihuahua', 1, 30),
(19, 'Coahuila', 'Coahuila', 1, 30),
(20, 'Colima', 'Colima', 1, 30),
(21, 'Distrito Federal', 'Distrito Federal', 1, 30),
(22, 'Durango', 'Durango', 1, 30),
(23, 'Estado de México', 'Estado de México', 1, 30),
(24, 'Guanajuato', 'Guanajuato', 1, 30),
(25, 'Guerrero', 'Guerrero', 1, 30),
(26, 'Hidalgo', 'Hidalgo', 1, 30),
(27, 'Jalisco', 'Jalisco', 1, 30),
(28, 'Michoacán', 'Michoacán', 1, 30),
(29, 'Morelos', 'Morelos', 1, 30),
(30, 'Nayarit', 'Nayarit', 1, 30),
(31, 'Nuevo León', 'Nuevo León', 1, 30),
(32, 'Oaxaca', 'Oaxaca', 1, 30),
(33, 'Puebla', 'Puebla', 1, 30),
(34, 'Querétaro', 'Querétaro', 1, 30),
(35, 'Quintana Roo', 'Quintana Roo', 1, 30),
(36, 'San Luis Potosí', 'San Luis Potosí', 1, 30),
(37, 'Sinaloa', 'Sinaloa', 1, 30),
(38, 'Sonora', 'Sonora', 1, 30),
(39, 'Tabasco', 'Tabasco', 1, 30),
(40, 'Tamaulipas', 'Tamaulipas', 1, 30),
(41, 'Tlaxcala', 'Tlaxcala', 1, 30),
(42, 'Veracruz', 'Veracruz', 1, 30),
(43, 'Yucatán', 'Yucatán', 1, 30),
(44, 'Zacatecas', 'Zacatecas', 1, 30),
(46, 'Escuela', 'School', 1, 31),
(47, 'Secundaria', 'Junior High School', 1, 31),
(48, 'Preparatoria', 'preparatoria', 1, 31),
(49, 'Universidad', 'High School', 1, 31),
(50, 'Licenciatura', 'University', 1, 31),
(51, 'Posgrado', 'Master', 1, 31),
(52, 'Doctorado', 'Doctorate', 1, 31),
(53, 'Doctorado', 'Doctorate', 0, 31),
(54, 'En regla', 'In order', 1, 32),
(55, 'En proceso', 'In progress', 1, 32),
(56, 'Vencida', 'Expired', 1, 32),
(57, 'No tiene', 'Hasn''t', 1, 32),
(58, 'Estudiante', 'Student', 1, 33),
(59, 'Maestro', 'Teacher', 1, 33),
(60, 'Cliente', 'Client', 1, 33),
(61, 'Administrador', 'Administrator', 1, 33),
(62, 'Super Usuario', 'Super User', 1, 33),
(63, 'Revista', 'Revista', 1, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_cat_documents`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_cat_documents` (
  `pk_document` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `desc_document` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk_document`),
  UNIQUE KEY `XPKtbl_e24_cat_documents` (`pk_document`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_cat_documents`
--

INSERT INTO `tbl_e24_cat_documents` (`pk_document`, `desc_document`, `status`) VALUES
(1, 'Acta de Nacimiento', 1),
(2, 'Comprobante de Domicilio', 1),
(3, 'Curriculum', 1),
(4, 'Copia Idenficación Oficial', 1),
(5, 'RFC', 1),
(6, 'Comprobante de Estudios', 1),
(7, 'Datos Bancarios', 1),
(8, 'Fotografías (2)', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_cat_levels`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_cat_levels` (
  `pk_level` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `desc_level` varchar(50) NOT NULL,
  `fk_associated_book` smallint(5) unsigned NOT NULL,
  `total_hours` tinyint(3) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk_level`),
  UNIQUE KEY `XPKe24_cat_levels` (`pk_level`),
  KEY `XIF1e24_cat_levels` (`fk_associated_book`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_cat_levels`
--

INSERT INTO `tbl_e24_cat_levels` (`pk_level`, `desc_level`, `fk_associated_book`, `total_hours`, `status`) VALUES
(3, 'Basico 1', 1, 50, 0),
(4, 'Nivel Prueba 5hr', 1, 5, 0),
(5, 'Nivel Prueba 3hr', 1, 3, 0),
(6, 'Elementary 1', 2, 50, 1),
(7, 'Intermediate 1', 2, 50, 1),
(8, 'Intermediate 2', 2, 50, 1),
(9, 'Proficiency 1', 2, 50, 1),
(10, 'Proficiency 2', 2, 50, 1),
(11, 'Advanced 1', 2, 50, 1),
(12, 'Advanced 2', 2, 50, 1),
(13, 'Elementary 2', 2, 50, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_cat_level_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_cat_level_detail` (
  `pk_level_detail` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_level` mediumint(8) unsigned NOT NULL,
  `topics` varchar(100) NOT NULL,
  `duration` time NOT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `pages` varchar(100) DEFAULT NULL,
  `is_exam` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk_level_detail`),
  UNIQUE KEY `XPKe24_cat_level_detail` (`fk_level`,`pk_level_detail`),
  KEY `fk_level` (`fk_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=308 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_cat_level_detail`
--

INSERT INTO `tbl_e24_cat_level_detail` (`pk_level_detail`, `fk_level`, `topics`, `duration`, `unit`, `pages`, `is_exam`, `status`) VALUES
(2, 3, 'KEY VOCABULARY: LANGUAGES AND COUNTRIES', '01:30:00', '1.0', '4, 5', 0, 1),
(3, 3, 'PRESENT SIMPLE AND PRESENT CONTINUOUS', '01:30:00', '1.1', '6, 7', 0, 1),
(4, 3, 'WH QUESTION WORDS/ YES, NO QUESTIONS', '01:30:00', '1.2', '8, 9', 0, 1),
(5, 3, 'TALK ABOUT COMMUNICATION AND LIFE IN OTHER PLANETS', '01:30:00', '1.3', '10, 11', 0, 1),
(6, 3, 'CHECKING UNDERSTANDING/ PLANNING YOUR LANGUAGE LEARNING', '01:30:00', '1.4-1.5', '12, 13', 0, 1),
(7, 3, 'KEY VOCABULARY: GEOGRAPHY', '01:30:00', '2.0', '14, 15', 0, 1),
(8, 3, 'PRACTICE THE PAST SIMPLE', '01:30:00', '2.1', '16, 17', 0, 1),
(9, 3, 'TALK ABOUT WHAT WAS HAPPENING IN THE PAST', '01:30:00', '2.2', '18, 19', 0, 1),
(10, 3, 'TALK ABOUT MORE THAN ONE ACTION IN THE PAST', '01:30:00', '2.3', '20, 21', 0, 1),
(11, 3, 'CHECKING IN/ A VACATION REVIEW', '01:30:00', '2.4 - 2.5', '22, 23', 0, 1),
(12, 3, 'KEY VOCABULARY: LANDMARKS', '01:30:00', '3.0 ', '24, 25', 0, 1),
(13, 3, 'PRACTICE RELATIVE CLAUSES', '01:30:00', '3.1', '26, 27', 0, 1),
(14, 3, 'PRACTICE ARTICLES', '01:30:00', '3.2', '28, 29', 0, 1),
(15, 3, 'DISCUSS CULTURAL ICONS', '01:30:00', '3.3', '30, 31', 0, 1),
(16, 3, 'EXPRESSING PREFERENCE/ DISIGNING A LOGO', '01:30:00', '3.4 - 3.5', '32, 33', 0, 1),
(17, 3, 'UNIT 1, 2, 3 ---BRING IT TOGETHER 1, 2, 3', '01:30:00', 'REVIEW A', '34, 35, 36, 37', 0, 1),
(18, 3, 'KEY VOCABULARY: LIFE STAGES', '01:30:00', '4.0', '38, 39', 0, 1),
(19, 3, 'PRACTICE THE PRESENT PERFECT', '01:30:00', '4.1', '40, 41', 0, 1),
(20, 3, 'PRESENT PERFECT VS. PAST SIMPLE WITH FOR OR SINCE', '01:30:00', '4.2', '42, 43', 0, 1),
(21, 3, 'PRACTICE COMPARATIVES AND SUPERLATIVES', '01:30:00', '4.3', '44, 45', 0, 1),
(22, 3, 'CATCHING UP/ AN INFORMAL E-MAIL', '01:30:00', '4.4, 4.5', '46, 47', 0, 1),
(23, 3, 'KEY VOCABULARY: EDUCATION AND LEARNING', '01:30:00', '5.0', '48, 49', 0, 1),
(24, 3, 'PRACTICE FUTURE PLANS', '01:30:00', '5.1', '50, 51', 0, 1),
(25, 3, 'PRACTICE MUST AND MUSTN''T FOR OBLIGATION', '01:30:00', '5.2', '52, 53', 0, 1),
(26, 3, 'PRACTICE ADJECTIVES AND PREPOSITIONS', '01:30:00', '5.3', '54, 55', 0, 1),
(27, 3, 'SOUNDING POLITE/ A TELEPHONE INQUIRY', '01:30:00', '5.4, 5.5', '56, 57', 0, 1),
(28, 3, 'KEY VOCABULARY: HELP: JOBS AND SERVICES', '01:30:00', '6.0', '58, 59', 0, 1),
(29, 3, 'PRACTICE MODAL VERBS: CAN, CAN''T, SHOULD, SHOULDN''T', '01:30:00', '6.1', '60, 61', 0, 1),
(30, 3, 'PRACTICE PREDICTIONS WITH WILL, MAY, MIGHT', '01:30:00', '6.2', '62, 63', 0, 1),
(31, 3, 'PRACTICE VOCABULARY TO DESCRIBE AILMENTS', '01:30:00', '6.3', '64, 65', 0, 1),
(32, 3, 'ADVICE/ A FORMAL E-MAIL', '01:30:00', '6.4, 6.5', '66, 67', 0, 1),
(33, 3, 'UNIT 4, 5, 6 ---BRING IT TOGETHER 4, 5, 6', '01:30:00', 'REVIEW B', '68, 69, 70, 71', 0, 1),
(34, 3, 'FINAL EXAM AND REVIEW', '01:30:00', 'Final Exam', 'Final Exam', 1, 1),
(35, 3, 'EJEMPLO TEMA UPD', '01:30:00', '1,4', '5', 0, 1),
(36, 4, 'TEMA 1 UPD', '02:00:00', '1,2', '2,3,4', 0, 1),
(37, 4, 'TEMA 2 UPD', '02:00:00', '3', '3,5,6', 0, 1),
(38, 4, 'TEMA 3', '01:30:00', '4', '5,7,8', 0, 1),
(39, 5, 'TEMA 1', '01:00:00', '1', '1,2', 0, 1),
(40, 5, 'TEMA 2', '01:00:00', '2', '3,4', 0, 1),
(41, 5, 'EXAMEN', '01:00:00', 'EXAMEN', 'EXAMEN', 1, 1),
(42, 7, 'A.- Who''s who?', '01:30:00', '1', '4-5', 0, 1),
(43, 7, 'B.- Who knows you better?', '01:30:00', '1', '6-7', 0, 1),
(44, 7, 'Extra Activity', '01:30:00', '1', '', 0, 1),
(45, 7, 'C.- At the Moulin Rouge', '01:30:00', '1', '8-9', 0, 1),
(46, 7, 'D.- The Devil''s Dictionary', '01:30:00', '1', '10-11', 0, 1),
(47, 7, 'Practical English & Writing', '01:30:00', '1', '12-13', 0, 1),
(48, 7, 'Review & Check', '01:30:00', '1', '14-15', 0, 1),
(49, 7, 'Extra Actiivity', '01:30:00', '1', '', 0, 1),
(50, 7, 'A.- Right place, wrong time', '01:30:00', '2', '16-17', 0, 1),
(51, 7, 'B.- A moment in time', '01:30:00', '2', '18-19', 0, 1),
(52, 7, 'C.- Fifty years of pop music', '01:30:00', '2', '20-21', 0, 1),
(53, 7, 'Extra Activity', '01:30:00', '2', '', 0, 1),
(54, 7, 'D.- One October evening', '01:30:00', '2', '22-23', 0, 1),
(55, 7, 'Practical English & Writing', '01:30:00', '2', '24-25', 0, 1),
(56, 7, 'Review & Check', '01:30:00', '2', '26-27', 0, 1),
(57, 7, 'mid-term exam', '01:30:00', '1-2', '', 1, 1),
(58, 7, 'A.- Where are you going?', '01:30:00', '3', '28-29', 0, 1),
(59, 7, 'B.- The pessimist''s phrase book', '01:30:00', '3', '30-31', 0, 1),
(60, 7, 'Extra Activity', '01:30:00', '3', '', 0, 1),
(61, 7, 'C.-I''ll always love you', '01:30:00', '3', '32-33', 0, 1),
(62, 7, 'D.- I was only dreaming', '01:30:00', '3', '34-35', 0, 1),
(63, 7, 'Practical English & Writing', '01:30:00', '3', '36-37', 0, 1),
(64, 7, 'Review & Check', '01:30:00', '3', '38-39', 0, 1),
(65, 7, 'Extra Activity', '01:30:00', '3', '', 0, 1),
(66, 7, 'A.-From rags to riches', '01:30:00', '4', '40-41', 0, 1),
(67, 7, 'Family conflicts', '01:30:00', '4', '42-43', 0, 1),
(68, 7, 'Extra Activity', '01:30:00', '4', '', 0, 1),
(69, 7, 'C.- Faster, faster!', '01:30:00', '4', '44-45', 0, 1),
(70, 7, 'D.- The world''s friendliest city', '01:30:00', '4', '46-47', 0, 1),
(71, 7, 'Practical English & Writing', '01:30:00', '4', '48-49', 0, 1),
(72, 7, 'Review & Check', '01:30:00', '4', '50-51', 0, 1),
(73, 7, 'Extra Activity', '01:30:00', '1-4', '', 0, 1),
(74, 7, 'Final Exam', '02:00:00', '1-4', '', 1, 1),
(75, 8, 'A.- Are you a party animal?', '01:30:00', '5', '52-53', 0, 1),
(76, 8, 'B.- What makes you feel good?', '01:30:00', '5', '54-55', 0, 1),
(77, 8, 'C.- How much ca you learn in a month?', '01:30:00', '5', '56-57', 0, 1),
(78, 8, 'D.- The name of the game', '01:30:00', '5', '58-59', 0, 1),
(79, 8, 'Practical English & Writing', '01:30:00', '5', '60-61', 0, 1),
(80, 8, 'Review & Check', '01:30:00', '5', '62-63', 0, 1),
(81, 8, 'Extra Activity', '01:30:00', '5', '', 0, 0),
(82, 8, 'A.- If something bad can happen, it will', '01:30:00', '6', '64-65', 0, 1),
(83, 8, 'B.- Never smile at a crocodile', '01:30:00', '6', '66-67', 0, 1),
(84, 8, 'C.- Decisions, decisions', '01:30:00', '6', '68-69', 0, 1),
(85, 8, 'D.- What should I do?', '01:30:00', '6', '70-71', 0, 1),
(86, 8, 'Practical English & Writing', '01:30:00', '6', '72-73', 0, 1),
(87, 8, 'Review & Check', '01:30:00', '6', '74-75', 0, 1),
(88, 8, 'Extra Activity', '01:30:00', '5-6', '', 0, 1),
(89, 8, 'Mdy-Term Exam', '01:30:00', '5-6', '', 1, 1),
(90, 8, 'A.- Famous fears and phobias', '01:30:00', '7', '76-77', 0, 1),
(91, 8, 'A.- Famous fears and phobias', '01:30:00', '7', '76-77', 0, 1),
(92, 8, 'B.- Bron to direct', '01:30:00', '7', '78-79', 0, 1),
(93, 8, 'C.- I used to be a rebel', '01:30:00', '7', '80-81', 0, 1),
(94, 8, 'D.- The mothers of invention', '01:30:00', '7', '82-83', 0, 1),
(95, 8, 'Practical English & Writing', '01:30:00', '7', '84-85', 0, 1),
(96, 8, 'Review & Check', '01:30:00', '7', '86-87', 0, 1),
(97, 8, 'Extra Activity', '01:30:00', '7', '', 0, 0),
(98, 8, 'A.- I hate weekends!', '01:30:00', '8', '88-89', 0, 1),
(99, 8, 'B.- How old is your body?', '01:30:00', '8', '90-91', 0, 1),
(100, 8, 'C.- Waking up is hard to do', '01:30:00', '8', '92-93', 0, 1),
(101, 8, 'D.- "I''m Jim." "So am I."', '01:30:00', '8', '94-95', 0, 1),
(102, 8, 'Practical English & Writing', '01:30:00', '8', '96-97', 0, 1),
(103, 8, 'Review & Check', '01:30:00', '8', '98-99', 0, 1),
(104, 8, 'A.- What a week!', '01:30:00', '9', '100-101', 0, 1),
(105, 8, 'B.- Then he kissed me', '01:30:00', '9', '102-103', 0, 1),
(106, 8, 'Grammar', '01:30:00', '9', '104-105', 0, 1),
(107, 8, 'Vocabulary, Pronunciation', '01:30:00', '9', '106-107', 0, 1),
(108, 8, 'Extra Activity', '01:30:00', '7-9', '', 0, 1),
(109, 8, 'Final Exam', '02:00:00', '5-9', '', 1, 1),
(110, 9, 'A.- Q and A', '01:30:00', '1', '4-5', 0, 1),
(111, 9, 'A.- Q and A', '01:30:00', '1', '6-7', 0, 1),
(112, 9, 'B.- Do you believe it?', '01:30:00', '1', '8-9', 0, 1),
(113, 9, 'B.- Do you believe it?', '01:30:00', '1', '10-11', 0, 1),
(114, 9, 'Extra Activity', '01:30:00', '1', '', 0, 1),
(115, 9, 'C.- You''re the doctor!', '01:30:00', '1', '12-13', 0, 1),
(116, 9, 'C.- You''re the doctor!', '01:30:00', '1', '14-15', 0, 1),
(117, 9, 'Collaquial English & Writing', '01:30:00', '1', '16-17', 0, 1),
(118, 9, 'Review & Check', '01:30:00', '1', '18-19', 0, 1),
(119, 9, 'Extra Activity', '01:30:00', '1', '', 0, 1),
(120, 9, 'A.- National treotypes truth or myth?', '01:30:00', '2', '20-21', 0, 1),
(121, 9, 'A.- National treotypes truth or myth?', '01:30:00', '2', '22-23', 0, 1),
(122, 9, 'B.- Air travel: the inside story', '01:30:00', '2', '24-25', 0, 1),
(123, 9, 'B.- Air travel: the inside story', '01:30:00', '2', '26-27', 0, 1),
(124, 9, 'Extra Activity', '01:30:00', '2', '', 0, 1),
(125, 9, 'C.- Incredibly short stories', '01:30:00', '2', '28-29', 0, 1),
(126, 9, 'C.- Incredibly short stories', '01:30:00', '2', '30-31', 0, 1),
(127, 9, 'Colloquial English & Writing', '01:30:00', '2', '32-33', 0, 1),
(128, 9, 'Review & Check', '01:30:00', '2', '34-35', 0, 1),
(129, 9, 'Extra Activity', '01:30:00', '2', '', 0, 1),
(130, 9, 'Mid-term Exam', '01:30:00', '1-2', '', 1, 1),
(131, 9, 'A.- The one placea burglar won''t look', '01:30:00', '3', '36-37', 0, 1),
(132, 9, 'A.- The one placea burglar won''t look', '01:30:00', '3', '38-39', 0, 1),
(133, 9, 'Extra Activity', '01:30:00', '3', '', 0, 1),
(134, 9, 'B.- Stormy weather', '01:30:00', '3', '40-41', 0, 1),
(135, 9, 'B.- Stormy weather', '01:30:00', '3', '42-43', 0, 1),
(136, 9, 'Extra Activity', '01:30:00', '3', '', 0, 1),
(137, 9, 'C.- Taking a risk', '01:30:00', '3', '44-45', 0, 1),
(138, 9, 'C.- Taking a risk', '01:30:00', '3', '46-47', 0, 1),
(139, 9, 'Colloquial English & Writing', '01:30:00', '3', '48-49', 0, 1),
(140, 9, 'Review & Check', '01:30:00', '3', '50-51', 0, 1),
(141, 9, 'Extra Activity', '01:30:00', '3', '', 0, 1),
(142, 9, 'Final Exam', '02:00:00', '1-3', '', 1, 1),
(143, 10, 'A.- Would you get out alive?', '01:30:00', '4', '52-53', 0, 1),
(144, 10, 'A.- Would you get out alive?', '01:30:00', '4', '54-55', 0, 1),
(145, 10, 'B.-How I trained my husband', '01:30:00', '4', '56-57', 0, 1),
(146, 10, 'B.-How I trained my husband', '01:30:00', '4', '58-59', 0, 1),
(147, 10, 'C.- Let your body do the talking', '01:30:00', '4', '60-61', 0, 1),
(148, 10, 'C.- Let your body do the talking', '01:30:00', '4', '62-63', 0, 1),
(149, 10, 'Colloquial English & Writing', '01:30:00', '4', '64-65', 0, 1),
(150, 10, 'Review & Check', '01:30:00', '4', '66-67', 0, 1),
(151, 10, 'A.- The psychology of music', '01:30:00', '5', '68-69', 0, 1),
(152, 10, 'A.- The psychology of music', '01:30:00', '5', '70-71', 0, 1),
(153, 10, 'B.- Counting sheep', '01:30:00', '5', '72-73', 0, 1),
(154, 10, 'B.- Counting sheep', '01:30:00', '5', '78-79', 0, 1),
(155, 10, 'Colloquial English & Writing', '01:30:00', '5', '80-81', 0, 1),
(156, 10, 'Review & Check', '01:30:00', '5', '82-83', 0, 1),
(157, 10, 'Mid-term Exam', '01:30:00', '4-5', '', 1, 1),
(158, 10, 'A.- Speaking to the world', '01:30:00', '6', '84-85', 0, 1),
(159, 10, 'A.- Speaking to the world', '01:30:00', '6', '86-87', 0, 1),
(160, 10, 'B.- Brigth ligths, big city', '01:30:00', '6', '88-89', 0, 1),
(161, 10, 'B.- Brigth ligths, big city', '01:30:00', '6', '90-91', 0, 1),
(162, 10, 'C.- Eureka!', '01:30:00', '6', '92-93', 0, 1),
(163, 10, 'C.- Eureka!', '01:30:00', '6', '94-95', 0, 1),
(164, 10, 'Colloquial English & Writing', '01:30:00', '6', '96-97', 0, 1),
(165, 10, 'Review & Check', '01:30:00', '6', '98-99', 0, 1),
(166, 10, 'A.- I wish you wouldn''t...!', '01:30:00', '7', '100-101', 0, 1),
(167, 10, 'A.- I wish you wouldn''t...!', '01:30:00', '7', '102-103', 0, 1),
(168, 10, 'A.- I wish you wouldn''t...!', '01:30:00', '7', '102-103', 0, 1),
(169, 10, 'B.- A test of honesty', '01:30:00', '7', '104-105', 0, 1),
(170, 10, 'B.- A test of honesty', '01:30:00', '7', '106-107', 0, 1),
(171, 10, 'C.- Tingo', '01:30:00', '7', '108-109', 0, 1),
(172, 10, 'C.- Tingo', '01:30:00', '7', '110-111', 0, 1),
(173, 10, 'C.- Tingo', '01:30:00', '7', '110-111', 0, 1),
(174, 10, '-Colloquial English\r\n-Writing\r\n-Review & Check', '01:30:00', '7', '112-115', 0, 1),
(175, 10, 'Final Exam', '02:00:00', '4-7', '', 1, 1),
(176, 11, 'A.- Food: fuel or pleasure?', '01:30:00', '1', '4-5', 0, 1),
(177, 11, 'A.- Food: fuel or pleasure?', '01:30:00', '1', '6-7', 0, 1),
(178, 11, 'B.- If you really to win, cheat', '01:30:00', '1', '8-9', 0, 1),
(179, 11, 'B.- If you really to win, cheat', '01:30:00', '1', '10-11', 0, 1),
(180, 11, 'C.- We are family', '01:30:00', '1', '12-13', 0, 1),
(181, 11, 'C.- We are family', '01:30:00', '1', '14-15', 0, 1),
(182, 11, 'Practical English & Writing', '01:30:00', '1', '16-17', 0, 1),
(183, 11, 'Review & Check', '01:30:00', '1', '18-19', 0, 1),
(184, 11, 'A.- Ka-ching!', '01:30:00', '2', '20-21', 0, 1),
(185, 11, 'A.- Ka-ching!', '01:30:00', '2', '22-23', 0, 1),
(186, 11, 'B.- Changing your life', '01:30:00', '2', '24-25', 0, 1),
(187, 11, 'B.- Changing your life', '01:30:00', '2', '26-27', 0, 1),
(188, 11, 'C.-Still friends?', '01:30:00', '4', '62-63', 0, 1),
(189, 11, 'C.- Race to the sun', '01:30:00', '2', '28-29', 0, 1),
(190, 11, 'C.- Race to the sun', '01:30:00', '2', '30-31', 0, 1),
(191, 11, 'Practical English & writing', '01:30:00', '2', '32-33', 0, 1),
(192, 11, 'Review & Check', '01:30:00', '2', '34-35', 0, 1),
(193, 11, 'Mid-therm Exam', '01:30:00', '1-2', '', 1, 1),
(194, 11, 'A.- Modern manners', '01:30:00', '3', '36-37', 0, 1),
(195, 11, 'A.- Modern manners', '01:30:00', '3', '38-39', 0, 1),
(196, 11, 'B.- Judging by appearances', '01:30:00', '3', '40-41', 0, 1),
(197, 11, 'B.- Judging by appearances', '01:30:00', '3', '42-43', 0, 1),
(198, 11, 'C.- If at first you don''t succeed,...', '01:30:00', '3', '44-45', 0, 1),
(199, 11, 'C.- If at first you don''t succeed,...', '01:30:00', '3', '46-47', 0, 1),
(200, 11, 'Practical English & Writing', '01:30:00', '3', '48-49', 0, 1),
(201, 11, 'Review & Check', '01:30:00', '3', '50-51', 0, 1),
(202, 11, 'A.- Back to school, age 35', '01:30:00', '4', '52-53', 0, 1),
(203, 11, 'A.- Back to school, age 35', '01:30:00', '4', '54-55', 0, 1),
(204, 11, 'B.- In an Ideal World...', '01:30:00', '4', '56-57', 0, 1),
(205, 11, 'B.- In an Ideal World...', '01:30:00', '4', '58-59', 0, 1),
(206, 11, 'C.- Still Friends?', '01:30:00', '4', '60-61', 0, 1),
(207, 11, 'Review & Check', '01:30:00', '4', '64-67', 0, 1),
(208, 11, 'Final Exam', '02:00:00', '1-4', '', 1, 1),
(209, 12, 'A.- Slow Down, you move too fast', '01:30:00', '5', '68-69', 0, 1),
(210, 12, 'A.- Slow Down, you move too fast', '01:30:00', '5', '70-71', 0, 1),
(211, 12, 'Extra Activity', '01:30:00', '5', '', 0, 1),
(212, 12, 'B.- Same planet, Different worlds', '01:30:00', '5', '72-73', 0, 1),
(213, 12, 'B.- Same planet, Different worlds', '01:30:00', '5', '74-75', 0, 1),
(214, 12, 'Extra Activity', '01:30:00', '5', '', 0, 1),
(215, 12, 'C.- Job Swap', '01:30:00', '5', '76-77', 0, 1),
(216, 12, 'C.- Job Swap', '01:30:00', '5', '78-79', NULL, 1),
(217, 12, 'Practical English & Writing', '01:30:00', '5', '80-81', 0, 1),
(218, 12, 'Review & Check', '01:30:00', '5', '82-83', 0, 1),
(219, 12, 'Mid.therm Exam', '01:30:00', '5', '', 1, 1),
(220, 12, 'A.- Love in the supermarket', '01:30:00', '6', '84-85', 0, 1),
(221, 12, 'A.- Love in the supermarket', '01:30:00', '6', '86-87', 0, 1),
(222, 12, 'B.-See the movie... get on a plane', '01:30:00', '6', '88-89', 0, 1),
(223, 12, 'B.-See the movie... get on a plane', '01:30:00', '6', '90-91', 0, 1),
(224, 12, 'C.- I need a hero', '01:30:00', '6', '92-93', 0, 1),
(225, 12, 'C.- I need a hero', '01:30:00', '6', '94-95', 0, 1),
(226, 12, 'Practical English & Writing', '01:30:00', '6', '96-97', 0, 1),
(227, 12, 'Review & Check ', '01:30:00', '6', '98-99', 0, 1),
(228, 12, 'Extra Activity', '01:30:00', '6', '', 0, 1),
(229, 12, 'Extra Activity', '01:30:00', '6', '', 0, 1),
(230, 12, 'A.- Can we make our own luck?', '01:30:00', '7', '100-101', 0, 1),
(231, 12, 'A.- Can we make our own luck?', '01:30:00', '7', '102-103', 0, 1),
(232, 12, 'Extra Activity', '01:30:00', '7', '', 0, 1),
(233, 12, 'B.- Murder mysteries', '01:30:00', '7', '104-105', 0, 1),
(234, 12, 'B.- Murder mysteries', '01:30:00', '7', '106-107', 0, 1),
(235, 12, 'Extra Activity', '01:30:00', '7', '', 0, 1),
(236, 12, 'C.- Trun it off', '01:30:00', '7', '108-109', 0, 1),
(237, 12, 'C.- Trun it off', '01:30:00', '7', '110', 0, 1),
(238, 12, 'Practical English & Writing', '01:30:00', '7', '112-113', 0, 1),
(239, 12, 'Review & Check', '01:30:00', '7', '114-115', 0, 1),
(240, 12, 'Extra Activity', '01:30:00', '6', '', 0, 1),
(241, 12, 'Final Exam', '02:00:00', '5-7', '', 1, 1),
(242, 6, 'A.- Nice to meet you', '01:30:00', '1', '4-5', 0, 1),
(243, 6, 'B.- I''m not American, I''m Canadian!\r\n', '01:30:00', '1', '6-7', 0, 1),
(244, 6, 'C.- His name, her name', '01:30:00', '1', '8-9', 0, 1),
(245, 6, 'D.- Trun off your cell phones!', '01:30:00', '1', '10-11', 0, 1),
(246, 6, 'Practical English & Writing', '01:30:00', '1', '12-13', 0, 1),
(247, 6, 'Review & Check', '01:30:00', '1', '14-15', 0, 1),
(248, 6, 'Extra Activity', '01:30:00', '1', '', 0, 1),
(249, 6, 'Extra Activity', '01:30:00', '1', '', 0, 1),
(250, 6, 'A.- Cappuccino and fries', '01:30:00', '2', '16-17', 0, 1),
(251, 6, 'B.- When Natasha meets Darren', '01:30:00', '2', '18-19', 0, 1),
(252, 6, 'C.- An Artist and a musician', '01:30:00', '2', '20-21', 0, 1),
(253, 6, 'Extra Activity', '01:30:00', '2', '', 0, 1),
(254, 6, 'D.- Relatively Famous', '01:30:00', '2', '22-23', 0, 1),
(255, 6, 'Practical English & Writing', '01:30:00', '2', '24-25', 0, 1),
(256, 6, 'Review & Check', '01:30:00', '2', '26-27', 0, 1),
(257, 6, 'Extra Activity', '01:30:00', '2', '', 0, 1),
(258, 6, 'Mid-Term Exam', '01:30:00', '1-2', '', 1, 1),
(259, 6, 'A.- Pretty woman', '01:30:00', '3', '28-29', 0, 1),
(260, 6, 'B.- Wake up, get out of bed...', '01:30:00', '3', '30-31', 0, 1),
(261, 6, 'C.- The island whit a secret', '01:30:00', '3', '32-33', 0, 1),
(262, 6, 'Extra Activity', '01:30:00', '3', '', 0, 1),
(263, 6, 'D.- On the last wednsday in Agust', '01:30:00', '3', '34-35', 0, 1),
(264, 6, 'Practical English & Writing', '01:30:00', '3', '36-37', 0, 1),
(265, 6, 'Review & Check', '01:30:00', '3', '38-39', 0, 1),
(266, 6, 'Extra Activity', '01:30:00', '3', '', 0, 1),
(267, 6, 'A.- I can''t Dance', '01:30:00', '4', '40-41', 0, 1),
(268, 6, 'B.- Shopping-men love it!', '01:30:00', '4', '42-43', 0, 1),
(269, 6, 'C.- Fatal acttraction?', '01:30:00', '4', '44-45', 0, 1),
(270, 6, 'D.- Are you still mine?', '01:30:00', '4', '46-47', 0, 1),
(271, 6, 'Practical English & Writing', '01:30:00', '4', '48-49', 0, 1),
(272, 6, 'Review & Check', '01:30:00', '4', '50-51', 0, 1),
(273, 6, 'Extra Activity', '01:30:00', '4', '', 0, 1),
(274, 6, 'Final Exam', '02:00:00', '1-4', '', 1, 1),
(275, 13, 'A.- Who were they?', '01:30:00', '5', '52-53', 0, 1),
(276, 13, 'B.- Sydney, here we come!', '01:30:00', '5', '54-55', 0, 1),
(277, 13, 'C.- Girls'' night out', '01:30:00', '5', '56-57', 0, 1),
(278, 13, 'D.- Murder in a massion', '01:30:00', '5', '58-59', 0, 1),
(279, 13, 'Practical English & Writiing', '01:30:00', '5', '60-61', 0, 1),
(280, 13, 'Review & Check', '01:30:00', '5', '62-63', 0, 1),
(281, 13, 'Extra Activity', '01:30:00', '5', '', 0, 1),
(282, 13, 'A.- A house with a history', '01:30:00', '6', '64-65', 0, 1),
(283, 13, 'B.- A night innaunted hotel', '01:30:00', '6', '66-67', 0, 1),
(284, 13, 'C.- Nightmare neighbors', '01:30:00', '6', '68-69', 0, 1),
(285, 13, 'D.- New York, New York', '01:30:00', '6', '70-71', 0, 1),
(286, 13, 'Practical English & Writing', '01:30:00', '6', '72-73', 0, 1),
(287, 13, 'Review & Check', '01:30:00', '6', '74-75', 0, 1),
(288, 13, 'Mid-Term Exam', '01:30:00', '5-6', '', 1, 1),
(289, 13, 'A.- What does your food say about you?', '01:30:00', '7', '76-77', 0, 1),
(290, 13, 'B.- How much water do we really need?', '01:30:00', '7', '78-79', 0, 1),
(291, 13, 'C.- Trading vacations', '01:30:00', '7', '80-81', 0, 1),
(292, 13, 'D.- It''s written in the cards', '01:30:00', '7', '82-83', 0, 1),
(293, 13, 'Practical English & Writing', '01:30:00', '7', '84-85', 0, 1),
(294, 13, 'Review & Check', '01:30:00', '7', '86-87', 0, 1),
(295, 13, 'Extra Activity', '01:30:00', '7', '', 0, 1),
(296, 13, 'A.- The True Flase Show', '01:30:00', '8', '88-89', 0, 1),
(297, 13, 'B.- The highest city in the world', '01:30:00', '8', '90-91', 0, 1),
(298, 13, 'C.- Would you like to drive a Ferrari?', '01:30:00', '8', '92-93', 0, 1),
(299, 13, 'D.- They dress well but drive badly', '01:30:00', '8', '94-95', 0, 1),
(300, 13, 'Practical English & Writing', '01:30:00', '8', '96-97', 0, 1),
(301, 13, 'Review & Check', '01:30:00', '8', '98-99', 0, 1),
(302, 13, 'Extra Activity', '01:30:00', '8', '', 0, 1),
(303, 13, 'A.- Before we met', '01:30:00', '9', '100-101', 0, 1),
(304, 13, 'B.- I''ve read the book, I''ve seen the movie', '01:30:00', '9', '102-103', 0, 1),
(305, 13, 'Grammar', '01:30:00', '9', '104-105', 0, 1),
(306, 13, 'Vocabulary', '01:30:00', '9', '106-107', 0, 1),
(307, 13, 'Final Exam', '02:00:00', '5-9', '', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_cat_master`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_cat_master` (
  `pk_cat_master` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `desc_cat_master` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk_cat_master`),
  UNIQUE KEY `XPKtbl_e24_cat_master` (`pk_cat_master`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_cat_master`
--

INSERT INTO `tbl_e24_cat_master` (`pk_cat_master`, `desc_cat_master`, `status`) VALUES
(25, 'Tipos de Cliente', 1),
(26, 'Tipos de Cursos', 1),
(27, 'Roles en Clase', 1),
(28, 'Tipos de Material', 1),
(29, 'Nacionalidad', 1),
(30, 'Estados', 1),
(31, 'Escolaridad', 1),
(32, 'Estatus Papeleria', 1),
(33, 'Rol de Usuario', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_cat_material`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_cat_material` (
  `pk_material` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `desc_material` varchar(50) NOT NULL,
  `fk_type_material` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`pk_material`),
  UNIQUE KEY `XPKe24_cat_material` (`pk_material`),
  KEY `XIF1e24_cat_material` (`fk_type_material`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_cat_material`
--

INSERT INTO `tbl_e24_cat_material` (`pk_material`, `desc_material`, `fk_type_material`) VALUES
(1, 'ABP.B1 SPLIT A', 9),
(2, 'ABP.B1 SPLIT A Cuaderno', 10),
(3, 'Ejemplo Material Upd', 63),
(4, 'American English File 2 Kit SB and WB', 9),
(10, 'American English File 2 Work book', 10),
(11, 'American English File 2 Kit SB and WB', 9),
(12, 'American English File 2 Work book', 10),
(13, 'American English File 3 Kit SB and WB', 9),
(14, 'American English File 3 Kit SB and WB', 9),
(15, 'American English File 3 Kit SB and WB', 9),
(16, 'American English File 4 Kit SB and WB', 9),
(17, 'American English File 4 Kit SB and WB', 9),
(18, 'American English File 1 Kit SB and WB', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_cat_material_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_cat_material_detail` (
  `pk_material_detail` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Campo indice de la tabla',
  `material_code` varchar(45) DEFAULT NULL COMMENT 'contiene el codigo de los libros, es para su identificacion ',
  `comment` varchar(300) DEFAULT NULL COMMENT 'Comentarios espesificos del libro',
  `availability` tinyint(1) DEFAULT '1' COMMENT 'Indica la disponibilidad del material: 0 = no dispobible / Prestado, 1= DISPONIBLE',
  `fk_cat_material` smallint(5) unsigned NOT NULL COMMENT 'corresponde al campo referencia en la tabla catalogo de materiales',
  PRIMARY KEY (`pk_material_detail`),
  UNIQUE KEY `codigo_UNIQUE` (`material_code`,`fk_cat_material`),
  KEY `XIF1e24_material_detail` (`fk_cat_material`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Tabla generada para contener informacion detallada de los li' AUTO_INCREMENT=17 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_cat_material_detail`
--

INSERT INTO `tbl_e24_cat_material_detail` (`pk_material_detail`, `material_code`, `comment`, `availability`, `fk_cat_material`) VALUES
(1, 'AEF2-SB,WB-01', 'Deborah', 0, 4),
(3, 'AEF2-SB,WB-02', 'Jessie ', 0, 4),
(5, 'AEF2-SB,WB-01', '', 0, 11),
(7, 'AEF4-SB,WB-01', 'Student book & Work book', 1, 16),
(8, 'AEF4-SB,WB-01', '', 0, 17),
(9, 'AEF3-SB,WB-01', '', 0, 13),
(10, 'AEF2-SB,WB-03', 'Rossina', 0, 4),
(11, 'AEF2-SB,WB-04', 'Sigfried', 0, 4),
(12, 'AEF1-SB,WB-01', 'Rossina', 0, 18),
(13, 'AEF1-SB,WB-02', 'Sandra', 0, 18),
(14, 'AEF1-SB,WB-03', '', 1, 18),
(15, 'AEF3-SB,WB-01', 'Deborah', 0, 14),
(16, 'AEF2-SB,WB-02', 'Jessie', 1, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_cat_rates`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_cat_rates` (
  `pk_rate` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `desc_tarifa` varchar(50) NOT NULL,
  `rate` double NOT NULL,
  PRIMARY KEY (`pk_rate`),
  UNIQUE KEY `XPKtbl_e24_cat_rates` (`pk_rate`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_cat_rates`
--

INSERT INTO `tbl_e24_cat_rates` (`pk_rate`, `desc_tarifa`, `rate`) VALUES
(1, 'Base', 130.5),
(2, 'Avanzado', 250.5),
(3, 'Intermedio', 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_cat_status_class`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_cat_status_class` (
  `pk_status_class` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `desc_status_class` varchar(25) NOT NULL,
  `long_desc` varchar(200) NOT NULL,
  `is_reschedule_motive` tinyint(1) NOT NULL,
  `fk_type_class` mediumint(8) unsigned NOT NULL,
  `fk_role_class` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`pk_status_class`),
  UNIQUE KEY `XPKe24_cat_status_class` (`pk_status_class`),
  KEY `XIF1e24_cat_status_class` (`fk_type_class`),
  KEY `fk_role_class_pk_cat_detail` (`fk_role_class`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_cat_status_class`
--

INSERT INTO `tbl_e24_cat_status_class` (`pk_status_class`, `desc_status_class`, `long_desc`, `is_reschedule_motive`, `fk_type_class`, `fk_role_class`) VALUES
(1, 'A Tiempo', 'LA CLASE SE LLEVÓ A CABO EN SU HORARIO REGULAR', 0, 4, 6),
(2, 'Retardo', 'LA CLASE SE LLEVÓ A CABO CON UN RETRASO POR CAUSA DEL ALUMNO', 0, 4, 6),
(3, 'Canceladaa a tiempo', 'EL ALUMNO CANCELÓ LA CLASE SIN REAGENDAR (2 SESIONES AL MES MÁXIMO, DESPUÉS DE 2 EL SISTEMA BLOQUEA LA POSIBILIDAD DE CANCELAR)', 0, 4, 6),
(4, 'Cancelada fuera de tiempo', 'EL ALUMNO NO ASISTIÓ A CLASE, PERO NO AVISÓ CON TIEMPO, POR LO QUE EL MAESTRO LA PUEDE COBRAR', 0, 4, 6),
(5, 'Recalendarizada', 'LA CLASE SE CAMBIÓ DE DÍA Y/U HORA.', 1, 4, 6),
(6, 'Vacaciones de alumno', 'EL MAESTRO DEBERÁ DE INDICAR LAS CLASES QUE NO SE TOMARÁN POR MOTIVOS DE VACACIONES DEL ALUMNO', 0, 4, 6),
(7, 'Vacaiones de maestro', 'EL MAESTRO DEBERÁ DE INDICAR LAS CLASES QUE NO SE TOMARÁN POR MOTIVOS DE VACACIONES DEL MAESTRO', 0, 4, 6),
(8, 'Dia Feriado', 'LA CLASE NO FUE IMPARTIDA PUES ERA DÍA FESTIVO', 0, 4, 6),
(9, 'Cancelada por el maestro', 'LA CLASE NO FUE IMPARTIDA PUES EL MAESTRO CANCELÓ LA CLASE', 0, 4, 6),
(10, 'A Tiempo', 'LA CLASE SE LLEVÓ A CABO EN SU HORARIO REGULAR', 0, 5, 6),
(11, 'Retardo', 'LA CLASE SE LLEVÓ A CABO CON UN RETRASO POR CAUSA DEL GRUPO	', 0, 5, 6),
(12, 'Canceladaa a tiempo', 'EL GRUPO CANCELÓ LA CLASE SIN REAGENDAR (2 SESIONES AL MES MÁXIMO, DESPUÉS DE 2 EL SISTEMA BLOQUEA LA POSIBILIDAD DE CANCELAR)', 0, 5, 6),
(13, 'Cancelada fuera de tiempo', 'EL GRUOP NO ASISTIÓ A CLASE, PERO NO AVISÓ CON TIEMPO, POR LO QUE EL MAESTRO LA PUEDE COBRAR', 0, 5, 6),
(14, 'Recalendarizada', 'LA CLASE SE CAMBIÓ DE DÍA Y/U HORA.', 1, 5, 6),
(15, 'Vacaciones de alumno', 'EL MAESTRO DEBERÁ DE INDICAR LAS CLASES QUE NO SE TOMARÁN POR MOTIVOS DE VACACIONES DEL GRUPO', 0, 5, 6),
(16, 'Vacaiones de maestro', 'EL MAESTRO DEBERÁ DE INDICAR LAS CLASES QUE NO SE TOMARÁN POR MOTIVOS DE VACACIONES DEL MAESTRO', 0, 5, 6),
(17, 'Dia Feriado', 'LA CLASE NO FUE IMPARTIDA PUES ERA DÍA FESTIVO', 0, 5, 6),
(18, 'Cancelada por el maestro', 'LA CLASE NO FUE IMPARTIDA PUES EL MAESTRO CANCELÓ LA CLASE', 0, 5, 6),
(19, 'Asistió', 'Asistió', 0, 5, 7),
(20, 'Ausencia', 'Ausencia', 0, 5, 7),
(21, 'Tarde', 'Tarde', 0, 5, 7),
(22, 'De vacaciones', 'De vacaciones', 0, 5, 7),
(23, 'Despedido', 'Despedido', 0, 5, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_classroom_address`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_classroom_address` (
  `pk_classroom_direction` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_client` int(10) unsigned NOT NULL,
  `street` varchar(100) NOT NULL,
  `street_number` smallint(5) unsigned NOT NULL,
  `street_number_int` varchar(5) DEFAULT NULL,
  `neighborhood` varchar(100) NOT NULL,
  `county` varchar(100) NOT NULL,
  `fk_state_dir` mediumint(8) unsigned NOT NULL,
  `country` varchar(100) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `datos_mapa` varchar(25) NOT NULL,
  PRIMARY KEY (`pk_classroom_direction`),
  UNIQUE KEY `XPKe24_classroom_direction` (`pk_classroom_direction`,`fk_client`),
  KEY `fk_client` (`fk_client`),
  KEY `fk_state_dir_pk_cat_detail` (`fk_state_dir`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_classroom_address`
--

INSERT INTO `tbl_e24_classroom_address` (`pk_classroom_direction`, `fk_client`, `street`, `street_number`, `street_number_int`, `neighborhood`, `county`, `fk_state_dir`, `country`, `zipcode`, `status`, `phone`, `datos_mapa`) VALUES
(1, 1, 'ricardo Margain Zazoya', 333, '', 'Santa Engracia', 'San Pedro', 31, 'Mexico', '66267', 1, '81731300', ''),
(2, 2, 'Ave. Gomez Morin', 955, '212', 'montebello', 'San Pedro', 31, 'M?xico', '66279', 1, '8356-0679', ''),
(3, 3, 'Frida Kahlo', 195, '810', 'Valle Oriente', 'San Pedro', 31, 'M?xico', '66269', 1, '8183968254', ''),
(4, 4, 'Frida Kahlo', 195, '', 'Valle Oriente', 'San Pedro', 31, 'M?xico', '66269', 1, '8116360591', ''),
(5, 5, 'Alfonso Reyes ', 2615, '1007', 'Del paseo Residencial', 'San Pedro', 31, 'M?xico', '66269', 1, '20860611', ''),
(6, 1, 'Matamoros', 311, 'ote', 'Centro', 'Monterrey', 31, 'M?xico', '64000', 1, '83441044', ''),
(7, 1, 'Romulo Garza', 410, '', 'La Fe', 'San Nicolas de los Garza', 31, 'M?xico', '66477', 1, '81 8240 8880', 'Plaza CItadel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_class_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_class_comment` (
  `pk_class_comment` int(11) NOT NULL AUTO_INCREMENT,
  `fk_course` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `initial_hour` time NOT NULL,
  `final_hour` time NOT NULL,
  `comment` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`pk_class_comment`),
  KEY `fk_course` (`fk_course`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_class_comment`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_clients`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_clients` (
  `pk_client` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_type_client` mediumint(8) unsigned NOT NULL,
  `fk_user` int(10) unsigned NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `client_photo` varchar(100) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_mail` varchar(100) NOT NULL,
  `contact_phone` varchar(15) NOT NULL,
  `contact_phone_ext` varchar(15) DEFAULT NULL,
  `client_web` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `billing_data` tinyint(1) NOT NULL,
  `contact_cellphone` varchar(15) NOT NULL,
  PRIMARY KEY (`pk_client`),
  UNIQUE KEY `XPKe24_clients` (`pk_client`),
  KEY `XIF1e24_clients` (`fk_type_client`),
  KEY `fk_user` (`fk_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_clients`
--

INSERT INTO `tbl_e24_clients` (`pk_client`, `fk_type_client`, `fk_user`, `client_name`, `client_photo`, `contact_name`, `contact_mail`, `contact_phone`, `contact_phone_ext`, `client_web`, `status`, `billing_data`, `contact_cellphone`) VALUES
(1, 2, 65, 'STIVA', '', 'Selene Rodriguez ', 'selene.rodriguez@stiva.com', '81731300', '1330', '', 1, 1, '8116795986'),
(2, 2, 67, 'RH MAQ', '', 'Abelardo Garcia', 'agarcia@rhmaq.com', '83560356', '113', '', 1, 1, '8183663917'),
(3, 2, 68, 'Traust', '', 'Ernesto Zambrano', 'ezambrano@traust.mx', '8183968254', '', '', 1, 1, '8183968254'),
(4, 2, 89, 'I-tax', '', 'Raziel Gutierrez', 'rgutierrez@i-tax.mx', '8116360591', '', '', 1, 0, '8116360591'),
(5, 2, 90, 'Syatend', '', 'Natalia de la Cruz', 'natalia.dlc@syatend.com', '20860611', '', '', 1, 1, '8180133248');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_courses`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_courses` (
  `pk_course` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_level` mediumint(8) unsigned NOT NULL,
  `fk_client` int(10) unsigned NOT NULL,
  `fk_teacher` mediumint(8) unsigned NOT NULL,
  `fk_type_course` mediumint(8) unsigned NOT NULL,
  `fk_group` int(10) unsigned DEFAULT NULL,
  `fk_classrom_address` int(11) unsigned NOT NULL,
  `initial_date` date NOT NULL,
  `desc_curse` varchar(50) NOT NULL,
  `other_level` varchar(50) DEFAULT NULL,
  `status` smallint(1) NOT NULL,
  PRIMARY KEY (`pk_course`),
  UNIQUE KEY `XPKe24_courses` (`pk_course`,`fk_client`),
  KEY `fk_client` (`fk_client`),
  KEY `XIF2e24_courses` (`fk_group`),
  KEY `XIF3e24_courses` (`fk_level`),
  KEY `XIF4e24_courses` (`fk_teacher`),
  KEY `XIF5e24_courses` (`fk_type_course`),
  KEY `fk_classrom_address` (`fk_classrom_address`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_courses`
--

INSERT INTO `tbl_e24_courses` (`pk_course`, `fk_level`, `fk_client`, `fk_teacher`, `fk_type_course`, `fk_group`, `fk_classrom_address`, `initial_date`, `desc_curse`, `other_level`, `status`) VALUES
(1, 7, 1, 5, 5, 1, 1, '2014-08-19', 'Stiva dia', '', 1),
(2, 7, 1, 5, 5, 3, 1, '2014-08-19', 'Stiva noche', '', 1),
(3, 11, 1, 6, 5, 2, 1, '2014-08-25', 'Stiva ', '', 1),
(4, 7, 1, 4, 5, NULL, 6, '2014-08-19', 'Appia', '', 1),
(5, 6, 1, 3, 5, 12, 6, '2014-08-20', 'Appia', '', 1),
(6, 6, 1, 4, 5, 11, 7, '2014-08-19', 'Citadel', '', 1),
(7, 12, 3, 7, 4, 9, 3, '2014-06-24', 'Ernesto Zambrano', '', 1),
(8, 8, 4, 3, 4, 8, 4, '2014-08-05', 'Angel Ramirez', '', 1),
(9, 7, 4, 1, 4, 7, 4, '2014-07-10', 'Diana Gzz', '', 1),
(10, 7, 5, 7, 5, NULL, 5, '2014-02-15', 'Syatend', '', 1),
(11, 10, 4, 7, 4, 6, 4, '2014-03-19', 'Raziel Gtz', '', 1),
(12, 7, 2, 5, 5, NULL, 2, '2014-05-14', 'Rh Maq', '', 1),
(13, 6, 3, 4, 4, 13, 3, '2014-10-14', 'Gerardo Cano', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_course_schedule`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_course_schedule` (
  `pk_course_schedule` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_course` int(10) unsigned NOT NULL,
  `fk_bss_day` tinyint(3) unsigned NOT NULL,
  `initial_hour` time NOT NULL,
  `final_hour` time NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk_course_schedule`),
  UNIQUE KEY `XPKe24_curse_schedule` (`pk_course_schedule`,`fk_course`,`fk_bss_day`),
  KEY `fk_curse` (`fk_course`),
  KEY `fk_bss_day` (`fk_bss_day`),
  KEY `XIF2e24_curse_schedule` (`fk_course`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_course_schedule`
--

INSERT INTO `tbl_e24_course_schedule` (`pk_course_schedule`, `fk_course`, `fk_bss_day`, `initial_hour`, `final_hour`, `status`) VALUES
(15, 7, 2, '08:15:00', '09:45:00', 1),
(16, 7, 3, '08:15:00', '09:45:00', 1),
(17, 7, 4, '08:15:00', '09:45:00', 1),
(18, 8, 2, '18:00:00', '19:30:00', 1),
(19, 8, 3, '18:00:00', '19:30:00', 1),
(20, 9, 2, '13:30:00', '15:00:00', 1),
(21, 9, 3, '13:30:00', '15:00:00', 1),
(22, 9, 4, '13:30:00', '15:00:00', 1),
(25, 1, 2, '14:00:00', '15:30:00', 1),
(26, 1, 4, '14:00:00', '15:30:00', 1),
(27, 2, 2, '18:30:00', '20:00:00', 1),
(28, 2, 4, '18:30:00', '20:00:00', 1),
(29, 3, 1, '14:00:00', '15:30:00', 1),
(30, 3, 2, '14:00:00', '15:30:00', 1),
(31, 4, 2, '14:00:00', '15:30:00', 1),
(32, 4, 5, '14:00:00', '15:30:00', 1),
(33, 5, 3, '14:00:00', '15:30:00', 1),
(34, 5, 4, '14:00:00', '15:30:00', 1),
(35, 6, 2, '19:00:00', '20:30:00', 1),
(36, 6, 4, '19:00:00', '20:30:00', 1),
(37, 10, 3, '16:00:00', '17:30:00', 1),
(38, 10, 4, '16:00:00', '17:30:00', 1),
(39, 11, 2, '18:00:00', '19:30:00', 1),
(40, 11, 4, '18:00:00', '19:30:00', 1),
(41, 12, 3, '08:00:00', '09:30:00', 1),
(42, 12, 4, '08:00:00', '09:30:00', 1),
(43, 13, 2, '08:30:00', '10:00:00', 1),
(44, 13, 5, '08:30:00', '10:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_documents_teachers`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_documents_teachers` (
  `fk_document` smallint(5) unsigned NOT NULL,
  `fk_teacher` mediumint(8) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `pk_docs_teacher` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`pk_docs_teacher`),
  UNIQUE KEY `XPKtbl_e24_documents_teachers` (`fk_teacher`,`fk_document`),
  KEY `fk_teacher` (`fk_teacher`),
  KEY `XIF2tbl_e24_documents_teachers` (`fk_document`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_documents_teachers`
--

INSERT INTO `tbl_e24_documents_teachers` (`fk_document`, `fk_teacher`, `status`, `pk_docs_teacher`) VALUES
(2, 1, 1, 1),
(4, 1, 1, 2),
(5, 1, 1, 3),
(7, 1, 1, 4),
(8, 1, 1, 5),
(2, 2, 1, 6),
(3, 2, 1, 7),
(4, 2, 1, 8),
(6, 2, 1, 9),
(7, 2, 1, 10),
(1, 3, 1, 11),
(2, 3, 1, 12),
(4, 3, 1, 13),
(5, 3, 1, 14),
(7, 3, 1, 15),
(1, 4, 1, 16),
(2, 4, 1, 17),
(3, 4, 1, 18),
(4, 4, 1, 19),
(5, 4, 1, 20),
(6, 4, 1, 21),
(7, 4, 1, 22),
(1, 5, 1, 23),
(2, 5, 1, 24),
(4, 5, 1, 25),
(5, 5, 1, 26),
(7, 5, 1, 27),
(2, 6, 1, 28),
(4, 6, 1, 29),
(5, 6, 1, 30),
(7, 6, 1, 31),
(1, 7, 1, 32),
(2, 7, 1, 33),
(4, 7, 1, 34),
(5, 7, 1, 35),
(6, 7, 1, 36),
(7, 7, 1, 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_employees`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_employees`
--

INSERT INTO `tbl_e24_employees` (`pk_employee`, `fk_user`, `name`, `email`, `neigborhod`, `county`, `phone`, `zipcode`, `birthdate`, `street`, `street_number`, `street_number_int`, `fk_state_dir`, `entrance_date`) VALUES
(20, 57, 'Deborah Espinosa', 'deborah.espinosa@e24.com.mx', 'Demo1', 'Demo1', '818181818181', '66116', '1984-02-21', 'Demo1', 1231, '11', 31, '2010-09-01'),
(21, 64, 'Mar?a de Lourdes Trevi?o Sep?lveda', 'ventas@e24.com.mx', 'Los Portales', 'Santa Catarina', '8115073541', '00000', '1989-07-26', 'Huerta', 212, '', 31, '2014-07-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_groups`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_groups` (
  `pk_group` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desc_group` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk_group`),
  UNIQUE KEY `XPKe24_goups` (`pk_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_groups`
--

INSERT INTO `tbl_e24_groups` (`pk_group`, `desc_group`, `status`) VALUES
(1, 'Intermediate 1 Stiva dia ', 1),
(2, 'Advanced 1 Stiva Margain', 1),
(3, 'Intermediate 1 Stiva Noche', 1),
(4, 'Intermediate 2 Syatend', 1),
(5, 'Intermediate 2 RH Maq', 1),
(6, 'Proficiency 2 Itax RG', 1),
(7, 'Intermediate 1 Itax DG', 1),
(8, 'Intermediate 2 Itax AR', 1),
(9, 'Advanced 2 EZ', 1),
(10, 'Intermediate 1 Appia ', 1),
(11, 'Elementary 1 Citadel', 1),
(12, 'Elementary 1 Appia', 1),
(13, 'Elementary 1 GC', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_loan_material`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_loan_material` (
  `pk_loan_material` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_course` int(10) unsigned NOT NULL,
  `fk_teacher` mediumint(8) unsigned NOT NULL,
  `fk_material_detail` int(10) unsigned NOT NULL,
  `pick_date` date NOT NULL,
  `drop_date` date DEFAULT NULL,
  `comment` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`pk_loan_material`),
  KEY `XIF1_loan_material` (`fk_course`),
  KEY `XIF2_loan_material` (`fk_teacher`),
  KEY `XIF3_loan_material` (`fk_material_detail`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='tabla que contiene el record de prestamos de materiales por ' AUTO_INCREMENT=14 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_loan_material`
--

INSERT INTO `tbl_e24_loan_material` (`pk_loan_material`, `fk_course`, `fk_teacher`, `fk_material_detail`, `pick_date`, `drop_date`, `comment`) VALUES
(1, 1, 5, 3, '2014-08-19', NULL, 'para dos grupos en Stiva'),
(2, 2, 5, 3, '2014-08-19', NULL, ''),
(3, 3, 6, 9, '2014-08-19', NULL, ''),
(4, 4, 4, 1, '2014-08-19', NULL, ''),
(5, 5, 3, 13, '2014-08-19', NULL, ''),
(6, 6, 4, 12, '2014-08-19', NULL, ''),
(7, 7, 7, 15, '2014-10-09', NULL, ''),
(8, 8, 3, 5, '2014-08-05', NULL, ''),
(9, 9, 1, 11, '2014-07-10', NULL, ''),
(10, 10, 7, 10, '2014-02-15', NULL, ''),
(11, 11, 7, 8, '2014-03-19', NULL, ''),
(12, 12, 5, 3, '2014-08-19', NULL, ''),
(13, 13, 4, 12, '2014-08-19', NULL, '');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `tbl_e24_materials_view`
--
CREATE TABLE IF NOT EXISTS `tbl_e24_materials_view` (
`pk_material` smallint(5) unsigned
,`desc_material` varchar(50)
,`fk_type_material` mediumint(8) unsigned
,`desc_cat_detail_es` varchar(20)
,`total_stock` bigint(21)
,`actual_stock` bigint(20)
,`desc_level` varchar(50)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `tbl_e24_material_detail_view1`
--
CREATE TABLE IF NOT EXISTS `tbl_e24_material_detail_view1` (
`fk_cat_material` smallint(5) unsigned
,`total_stock` bigint(21)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `tbl_e24_material_detail_view2`
--
CREATE TABLE IF NOT EXISTS `tbl_e24_material_detail_view2` (
`fk_cat_material` smallint(5) unsigned
,`actual_stock` bigint(21)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_material_level`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_material_level` (
  `fk_level` mediumint(8) unsigned NOT NULL,
  `fk_material` smallint(5) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `pk_material_level` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`pk_material_level`),
  UNIQUE KEY `XPKe24_material_level` (`fk_level`,`fk_material`),
  KEY `XIF1e24_material_level` (`fk_level`),
  KEY `XIF2e24_material_level` (`fk_material`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_material_level`
--

INSERT INTO `tbl_e24_material_level` (`fk_level`, `fk_material`, `status`, `pk_material_level`) VALUES
(7, 4, 1, 1),
(7, 10, 0, 7),
(8, 11, 1, 8),
(8, 12, 0, 9),
(11, 13, 1, 10),
(12, 14, 1, 11),
(12, 15, 0, 12),
(9, 16, 1, 13),
(10, 17, 1, 14),
(6, 18, 1, 15);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `tbl_e24_material_level_view1`
--
CREATE TABLE IF NOT EXISTS `tbl_e24_material_level_view1` (
`fk_material` smallint(5) unsigned
,`desc_level` varchar(50)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_students`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_students` (
  `pk_student` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_client` int(10) unsigned NOT NULL,
  `fk_user` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `neigborhod` varchar(100) DEFAULT NULL,
  `county` varchar(100) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `zipcode` varchar(5) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `street` varchar(100) DEFAULT NULL,
  `street_number` smallint(5) unsigned DEFAULT NULL,
  `street_number_int` varchar(5) DEFAULT NULL,
  `fk_state_dir` mediumint(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`pk_student`),
  UNIQUE KEY `XPKe24_students` (`pk_student`),
  KEY `XIF1e24_students` (`fk_client`),
  KEY `fk_user` (`fk_user`),
  KEY `fk_state_dir` (`fk_state_dir`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_students`
--

INSERT INTO `tbl_e24_students` (`pk_student`, `fk_client`, `fk_user`, `name`, `email`, `neigborhod`, `county`, `phone`, `zipcode`, `birthdate`, `street`, `street_number`, `street_number_int`, `fk_state_dir`) VALUES
(1, 1, 69, 'Lorena Espiricueta', 'lorena.espiricueta@stiva.com', '', '', '8110415735', '', '1980-02-29', '', NULL, '', NULL),
(2, 1, 70, 'Martha Tovar Emiliano', '', '', '', '8113153471', '', '1980-05-29', '', NULL, '', NULL),
(3, 1, 71, 'Judith Yepis Sanchez', '', '', '', '8116309285', '', '1980-09-14', '', NULL, '', NULL),
(4, 1, 72, 'Rafael Anaya Moreno', '', '', '', '8117001342', '', '1983-01-12', '', NULL, '', NULL),
(5, 1, 73, 'Cynthia Lucero Reyna Torres', '', '', '', '8120740700', '', '1992-06-25', '', NULL, '', NULL),
(6, 1, 74, 'Angel Ulises Rincon Perez', '', '', '', '8112556908', '', '1979-12-06', '', NULL, '', NULL),
(7, 2, 75, 'Rafael Gonzalez Hurtado', '', '', '', '8110162011', '', '1991-04-08', '', NULL, '', NULL),
(8, 1, 76, 'Alejandra Leal Gonzalez', '', '', '', '8180206216', '', '2013-12-24', '', NULL, '', NULL),
(9, 2, 77, 'Abelardo Garcia Paez', '', '', '', '8183663917', '', '1986-04-21', '', NULL, '', NULL),
(10, 2, 78, 'Iram Oregel Martinez', '', '', '', '8181619859', '', '1986-12-27', '', NULL, '', NULL),
(11, 2, 79, 'Betzayda Linneth Medrano ', 'bmedrano@rhmaq.com', '', '', '8119169020', '', '1990-07-27', '', NULL, '', NULL),
(12, 2, 80, 'Jorge Carbajal Aldama', '', '', '', '8111221832', '', '1969-04-16', '', NULL, '', NULL),
(13, 1, 81, 'Maria Martinez Garibay', '', '', '', '8110507424', '', '2013-08-24', '', NULL, '', NULL),
(14, 1, 82, 'Hilda Edith Luna Rojas', '', '', '', '81177458254', '', '1981-07-01', '', NULL, '', NULL),
(15, 1, 83, 'Nancy Paola Rendon Gzz', '', '', '', '8180133248', '', '2013-04-21', '', NULL, '', NULL),
(16, 1, 84, 'Abel Espinosa Dyck', '', '', '', '811292812', '', '1990-01-26', '', NULL, '', NULL),
(17, 3, 85, 'Ernesto Zambrano Jalden', '', '', '', '81839682554', '', '2013-09-12', '', NULL, '', NULL),
(18, 1, 86, 'Sandra Ramirez ', '', '', '', '19388685', '', '2014-02-25', '', NULL, '', NULL),
(19, 1, 87, 'Elizabeth Rios ', '', '', '', '8114140742', '', '2014-02-25', '', NULL, '', NULL),
(20, 1, 88, 'Omar Soriano', '', '', '', '8119857115', '', '1980-05-24', '', NULL, '', NULL),
(21, 4, 91, 'Diana Gonzalez', '', '', '', '8110747167', '', '2013-11-16', '', NULL, '', NULL),
(22, 5, 92, 'Natalia De la Curz', '', '', '', '8180519100', '', '1988-08-14', '', NULL, '', NULL),
(23, 4, 93, 'Raziel Gutierrez', '', '', '', '8116360591', '', '1983-10-07', '', NULL, '', NULL),
(24, 4, 94, 'Angel Ramirez', '', '', '', '000000000', '', '2013-07-23', '', NULL, '', NULL),
(25, 3, 68, 'Traust', 'ezambrano@traust.mx', 'No capturado', 'No capturado', '8183968254', '00000', '1980-01-01', 'No capturado', 0, '0', 31),
(26, 4, 89, 'I-tax', 'rgutierrez@i-tax.mx', 'No capturado', 'No capturado', '8116360591', '00000', '1980-01-01', 'No capturado', 0, '0', 31),
(27, 4, 89, 'I-tax', 'rgutierrez@i-tax.mx', 'No capturado', 'No capturado', '8116360591', '00000', '1980-01-01', 'No capturado', 0, '0', 31),
(28, 4, 89, 'I-tax', 'rgutierrez@i-tax.mx', 'No capturado', 'No capturado', '8116360591', '00000', '1980-01-01', 'No capturado', 0, '0', 31),
(29, 3, 68, 'Traust', 'ezambrano@traust.mx', 'No capturado', 'No capturado', '8183968254', '00000', '1980-01-01', 'No capturado', 0, '0', 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_students_group`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_students_group` (
  `fk_group` int(10) unsigned NOT NULL,
  `fk_student` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `fk_client` int(10) unsigned NOT NULL,
  `pk_student_group` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`pk_student_group`),
  UNIQUE KEY `XPKe24_students_group` (`fk_group`,`fk_student`),
  KEY `XIF1e24_students_group` (`fk_group`),
  KEY `XIF2e24_students_group` (`fk_student`),
  KEY `fk_clients_pk_clients` (`fk_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_students_group`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_teachers`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_teachers` (
  `pk_teacher` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `fk_user` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `street_numer` smallint(5) unsigned NOT NULL,
  `street_number_int` varchar(5) DEFAULT NULL,
  `neighborhood` varchar(100) NOT NULL,
  `fk_nationality` mediumint(8) unsigned NOT NULL,
  `fk_state_dir` mediumint(8) unsigned NOT NULL,
  `county` varchar(100) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `birthdate` date NOT NULL,
  `fk_state_birth` mediumint(8) unsigned DEFAULT NULL,
  `fk_education` mediumint(8) NOT NULL,
  `nationality_other` varchar(100) DEFAULT NULL,
  `fk_status_document` mediumint(8) unsigned NOT NULL,
  `phone` varchar(15) NOT NULL,
  `cellphone` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `entrance_score` tinyint(4) NOT NULL,
  `rate` double NOT NULL,
  `spesification` varchar(100) DEFAULT NULL,
  `comments` varchar(300) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk_teacher`),
  UNIQUE KEY `XPKtbl_e24_teachers` (`pk_teacher`),
  KEY `fk_state_pk_cat_detail` (`fk_state_dir`),
  KEY `fk_nationality_pk_cat_detail` (`fk_nationality`),
  KEY `fk_status_documents_pk_cat_detail` (`fk_status_document`),
  KEY `fk_state_birth_pk_cat_detail` (`fk_state_birth`),
  KEY `fk_user` (`fk_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_teachers`
--

INSERT INTO `tbl_e24_teachers` (`pk_teacher`, `fk_user`, `name`, `street`, `street_numer`, `street_number_int`, `neighborhood`, `fk_nationality`, `fk_state_dir`, `county`, `zipcode`, `birthdate`, `fk_state_birth`, `fk_education`, `nationality_other`, `fk_status_document`, `phone`, `cellphone`, `email`, `entrance_score`, `rate`, `spesification`, `comments`, `status`) VALUES
(1, 58, 'Sifriegd Magin Chong Ojeda', 'Los Fresnos', 1873, '', 'Villa Florida', 11, 31, 'Monterrey', '64810', '1982-10-26', 31, 50, NULL, 54, '8115550502', '8115550502', 'sifriegd_82@hotmail.com', 100, 200, '', '', 1),
(2, 59, 'lkjasdlkkajs', 'kjhdakjsd akjhsdakjn ask', 33, '', 'kjahskj', 11, 14, 'kjhadkjsda', '56789', '0000-00-00', 31, 50, NULL, 54, '930403409', '09891204913098', 'debbiesp@hotmail.com', 100, 200, '', '', 0),
(3, 60, 'Sandra Ivon Garza Giacoman', 'Costa Azul', 629, '', 'Contry La Costa', 11, 31, 'Guadalupe', '67174', '1987-02-04', 31, 50, NULL, 54, '8113015927', '8113015927', 'sgarzagiacoman@gmail.com', 100, 200, '', '', 1),
(4, 61, 'Rossina Monsivais Sandoval', 'Urano', 1722, 'ote', 'Fracc. Nueva Linda Vista', 11, 31, 'Guadalupe', '67110', '1982-07-09', 31, 50, NULL, 54, '8119775323', '8119775323', 'p.vivebien@gmail.com', 100, 200, '', '', 1),
(5, 62, 'Jessica Marchetti Meyer', 'Blvd. Diaz Ordaz', 812, 'S-82', 'Santa Maria', 11, 31, 'Monterrey', '00000', '1979-06-22', 19, 50, NULL, 54, '8116289792', '8116289792', 'la.marchettid@gmail.com', 100, 200, '', '', 1),
(6, 63, 'Carlos Enrique Garcia-Landois Chapa', 'Monte Celeste', 203, '', 'San Agust?n Residencial', 11, 31, 'San pedro Garza Garcia', '00000', '1977-07-04', 31, 50, NULL, 54, '8118088601', '8118088601', 'cglandois@tubosmonterrey.com', 100, 200, '', '', 1),
(7, 66, 'Deborah Espinosa Verduzco', 'priv. carmelita', 1600, '251', 'loma larga', 11, 31, 'San pedro Garza Garcia', '64710', '1986-06-16', 31, 50, NULL, 54, '20897333', '8112905959', 'deborah.espinosa@e24.com.mx', 100, 200, '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_unavailable_dates`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_unavailable_dates` (
  `pk_unavailable_dates` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `initial_date` date NOT NULL,
  `final_date` date NOT NULL,
  `fk_course` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `fk_unavailability_type` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`pk_unavailable_dates`),
  UNIQUE KEY `XPKe24_unavailable_student` (`pk_unavailable_dates`,`fk_course`),
  KEY `fk_student` (`fk_course`),
  KEY `fk_unav_type_pk_detail` (`fk_unavailability_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_unavailable_dates`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_unavailable_schedule`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_unavailable_schedule` (
  `pk_unavailable_schedule` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_bss_day` tinyint(3) unsigned NOT NULL,
  `fk_teacher` mediumint(8) unsigned NOT NULL,
  `initial_hour` time NOT NULL,
  `final_hour` time NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk_unavailable_schedule`),
  UNIQUE KEY `XPKtbl_e24_unavailable_schedule` (`fk_bss_day`,`fk_teacher`,`pk_unavailable_schedule`),
  KEY `fk_bss_day` (`fk_bss_day`),
  KEY `XIF2tbl_e24_unavailable_schedule` (`fk_teacher`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_unavailable_schedule`
--

INSERT INTO `tbl_e24_unavailable_schedule` (`pk_unavailable_schedule`, `fk_bss_day`, `fk_teacher`, `initial_hour`, `final_hour`, `status`) VALUES
(1, 1, 2, '06:30:00', '08:00:00', 1),
(2, 6, 2, '06:30:00', '11:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_e24_users`
--

CREATE TABLE IF NOT EXISTS `tbl_e24_users` (
  `pk_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_role` mediumint(8) unsigned NOT NULL,
  `username` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk_user`),
  KEY `fk_role` (`fk_role`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=95 ;

--
-- Volcar la base de datos para la tabla `tbl_e24_users`
--

INSERT INTO `tbl_e24_users` (`pk_user`, `fk_role`, `username`, `password`, `status`) VALUES
(54, 62, 'root', '$1$Ehc23$poHOIN8Gj2A1mkUpiDIZo0', 1),
(55, 61, 'admin', '$1$Ehc23$iaXmLTpJ2mbWcHQnnTNOg.', 1),
(57, 61, 'deborah', '$1$Ehc23$xdesyv5iM3b/qRilSdtKZ0', 1),
(58, 59, 'Sifriegd Chong', '$1$Ehc23$9KCjFEXZ8n7L0iW765WQS/', 1),
(59, 59, 'pancho', '$1$Ehc23$PvQbrkHSyZ/e7OjxNpq0M/', 1),
(60, 59, 'Sandra Garza', '$1$Ehc23$Y5eXayl/rtWtE9Y13CgVt1', 1),
(61, 59, 'Rossina Monsivais', '$1$Ehc23$CHJrGlkRQI5RoMQESyCTE1', 1),
(62, 59, 'Jessica Marchetti', '$1$Ehc23$JpKHPBSmKi1AsPNOuiUW50', 1),
(63, 59, 'Carlos Garcia', '$1$Ehc23$28LvYpcMJi4.EPQaZY2bE.', 1),
(64, 61, 'Luly Trevino', '$1$Ehc23$DDUp06lLUXuptauGj9PvL1', 1),
(65, 60, 'Stiva', '$1$Ehc23$sybJvpAMzWasQ2o0hH6OE/', 1),
(66, 59, 'Deborah Espinosa', '$1$Ehc23$yD5NNkQdV8E1A4v1hIs9y.', 1),
(67, 60, 'RH MAQ', '$1$Ehc23$m8wFPiIrhQ/zk0hwu41dz1', 1),
(68, 60, 'traust', '$1$Ehc23$m8wFPiIrhQ/zk0hwu41dz1', 1),
(69, 58, 'Lorena Espiricueta', '$1$Ehc23$2/yp8xgRZ8T404uhUpxLB/', 1),
(70, 58, 'Martha Tovar', '$1$Ehc23$nfU3c80bg3z0sIUloFnhW.', 1),
(71, 58, 'Judith Yepis', '$1$Ehc23$lL6tuB763p./f53T.EZI91', 1),
(72, 58, 'Rafael Anaya', '$1$Ehc23$RAU/CNxoH8Ycxj7Uf/Ul/1', 1),
(73, 58, 'Lucero Reyna', '$1$Ehc23$L0F0HC9R4K3zZzVXt3ji5/', 1),
(74, 58, 'Ulises Rincon', '$1$Ehc23$Ko9V9PGN07MNGScBqMYEB/', 1),
(75, 58, 'Rafael Gonzalez', '$1$Ehc23$cYnJww0jzwWYvXQl.O0pF0', 1),
(76, 58, 'Ale Leal', '$1$Ehc23$JdMdLLQy2hJMpcoaYKaWS.', 1),
(77, 58, 'Abe Garcia', '$1$Ehc23$SXJ2mZnCPhRvE0HNbRrc/1', 1),
(78, 58, 'IramOregel', '$1$Ehc23$XA9X3bH2UGUgvlwhRXuAN1', 1),
(79, 58, 'Betmedrano', '$1$Ehc23$duoA0/Nl/IB2/P/m3UJm9.', 1),
(80, 58, 'Jorge Carbajal', '$1$Ehc23$UECDm26x3SPZ2CnY7pSpU1', 1),
(81, 58, 'Mary Mtz', '$1$Ehc23$Q9zsea3injcYY/vocxrTI1', 1),
(82, 58, 'Hilda Luna', '$1$Ehc23$K6PFXEEMaNtYW5uE9jQ2q.', 1),
(83, 58, 'Nancy Rendon', '$1$Ehc23$rcNyX.v5pNVts2XcNyJwx0', 1),
(84, 58, 'Abel Dyck', '$1$Ehc23$OkHUPtkdhPPSnAT0cdtbZ1', 1),
(85, 58, 'ErnestoZam', '$1$Ehc23$hMa4I9YMnYtg5HSsw8OJq.', 1),
(86, 58, 'Sandy Rmz', '$1$Ehc23$gi4fhyT1thxFyQLsS9KBX1', 1),
(87, 58, 'Eli Rios', '$1$Ehc23$w95CXQoT9VZhzOQuL.E17.', 1),
(88, 58, 'Omar Soriano', '$1$Ehc23$qULZLaa9v4ILrPCIJ184E/', 1),
(89, 60, 'Itax', '$1$Ehc23$m8wFPiIrhQ/zk0hwu41dz1', 1),
(90, 60, 'Syatend', '$1$Ehc23$m8wFPiIrhQ/zk0hwu41dz1', 1),
(91, 58, 'Diana Gzz', '$1$Ehc23$rkTrrkcu9cK1twfWO7wpR0', 1),
(92, 58, 'Natydlc', '$1$Ehc23$jpyjcDOeqBJF449CmZtWE/', 1),
(93, 58, 'Razielgtz', '$1$Ehc23$cYnJww0jzwWYvXQl.O0pF0', 1),
(94, 58, 'Angelrmz', '$1$Ehc23$ccipW7cJiR1jyX.HFqoYB0', 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `tbl_e24_materials_view`
--
DROP TABLE IF EXISTS `tbl_e24_materials_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`user2676070`@`localhost` SQL SECURITY DEFINER VIEW `tbl_e24_materials_view` AS select `cm1`.`pk_material` AS `pk_material`,`cm1`.`desc_material` AS `desc_material`,`cm1`.`fk_type_material` AS `fk_type_material`,`cd1`.`desc_cat_detail_es` AS `desc_cat_detail_es`,`mdv1`.`total_stock` AS `total_stock`,if(isnull(`mdv2`.`actual_stock`),0,`mdv2`.`actual_stock`) AS `actual_stock`,`mlv1`.`desc_level` AS `desc_level` from ((((`tbl_e24_cat_material` `cm1` join `tbl_e24_cat_detail` `cd1` on((`cm1`.`fk_type_material` = `cd1`.`pk_cat_detail`))) left join `tbl_e24_material_detail_view1` `mdv1` on((`cm1`.`pk_material` = `mdv1`.`fk_cat_material`))) left join `tbl_e24_material_detail_view2` `mdv2` on((`cm1`.`pk_material` = `mdv2`.`fk_cat_material`))) join `tbl_e24_material_level_view1` `mlv1` on((`cm1`.`pk_material` = `mlv1`.`fk_material`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `tbl_e24_material_detail_view1`
--
DROP TABLE IF EXISTS `tbl_e24_material_detail_view1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`user2676070`@`localhost` SQL SECURITY DEFINER VIEW `tbl_e24_material_detail_view1` AS select `temp_cm1`.`fk_cat_material` AS `fk_cat_material`,count(`temp_cm1`.`fk_cat_material`) AS `total_stock` from `tbl_e24_cat_material_detail` `temp_cm1` group by `temp_cm1`.`fk_cat_material`;

-- --------------------------------------------------------

--
-- Estructura para la vista `tbl_e24_material_detail_view2`
--
DROP TABLE IF EXISTS `tbl_e24_material_detail_view2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`user2676070`@`localhost` SQL SECURITY DEFINER VIEW `tbl_e24_material_detail_view2` AS select `temp_cm2`.`fk_cat_material` AS `fk_cat_material`,count(`temp_cm2`.`fk_cat_material`) AS `actual_stock` from `tbl_e24_cat_material_detail` `temp_cm2` where (`temp_cm2`.`availability` = 1) group by `temp_cm2`.`fk_cat_material`;

-- --------------------------------------------------------

--
-- Estructura para la vista `tbl_e24_material_level_view1`
--
DROP TABLE IF EXISTS `tbl_e24_material_level_view1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`user2676070`@`localhost` SQL SECURITY DEFINER VIEW `tbl_e24_material_level_view1` AS select `temp_ml1`.`fk_material` AS `fk_material`,`cl1`.`desc_level` AS `desc_level` from (`tbl_e24_material_level` `temp_ml1` join `tbl_e24_cat_levels` `cl1` on((`temp_ml1`.`fk_level` = `cl1`.`pk_level`)));

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `tbl_e24_assistance_record`
--
ALTER TABLE `tbl_e24_assistance_record`
  ADD CONSTRAINT `AssisRecFkClient` FOREIGN KEY (`fk_client`) REFERENCES `tbl_e24_clients` (`pk_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AssisRecFkCourse` FOREIGN KEY (`fk_course`) REFERENCES `tbl_e24_courses` (`pk_course`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkLevelDetPkLevelDet` FOREIGN KEY (`fk_level_detail`) REFERENCES `tbl_e24_cat_level_detail` (`pk_level_detail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_assistance_pk_courses` FOREIGN KEY (`fk_course`, `fk_client`) REFERENCES `tbl_e24_courses` (`pk_course`, `fk_client`),
  ADD CONSTRAINT `fk_assistance_pk_statusclass` FOREIGN KEY (`fk_status_class`) REFERENCES `tbl_e24_cat_status_class` (`pk_status_class`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_assistance_pk_students` FOREIGN KEY (`fk_student`) REFERENCES `tbl_e24_students` (`pk_student`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_billing_data`
--
ALTER TABLE `tbl_e24_billing_data`
  ADD CONSTRAINT `fk_billingdata_pk_clients` FOREIGN KEY (`fk_client`) REFERENCES `tbl_e24_clients` (`pk_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_cat_detail`
--
ALTER TABLE `tbl_e24_cat_detail`
  ADD CONSTRAINT `fk_cat_detail_pk_cat_master` FOREIGN KEY (`fk_cat_master`) REFERENCES `tbl_e24_cat_master` (`pk_cat_master`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_cat_level_detail`
--
ALTER TABLE `tbl_e24_cat_level_detail`
  ADD CONSTRAINT `fk_levelsdetail_pk_levels` FOREIGN KEY (`fk_level`) REFERENCES `tbl_e24_cat_levels` (`pk_level`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_cat_material`
--
ALTER TABLE `tbl_e24_cat_material`
  ADD CONSTRAINT `fk_type_material_pk_cat_detail` FOREIGN KEY (`fk_type_material`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_cat_status_class`
--
ALTER TABLE `tbl_e24_cat_status_class`
  ADD CONSTRAINT `fk_role_class_pk_cat_detail` FOREIGN KEY (`fk_role_class`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_type_class_pk_cat_detail` FOREIGN KEY (`fk_type_class`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_classroom_address`
--
ALTER TABLE `tbl_e24_classroom_address`
  ADD CONSTRAINT `fk_classroom_pk_clients` FOREIGN KEY (`fk_client`) REFERENCES `tbl_e24_clients` (`pk_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_state_dir_pk_cat_detail` FOREIGN KEY (`fk_state_dir`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_class_comment`
--
ALTER TABLE `tbl_e24_class_comment`
  ADD CONSTRAINT `fkCourseComment` FOREIGN KEY (`fk_course`) REFERENCES `tbl_e24_courses` (`pk_course`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_clients`
--
ALTER TABLE `tbl_e24_clients`
  ADD CONSTRAINT `fk_type_client_pk_cat_detail` FOREIGN KEY (`fk_type_client`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_pk_user` FOREIGN KEY (`fk_user`) REFERENCES `tbl_e24_users` (`pk_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_courses`
--
ALTER TABLE `tbl_e24_courses`
  ADD CONSTRAINT `fk_curses_pk_catlevels` FOREIGN KEY (`fk_level`) REFERENCES `tbl_e24_cat_levels` (`pk_level`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_curses_pk_classrrom_address` FOREIGN KEY (`fk_classrom_address`) REFERENCES `tbl_e24_classroom_address` (`pk_classroom_direction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_curses_pk_clients` FOREIGN KEY (`fk_client`) REFERENCES `tbl_e24_clients` (`pk_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_curses_pk_groups` FOREIGN KEY (`fk_group`) REFERENCES `tbl_e24_groups` (`pk_group`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_curses_pk_teachers` FOREIGN KEY (`fk_teacher`) REFERENCES `tbl_e24_teachers` (`pk_teacher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_type_course_pk_cat_detail` FOREIGN KEY (`fk_type_course`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_course_schedule`
--
ALTER TABLE `tbl_e24_course_schedule`
  ADD CONSTRAINT `fk_courseschedule_pk_bssday` FOREIGN KEY (`fk_bss_day`) REFERENCES `tbl_e24_cat_bss_day` (`pk_bss_day`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_courseschedule_pk_courses` FOREIGN KEY (`fk_course`) REFERENCES `tbl_e24_courses` (`pk_course`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_documents_teachers`
--
ALTER TABLE `tbl_e24_documents_teachers`
  ADD CONSTRAINT `fk_docsteachers_pk_catdocs` FOREIGN KEY (`fk_document`) REFERENCES `tbl_e24_cat_documents` (`pk_document`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_docsteachers_pk_teachers` FOREIGN KEY (`fk_teacher`) REFERENCES `tbl_e24_teachers` (`pk_teacher`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_employees`
--
ALTER TABLE `tbl_e24_employees`
  ADD CONSTRAINT `fkState_pkCatDetail_employee` FOREIGN KEY (`fk_state_dir`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_pk_user_employee` FOREIGN KEY (`fk_user`) REFERENCES `tbl_e24_users` (`pk_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_material_level`
--
ALTER TABLE `tbl_e24_material_level`
  ADD CONSTRAINT `fk_materiallevel_pk_catlevels` FOREIGN KEY (`fk_level`) REFERENCES `tbl_e24_cat_levels` (`pk_level`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_materiallevel_pk_catmaterial` FOREIGN KEY (`fk_material`) REFERENCES `tbl_e24_cat_material` (`pk_material`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_students`
--
ALTER TABLE `tbl_e24_students`
  ADD CONSTRAINT `fkState_pkCatDetail` FOREIGN KEY (`fk_state_dir`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_client_pk_client_clients` FOREIGN KEY (`fk_client`) REFERENCES `tbl_e24_clients` (`pk_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_pk_user_students` FOREIGN KEY (`fk_user`) REFERENCES `tbl_e24_users` (`pk_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_students_group`
--
ALTER TABLE `tbl_e24_students_group`
  ADD CONSTRAINT `StudenGroupfkGroup` FOREIGN KEY (`fk_group`) REFERENCES `tbl_e24_groups` (`pk_group`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `StudenGroupFkStudent` FOREIGN KEY (`fk_student`) REFERENCES `tbl_e24_students` (`pk_student`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `StudentGroupFkClient` FOREIGN KEY (`fk_client`) REFERENCES `tbl_e24_clients` (`pk_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_teachers`
--
ALTER TABLE `tbl_e24_teachers`
  ADD CONSTRAINT `fk_nationality_pk_cat_detail` FOREIGN KEY (`fk_nationality`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_state_birth_pk_cat_detail` FOREIGN KEY (`fk_state_birth`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_state_pk_cat_detail` FOREIGN KEY (`fk_state_dir`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_status_documents_pk_cat_detail` FOREIGN KEY (`fk_status_document`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_pk_catrates` FOREIGN KEY (`fk_user`) REFERENCES `tbl_e24_users` (`pk_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_unavailable_dates`
--
ALTER TABLE `tbl_e24_unavailable_dates`
  ADD CONSTRAINT `fk_course_pk_course` FOREIGN KEY (`fk_course`) REFERENCES `tbl_e24_courses` (`pk_course`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_unav_type_pk_detail` FOREIGN KEY (`fk_unavailability_type`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_unavailable_schedule`
--
ALTER TABLE `tbl_e24_unavailable_schedule`
  ADD CONSTRAINT `fk_unvschedule_pk_bssday` FOREIGN KEY (`fk_bss_day`) REFERENCES `tbl_e24_cat_bss_day` (`pk_bss_day`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_unvschedule_pk_teachers` FOREIGN KEY (`fk_teacher`) REFERENCES `tbl_e24_teachers` (`pk_teacher`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_e24_users`
--
ALTER TABLE `tbl_e24_users`
  ADD CONSTRAINT `fk_role_user_pk_cat_detail` FOREIGN KEY (`fk_role`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`user2676070`@`localhost` PROCEDURE `GetMaestrosDisponible`(in horarioMsg text, in pkCursoActual int)
BEGIN
	declare dia varchar(20) default '';
	declare horarioTmp varchar(20) default '';
	declare hora_inicio varchar(20) default '';
	declare hora_fin varchar(20) default '';
	declare pk_maestro integer default 0;
	declare nombre_maestro varchar(100) default '';
	declare i integer default 0;
	declare count_maestro_disp integer default 0;
	-- obtener maestros ordenados de los que mas curso tienen a menos
	declare maestro_cursor cursor for select t.pk_teacher, t.name
											from tbl_e24_teachers t 
											left join tbl_e24_courses c on c.fk_teacher = t.pk_teacher
											where t.status = 1
											group by t.pk_teacher
											order by count(t.pk_teacher) desc,
											c.desc_curse desc;
	declare curso_actual cursor for select cs.* from tbl_e24_courses c 
											inner join tbl_e24_course_schedule cs on cs.fk_course = c.pk_course 
											where c.status = 1
											and c.pk_course <> if(pkCursoActual is not null, pkCursoActual, c.pk_course + 1);
	declare continue handler for not found set i = 1;
	create temporary table if not exists horario(pk_dia integer not null, 
												 hora_inicio time not null, 
												 hora_fin time not null);
	create temporary table if not exists maestro(pk_teacher integer not null, 
												 name varchar(100) not null);

	-- Extraer el mensaje de los horarios capturados
	REPEAT
		SET horarioTmp = (SELECT TRIM(SUBSTRING_INDEX(horarioMsg, ',', 1)));
		SET i = 0;
			REPEAT
				CASE i 
					WHEN 0 THEN
						SET dia = (SELECT TRIM(SUBSTRING_INDEX(horarioTmp, '-', 1)));
					WHEN 1 THEN
						SET hora_inicio = (SELECT TRIM(SUBSTRING_INDEX(horarioTmp, '-', 1)));
					WHEN 2 THEN
						SET hora_fin = (SELECT TRIM(SUBSTRING_INDEX(horarioTmp, '-', 1)));
				END CASE;
				SET i = i + 1;
				SET horarioTmp = (SELECT RIGHT(horarioTmp, TRIM(LENGTH(horarioTmp) - LENGTH(SUBSTRING_INDEX(horarioTmp, '-', 1))-1)));
			UNTIL (horarioTmp = '')
			END REPEAT;
		SET horarioMsg = (SELECT RIGHT(horarioMsg, TRIM(LENGTH(horarioMsg) - LENGTH(SUBSTRING_INDEX(horarioMsg, ',', 1))-1)));
		INSERT INTO horario VALUES(dia, hora_inicio, hora_fin);
	UNTIL (horarioMsg = '')
	END REPEAT;

	-- comprobar horario disponible
	set i = 0;
	open maestro_cursor;
	leer_maestro_cursor: loop
		fetch maestro_cursor into pk_maestro, nombre_maestro;
		if i = 1 then
			leave leer_maestro_cursor;
		end if;
		
		select count(*) into count_maestro_disp 
			from tbl_e24_unavailable_schedule us
			inner join horario hr on hr.pk_dia = us.fk_bss_day
			where (hr.hora_inicio >= us.initial_hour and hr.hora_inicio <= us.final_hour) 
				and (hr.hora_fin >= us.initial_hour and hr.hora_fin <= us.final_hour) 
				and us.fk_teacher = pk_maestro;
		
		if count_maestro_disp = 0 then
			select count(*) into count_maestro_disp 
					from tbl_e24_courses c 
					inner join tbl_e24_course_schedule cs on cs.fk_course = c.pk_course 
					inner join horario hr on hr.pk_dia = cs.fk_bss_day
					where (hr.hora_inicio >= cs.initial_hour and hr.hora_inicio <= cs.final_hour) 
						and (hr.hora_fin >= cs.initial_hour and hr.hora_fin <= cs.final_hour) 
						and c.status = 1
						and c.fk_teacher = pk_maestro
						and c.pk_course <> if(pkCursoActual is not null, pkCursoActual, c.pk_course + 1);
			if count_maestro_disp = 0 then
				insert into maestro values(pk_maestro, nombre_maestro);
			end if;	
		end if;
	end loop leer_maestro_cursor;
	close maestro_cursor;
	
	select m.pk_teacher, m.name from maestro m;
	drop table horario;
	drop table maestro;
END$$

CREATE DEFINER=`user2676070`@`localhost` PROCEDURE `stp_coursedetail`(IN  p_pk_course        INT,
									OUT p_final_date       DATE,
                                    OUT p_percent_complete DECIMAL(5,2),                                         
                                    OUT p_status           INT,
                                    OUT p_message          VARCHAR(100)
                                    )
BEGIN

  -- Declare variables used in this function
  DECLARE v_initial_date       INT;
  DECLARE v_initial_date_desc  VARCHAR(10);  
  DECLARE v_total_time         INT DEFAULT 0;    
  DECLARE v_count_time         INT DEFAULT 0;      
  DECLARE v_fk_bss_day         INT DEFAULT 0;
  DECLARE v_class_day          VARCHAR(10);
  DECLARE v_class_time         INT DEFAULT 0;
  DECLARE v_monday_time        INT DEFAULT 0;  
  DECLARE v_tuesday_time       INT DEFAULT 0;  
  DECLARE v_wednesday_time     INT DEFAULT 0;
  DECLARE v_thursday_time      INT DEFAULT 0;
  DECLARE v_friday_time        INT DEFAULT 0;  
  DECLARE v_saturday_time      INT DEFAULT 0;
  DECLARE v_sunday_time        INT DEFAULT 0;
  DECLARE no_more_rows         BOOLEAN;
  DECLARE find_day             BOOLEAN DEFAULT FALSE;
  DECLARE contador             int default 0;
  DECLARE class_counter        int default 0;
  DECLARE v_time_spent         int default 0;
  DECLARE stringnada           VARCHAR(1000) DEFAULT '';
  DECLARE exist_previus_class  BOOLEAN DEFAULT FALSE;
  DECLARE v_percent_complete      DECIMAL(5,2) DEFAULT 0.0;
  
  
  -- OBTENER DIA DE CURSO, TIEMPO DE CLASE, Y DESCRIPCION DE DIA
  DECLARE cur_schedul_calendar 
   CURSOR FOR
           SELECT cs1.fk_bss_day, 
                  TIME_TO_SEC( cs1.final_hour  ) - TIME_TO_SEC( cs1.initial_hour  ) AS class_time, 
                  cb1.desc_day   
             FROM tbl_e24_course_schedule  cs1
             JOIN tbl_e24_cat_bss_day  cb1 
               ON (cs1.fk_bss_day = cb1.pk_bss_day)
            WHERE fk_course = p_pk_course;
       
   -- DECLARAR VARIABLE PARA ADMINISTRAR LOOP'S
   DECLARE CONTINUE HANDLER FOR NOT FOUND 
                 SET no_more_rows = TRUE;     
        
    
            
    -- DECLARACION PARA MANEJO DE ERRORES
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
      BEGIN
          SET p_message = "Error";
          SET p_status = 1;
         ROLLBACK; -- Si ocurre un error, se revierten los cambios
      END;       
      
    -- OBTENER TIEMPO GASTADO DEL CURSO ( SIRVE PARA VALIDAR TAMBIEN)
    SELECT SUM(TIME_TO_SEC( TEMP.duration  )) 
      INTO v_time_spent
      FROM (
            SELECT c1.duration
              FROM tbl_e24_assistance_record a1
              JOIN tbl_e24_cat_level_detail c1 
                ON a1.fk_level_detail = c1.pk_level_detail
              JOIN tbl_e24_cat_status_class c2 
                ON (a1.fk_status_class = c2.pk_status_class 
                    AND  c2.is_reschedule_motive = 0)
             WHERE fk_course = p_pk_course
            GROUP BY a1.class_date , a1.fk_course,fk_client
           )    AS TEMP; 
      
      -- SI NO EXISTEN CLASES, DEFINIR TIEMPO GASTADO = 0
    IF (v_time_spent is null) THEN SET v_time_spent = 0; END IF;
           
        -- OBTENER EL TIEMPO TOTAL DEL CURSO
        SELECT SUM(TIME_TO_SEC( l1.duration  ))
          INTO v_total_time    
          FROM tbl_e24_cat_level_detail l1 
          JOIN tbl_e24_courses c2 
               ON ( c2.fk_level = l1.fk_level  
                     AND c2.pk_course = p_pk_course             
                    )
               AND l1.status = 1 ;
                 
         -- set stringnada =concat(stringnada, concat(' v_time_spent: ',  v_time_spent));        
         -- set stringnada =concat(stringnada, concat(' v_total_time: ',  v_total_time));            
         
         
        -- VALIDAR SI EXISTE CLASES "GASTADAS"
        IF(v_time_spent > 0) THEN 
        
        --  DEFINIR VARIABLE DE CLASES PREVIAS EN TRUE
        SET exist_previus_class = TRUE;
      
        -- OBTENER EL PORCENTAJE DE HORAS GASTADAS
        SET v_percent_complete = ((v_time_spent /v_total_time) * 100);
        
              
        -- RESTAR EL TIEMPO GASTADO AL TOTAL
        SET v_total_time = v_total_time - v_time_spent;
        
        -- OBTENER EL ULIMO DIA DE CLASE, EN NUMERO Y DESCRIPCION (INGLES)              
        SELECT TO_DAYS(MAX(a1.class_date)), 
               DAYNAME(MAX(a1.class_date))
          INTO v_initial_date,  
               v_initial_date_desc 
          FROM tbl_e24_assistance_record a1
          JOIN tbl_e24_cat_status_class c2 
            ON (a1.fk_status_class = c2.pk_status_class 
                AND  c2.is_reschedule_motive = 0)     
         WHERE fk_course = p_pk_course;
    
    
        -- set stringnada = concat(stringnada, concat(' 2v_total_time: ',  v_total_time));        
        -- set stringnada =concat(stringnada, concat(' 1v_initial_date: ',FROM_DAYS(v_initial_date)  )); 
        -- set stringnada =concat(stringnada, concat(' 1v_initial_date_desc: ',  v_initial_date_desc));          
   
   -- SI NO HAY CLASES PREVIAS, OBTENER EL DIA INICIAL ORIGINAL      
   ELSE  

      SELECT  TO_DAYS(initial_date), 
              DAYNAME(initial_date) 
        INTO  v_initial_date,  
              v_initial_date_desc 
        FROM  tbl_e24_courses 
       WHERE  pk_course = p_pk_course;
     
      -- set stringnada =concat(stringnada, concat(' v_initial_date: ',  v_initial_date)); 
      -- set stringnada =concat(stringnada, concat(' v_initial_date_desc: ',  v_initial_date_desc)); 
                                               
   END IF;
         
  -- ABRIR CURSOR DE DIAS DE CALENDARIO
   OPEN cur_schedul_calendar;

  -- BARRER CURSOR PARA DARLE "PESO" A CADA DIA 
  schedul_loop: LOOP
    
          FETCH cur_schedul_calendar 
           INTO v_fk_bss_day,
                v_class_time,
                v_class_day;
          
          IF no_more_rows THEN
                CLOSE cur_schedul_calendar;
                LEAVE schedul_loop;
          END IF;  
            
          -- set stringnada =concat(stringnada, concat(' v_fk_bss_day: ',  v_fk_bss_day));        
          -- set stringnada =concat(stringnada, concat(' v_class_time: ',  v_class_time));        
          -- set stringnada =concat(stringnada, concat(' v_class_day: ',  v_class_day));        
                  
          IF     ( 'MONDAY'    LIKE UPPER(v_class_day)) THEN  SET v_monday_time    = v_monday_time   + v_class_time; 
          ELSEIF ( 'TUESDAY'   LIKE UPPER(v_class_day)) THEN  SET v_tuesday_time   = v_tuesday_time  + v_class_time;
          ELSEIF ( 'WEDNESDAY' LIKE UPPER(v_class_day)) THEN  SET v_wednesday_time = v_wednesday_time+ v_class_time;
          ELSEIF ( 'THURSDAY'  LIKE UPPER(v_class_day)) THEN  SET v_thursday_time  = v_thursday_time + v_class_time;
          ELSEIF ( 'FRIDAY'    LIKE UPPER(v_class_day)) THEN  SET v_friday_time    = v_friday_time   + v_class_time;
          ELSEIF ( 'SATURDAY'  LIKE UPPER(v_class_day)) THEN  SET v_saturday_time  = v_saturday_time + v_class_time;
          ELSEIF ( 'SUNDAY'    LIKE UPPER(v_class_day)) THEN  SET v_sunday_time    = v_sunday_time   + v_class_time;
          END IF;
                                                      
    END LOOP schedul_loop;  
    
    
    
    -- VALIDAR QUE DIA ES EL INICAL, ESTA ETAPA ES PARA "CONTAR" LA PRIMERA SEMANA 
    BEGIN 
        IF ( 'MONDAY' LIKE UPPER(v_initial_date_desc)) THEN     
            SET find_day      =  TRUE;
            SET v_count_time  =  v_count_time + IF(exist_previus_class,0,v_monday_time);
        END IF;
      
        IF ( 'TUESDAY' LIKE UPPER(v_initial_date_desc)) THEN     
            SET find_day      =  TRUE;
            SET v_count_time  =  v_count_time + IF(exist_previus_class,0,v_tuesday_time);        
        ELSEIF(find_day) THEN    
             SET v_count_time  =  v_count_time + v_tuesday_time;   
             SET v_initial_date = v_initial_date + 1;
        END IF;    
        
        IF ( 'WEDNESDAY' LIKE UPPER(v_initial_date_desc)) THEN     
            SET find_day      =  TRUE;
            SET v_count_time  =  v_count_time + IF(exist_previus_class,0,v_wednesday_time);        
        ELSEIF(find_day) THEN    
             SET v_count_time  =  v_count_time + v_wednesday_time;   
             SET v_initial_date = v_initial_date + 1;
        END IF; 
        
        IF ( 'THURSDAY' LIKE UPPER(v_initial_date_desc)) THEN     
            SET find_day      =  TRUE;
            SET v_count_time  =  v_count_time + IF(exist_previus_class,0,v_thursday_time);        
        ELSEIF(find_day) THEN    
             SET v_count_time  =  v_count_time + v_thursday_time;   
             SET v_initial_date = v_initial_date + 1;
        END IF; 
        
        IF ( 'FRIDAY' LIKE UPPER(v_initial_date_desc)) THEN     
            SET find_day      =  TRUE;
            SET v_count_time  =  v_count_time + IF(exist_previus_class,0,v_friday_time);        
        ELSEIF(find_day) THEN    
             SET v_count_time  =  v_count_time + v_friday_time;   
             SET v_initial_date = v_initial_date + 1;
        END IF; 
        
        IF ( 'SATURDAY' LIKE UPPER(v_initial_date_desc)) THEN     
            SET find_day      =  TRUE;
            SET v_count_time  =  v_count_time + IF(exist_previus_class,0,v_saturday_time);        
        ELSEIF(find_day) THEN    
             SET v_count_time  =  v_count_time + v_saturday_time;   
             SET v_initial_date = v_initial_date + 1;
        END IF; 
        
        IF ( 'SUNDAY' LIKE UPPER(v_initial_date_desc)) THEN     
            SET find_day      =  TRUE;
            SET v_count_time  =  v_count_time + IF(exist_previus_class,0,v_sunday_time);        
        ELSEIF(find_day) THEN    
             SET v_count_time  =  v_count_time + v_sunday_time;   
             SET v_initial_date = v_initial_date + 1;
        END IF;     
    END;        
    -- set stringnada =concat(stringnada, concat(' v_count_time: ',  v_count_time));        
    -- set stringnada =concat(stringnada, concat(' v_initial_date: ',  v_initial_date));          
    -- set stringnada =concat(stringnada, concat('--- v_total_time: ',  v_total_time));        
    -- set stringnada =concat(stringnada, concat('--- v_count_time: ',  v_count_time));
  
  -- CREAR CICLO Y RECORRER HASTA OBTENER REBASAR LAS HORAS DEL CURSO
  -- SE VA SUMANDO UN DIA EN CADA DIA Y LAS HORAS CORRESPONDIENTES
  counter_loop: LOOP
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;    
    	SET v_count_time  = v_count_time + v_monday_time;
      SET v_initial_date = v_initial_date + 1;
      -- set contador = contador +1;

    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;    
    	SET v_count_time  = v_count_time + v_tuesday_time;
      SET v_initial_date = v_initial_date + 1;
      -- set contador = contador +1;
    
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;    
    	SET v_count_time  = v_count_time + v_wednesday_time;
      SET v_initial_date = v_initial_date + 1;
      -- set contador = contador +1;
    
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;    
    	SET v_count_time  = v_count_time + v_thursday_time;
      SET v_initial_date = v_initial_date + 1;
      -- set contador = contador +1;
    
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;    
    	SET v_count_time  = v_count_time + v_friday_time;
      SET v_initial_date = v_initial_date + 1;
      -- set contador = contador +1;
    
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;    
    	SET v_count_time  = v_count_time + v_saturday_time;
      SET v_initial_date = v_initial_date + 1;
      -- set contador = contador +1;
    
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;    
    	SET v_count_time  = v_count_time + v_sunday_time;
      SET v_initial_date = v_initial_date + 1;   
      -- set contador = contador +1;  
  END LOOP counter_loop;

  -- set stringnada = concat(stringnada, concat(' contador: ',  contador));  
       
  -- AGREGAR LOS VALORES A LAS VARIABLE DE SALIDA, LA FECHA SE TRANSFORMA EN UNA RACIONAL
  -- set p_stringnada = stringnada;
  SET p_final_date = FROM_DAYS(v_initial_date);
  SET p_percent_complete = v_percent_complete;
  SET p_status = 0;
  SET p_message = 'Executed Successfully';
END$$

CREATE DEFINER=`user2676070`@`localhost` PROCEDURE `stp_courses`(IN  p_pk_course  INT,
                                   IN  p_pk_client    INT,
                                   IN  p_pk_teacher   INT,
                                   IN  p_pk_student   INT,
                                   OUT p_status       INT,
                                   OUT p_message      VARCHAR(100))
BEGIN
	/* Inicia Area para declaracion de variables, a diferencia de oracle, 
     aqui se declaran las expeciones */
     
    DECLARE v_pk_course, v_total_hours INT;
    DECLARE v_initial_date DATE;
    
    DECLARE no_more_rows BOOLEAN;
     -- Aqui se declaran los querys para obtener cursos, duracion y fecha de inicio
     -- cursor de filtro por alumno
    DECLARE  cur_student   CURSOR FOR
          SELECT c1.pk_course,  
                 l1.total_hours, 
                 c1.initial_date 
            FROM tbl_e24_courses    c1
            JOIN tbl_e24_cat_levels l1  
              ON (c1.fk_level = l1.pk_level )
            JOIN tbl_e24_students_group sg1
              ON (c1.fk_group IS NOT NULL 
                  AND  c1.fk_group = sg1.fk_group  
                  AND  sg1.pk_student_group = p_pk_student)  
            WHERE  c1.status in (0,1);  
     
      -- cursor de filtro por lo demas
    DECLARE  cur_others   CURSOR FOR        
              SELECT c1.pk_course,  
                     l1.total_hours, 
                     c1.initial_date 
                FROM tbl_e24_courses    c1
                JOIN tbl_e24_cat_levels l1  
                  ON (c1.fk_level = l1.pk_level )
               WHERE ( c1.pk_course  = p_pk_course  or p_pk_course  is null)
                 AND ( c1.fk_client  = p_pk_client  or p_pk_client  is null)
                 AND ( c1.fk_teacher = p_pk_teacher or p_pk_teacher is null)
                 AND c1.status in (0,1);            
     
     
   
    -- Declare 'handlers' for exceptions
    DECLARE CONTINUE HANDLER FOR NOT FOUND 
                 SET no_more_rows = TRUE;               
               
    -- Declaracion para atrapar los errores
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
      BEGIN
                SET p_message = "Error";
          SET p_status = 1;
         ROLLBACK; -- Si ocurre un error, se revierten los cambios
      END;   
   -- Para fines de prueba, descomentar la linea de abajo si se decea probar el manejo de errores
   -- DROP TABLE test.no_such_tableS;
   
  /* Fin Area para declaracion de variables */
      

  /* Se debe considerar diferentes estatus para el curso
  *  0 =  Inactivo   --> Cuando se da alta y no se ha asignado alumnos o no se ha dado niguna clase
  *  1 =  Activo     --> Cuando se agregan los alumnos y se da la primera clase
  *  2 =  Terminado  --> Una ves que el curso se termina se le pone este estatus.
  *                      Para fines de busqueda estos no se consideran en esta consulta
  */

  -- Validar si se requiere filtrar por alumno
  IF p_pk_student IS NOT NULL THEN
  
    OPEN cur_student;

    student_loop: LOOP
    FETCH cur_student 
     INTO v_pk_course, 
          v_total_hours,
          v_initial_date;
    
    IF no_more_rows THEN
          CLOSE cur_student;
          LEAVE student_loop;
    END IF;      
      
      
      
    
    END LOOP student_loop;
  
    
  -- De otra forma se filtra por curso, cliente ,  maestro o ninguno
  ELSE
   
      OPEN cur_others;

      others_loop: LOOP
        FETCH cur_others 
         INTO v_pk_course, 
              v_total_hours,
              v_initial_date;
        
        IF no_more_rows THEN
              CLOSE cur_others;
              LEAVE others_loop;
        END IF;          
  
  
      END LOOP others_loop;
  
  END IF;
 
       SET p_status = 0;
       SET p_message = 'Executed Successfully';
END$$

CREATE DEFINER=`user2676070`@`localhost` PROCEDURE `stp_courses_cursor`( IN  p_pk_course  INT,
															IN  p_pk_client    INT,
															IN  p_pk_teacher   INT,
															IN  p_pk_student   INT,
															OUT p_status       INT,
															OUT p_message      VARCHAR(100))
BEGIN
	--  INICIA AREA DE DECLARACION DE VARIABLES
    DECLARE v_pk_course, v_total_hours INT;
    DECLARE v_initial_date DATE;    
    DECLARE no_more_rows BOOLEAN;
    
    -- DECLARACION DE CURSORES SE OBTIENE ID CURSO, DIA INICIAL
    -- CURSOR PARA ALUMNO
    DECLARE  cur_student   CURSOR FOR
          SELECT c1.pk_course,  
                 c1.initial_date 
            FROM tbl_e24_courses    c1
            JOIN tbl_e24_students_group sg1
              ON (c1.fk_group IS NOT NULL 
                  AND  c1.fk_group = sg1.fk_group  
                  AND  sg1.pk_student_group = p_pk_student)  
            WHERE  c1.status in (0,1);  
     
    -- CURSOR PARA TODOS LOS DEMAS ROLES
    DECLARE  cur_others   CURSOR FOR        
              SELECT c1.pk_course,   
                     c1.initial_date 
                FROM tbl_e24_courses    c1
               WHERE ( c1.pk_course  = p_pk_course  or p_pk_course  is null)
                 AND ( c1.fk_client  = p_pk_client  or p_pk_client  is null)
                 AND ( c1.fk_teacher = p_pk_teacher or p_pk_teacher is null)
                 AND c1.status in (0,1);            
     
     
   
    -- DECLARACION PARA MANEJO DE FIN DE LOOP'S
    DECLARE CONTINUE HANDLER FOR NOT FOUND 
                 SET no_more_rows = TRUE;               
               
    -- DECLARACION PARA ATRAPAR ERRORES
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
      BEGIN
                SET p_message = "Error";
          SET p_status = 1;
          DROP TEMPORARY TABLE IF EXISTS tbl_courses_tmp;
         ROLLBACK; -- Si ocurre un error, se revierten los cambios
      END;   
      
    -- Para fines de prueba, descomentar la linea de abajo si se decea probar el manejo de errores
    -- DROP TABLE test.no_such_tableS;
           
    /* Se debe considerar diferentes estatus para el curso
    *  0 =  Inactivo   --> Cuando se da alta y no se ha asignado alumnos o no se ha dado niguna clase
    *  1 =  Activo     --> Cuando se agregan los alumnos y se da la primera clase
    *  2 =  Terminado  --> Una ves que el curso se termina se le pone este estatus.
    *                      Para fines de busqueda estos no se consideran en esta consulta
    */

  DROP TEMPORARY TABLE IF EXISTS tbl_courses_tmp;
  CREATE TEMPORARY TABLE tbl_courses_tmp (tmp_course int, tmp_initial_date date, tmp_final_date date, tmp_percent DECIMAL(5,2));


  -- VALIDAR SI SE REQUIERE FILTRAR POR ALUMNO
  IF p_pk_student IS NOT NULL THEN
  
    -- ABRIR CURSOR DE ALUMNOS
    OPEN cur_student;

    -- RECORRER CURSOR
    student_loop: LOOP
        FETCH cur_student 
         INTO v_pk_course, 
              v_initial_date;
        
        IF no_more_rows THEN
              CLOSE cur_student;
              LEAVE student_loop;
        END IF;      
        
        CALL stp_coursedetail(v_pk_course, @date,@percent,@status,@msg);
        
        IF(@status = 0) THEN  
           INSERT INTO tbl_courses_tmp VALUES (v_pk_course,v_initial_date,@date,@percent);           
        END IF;
        
        
    END LOOP student_loop;
  
  
  -- SI NO SE FILTRA POR ALUMNO
  ELSE
      
      -- ABRIR CURSOR DE ALUMNOS   
      OPEN cur_others;
      
      -- RECORRER CURSOR
      others_loop: LOOP
        FETCH cur_others 
         INTO v_pk_course, 
              v_initial_date;
        
        IF no_more_rows THEN
              CLOSE cur_others;
              LEAVE others_loop;
        END IF;          
  
        CALL stp_coursedetail(v_pk_course, @date,@percent,@status,@msg);
        
        IF(@status = 0) THEN  
           INSERT INTO tbl_courses_tmp VALUES (v_pk_course,v_initial_date,@date,@percent);           
        END IF;  
  
      END LOOP others_loop;
  
  END IF;
   
   SELECT tmp_course , tmp_initial_date , tmp_final_date , tmp_percent 
   FROM tbl_courses_tmp;
   
   DROP TEMPORARY TABLE IF EXISTS tbl_courses_tmp;
   
   
   SET p_status = 0;
   SET p_message = 'Executed Successfully';
END$$

CREATE DEFINER=`user2676070`@`localhost` PROCEDURE `stp_horario`(IN pkTeacher INT, OUT p_status INT, OUT p_message varchar(100))
BEGIN
	DECLARE no_more_rows BOOLEAN;
	declare v_pkCurso int default 0;
	declare v_descCurso varchar(100);
	declare v_fkBssDay int default 0;
	declare v_hrInicio time;
	declare v_hrFin time;
	declare v_fechaInicio date;
	declare diasCurso int default 0;
	declare cont_fecha int default 0;
	declare fecha_tmp date;
	declare cur_curso cursor for 
				select tc.pk_course, tc.desc_curse, tcs.fk_bss_day, tcs.initial_hour, tcs.final_hour, tc.initial_date 
				from tbl_e24_courses tc inner join tbl_e24_course_schedule tcs on tcs.fk_course = tc.pk_course 
				where tc.fk_teacher = pkTeacher and tc.status = 1;
	
	-- DECLARACION PARA MANEJO DE FIN DE LOOP'S
    DECLARE CONTINUE HANDLER FOR NOT FOUND 
                 SET no_more_rows = TRUE;      

			-- DECLARACION PARA ATRAPAR ERRORES
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
      BEGIN
                SET p_message = "Error";
          SET p_status = 1;
          DROP TEMPORARY TABLE IF EXISTS tbl_courses_tmp;
		  DROP TEMPORARY TABLE IF EXISTS horario;
         ROLLBACK; -- Si ocurre un error, se revierten los cambios
      END;  
    
	create temporary table if not exists horario(pk_curso integer not null, 
												 desc_curso varchar(100) not null,
												 anio integer not null,
												 mes integer not null,
												 dia integer not null,
												 hora_inicio integer not null,
												 minuto_inicio integer not null,
												 hora_fin integer not null,
												 minuto_fin integer not null);	
	
	-- ABRIR CURSOR DE CURSO
    OPEN cur_curso;

    -- RECORRER CURSOR
    curso_loop: LOOP
        FETCH cur_curso 
         INTO v_pkCurso, v_descCurso, v_fkBssDay, v_hrInicio, v_hrFin, v_fechaInicio;
        
        IF no_more_rows THEN
              CLOSE cur_curso;
              LEAVE curso_loop;
        END IF;  
    
		CALL stp_coursedetail(v_pkCurso, @fechaFin,@percent,@status,@msg);
		IF(@status = 0) THEN  
			set cont_fecha = 0;
			set diasCurso = datediff(@fechaFin, v_fechaInicio);
			
			while cont_fecha <= diasCurso do
				set fecha_tmp = date_add(v_fechaInicio, INTERVAL cont_fecha DAY);
				if (DAYOFWEEK(fecha_tmp) - 1) = v_fkBssDay then
					insert into horario values(v_pkCurso, v_descCurso, YEAR(fecha_tmp), MONTH(fecha_tmp),DAYOFMONTH(fecha_tmp),hour(v_hrInicio),minute(v_hrInicio),hour(v_hrFin),minute(v_hrFin));
				end if;
				set cont_fecha = cont_fecha + 1;
			end while;
        END IF;
    END LOOP curso_loop;
	SET p_message = "Proceso correcto";
	SET p_status = 0;
	select * from horario;
	drop table horario;
END$$

CREATE DEFINER=`user2676070`@`localhost` PROCEDURE `stp_update_status_course`(OUT p_status INT, OUT p_message varchar(100))
BEGIN
	DECLARE no_more_rows    BOOLEAN;
	declare v_pkCurso 		integer default 0;
	-- obtener los cursos activos
	declare cur_curso cursor for select c.pk_course from tbl_e24_courses c where c.status = 1;
	-- DECLARACION PARA MANEJO DE FIN DE LOOP'S
    DECLARE CONTINUE HANDLER FOR NOT FOUND 
                 SET no_more_rows = TRUE; 
	-- DECLARACION PARA ATRAPAR ERRORES
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
      BEGIN
		SET p_message = "Error";
		SET p_status = 1;
		ROLLBACK; -- Si ocurre un error, se revierten los cambios
      END;  

	-- comprobacion de cursos finalizados
	-- ABRIR CURSOR DE CURSO
    OPEN cur_curso;

    -- RECORRER CURSOR
    curso_loop: LOOP
        FETCH cur_curso INTO v_pkCurso;
        
        IF no_more_rows THEN
              CLOSE cur_curso;
              LEAVE curso_loop;
        END IF;  
    
		CALL stp_coursedetail(v_pkCurso, @fechaFin,@percent,@status,@msg);
		if @status = 0 then
			update tbl_e24_courses set status = 0 where now() > @fechaFin and pk_course = v_pkCurso;
		end if;
    END LOOP curso_loop;
	SET p_message = "Proceso correcto.";
	SET p_status = 0;
END$$

--
-- Funciones
--
CREATE DEFINER=`user2676070`@`localhost` FUNCTION `courseEndDate`(p_pk_course INT) RETURNS varchar(1000) CHARSET latin1
    READS SQL DATA
    DETERMINISTIC
BEGIN
	-- Declare variables used in this function
  DECLARE v_initial_date       INT;
  DECLARE v_initial_date_desc  VARCHAR(10);  
  DECLARE v_total_time         INT DEFAULT 0;    
  DECLARE v_count_time         INT DEFAULT 0;      
  DECLARE v_fk_bss_day         INT DEFAULT 0;
  DECLARE v_class_day          VARCHAR(10);
  DECLARE v_class_time         INT DEFAULT 0;
  DECLARE v_monday_time        INT DEFAULT 0;  
  DECLARE v_tuesday_time       INT DEFAULT 0;  
  DECLARE v_wednesday_time     INT DEFAULT 0;
  DECLARE v_thursday_time      INT DEFAULT 0;
  DECLARE v_friday_time        INT DEFAULT 0;  
  DECLARE v_saturday_time      INT DEFAULT 0;
  DECLARE v_sunday_time        INT DEFAULT 0;
  DECLARE no_more_rows         BOOLEAN;
  DECLARE find_day             BOOLEAN DEFAULT FALSE;
  DECLARE contador             int default 0;
  DECLARE class_counter        int default 0;
  DECLARE v_time_spent         int default 0;
  DECLARE stringnada           VARCHAR(1000) DEFAULT '';
  
  
   -- Obtener un cursor con las llaves de los dias del curso , tiempo que dura la clase 
   -- y la descripcion del dia de clase en ingles
  DECLARE cur_schedul_calendar CURSOR FOR
   select cs1.fk_bss_day, TIME_TO_SEC( cs1.final_hour  ) - TIME_TO_SEC( cs1.initial_hour  ) AS class_time, 
   cb1.desc_day   
    from tbl_e24_course_schedule  cs1
     join tbl_e24_cat_bss_day  cb1 on (cs1.fk_bss_day = cb1.pk_bss_day)
     where fk_course = p_pk_course;
       
   -- Declare 'handlers' for exceptions, this is for finish course
    DECLARE CONTINUE HANDLER FOR NOT FOUND 
                 SET no_more_rows = TRUE;     
        
    
    -- Se obtiene el tiempo gastado, si existe
    SELECT SUM(TIME_TO_SEC( TEMP.duration  )) 
      INTO v_time_spent
      FROM (
            SELECT c1.duration
              FROM tbl_e24_assistance_record a1
              JOIN tbl_e24_cat_level_detail c1 
                ON a1.fk_level_detail = c1.pk_level_detail
              JOIN tbl_e24_cat_status_class c2 
                ON (a1.fk_status_class = c2.pk_status_class 
                    AND  c2.is_reschedule_motive = 0)
             WHERE fk_course = p_pk_course
            GROUP BY a1.class_date , a1.fk_course,fk_client
           )    AS TEMP; 
           
      -- obtener el tiempo total del curso
      SELECT SUM(TIME_TO_SEC( l1.duration  ))
          INTO v_total_time    
          FROM tbl_e24_cat_level_detail l1 
          JOIN tbl_e24_courses c2 
            ON ( c2.fk_level = l1.fk_level  
                 AND c2.pk_course = p_pk_course             
                )
             AND l1.status = 1 ; 
     set stringnada =concat(stringnada, concat(' v_time_spent: ',  v_time_spent));        
     set stringnada =concat(stringnada, concat(' v_total_time: ',  v_total_time));            
   -- Se valida si ya existen clases de curso, si es asi, tomar:
    -- el dia de la ultima clase y la cantidad de horas gastadas
    IF(v_time_spent > 0) THEN 
      
    -- El tiempo total sera la resta entre el inicial y el gastado  
    SET v_total_time = v_total_time - v_time_spent;
    set stringnada = concat(stringnada, concat(' 2v_total_time: ',  v_total_time)); 
     
    SELECT TO_DAYS(MAX(class_date)), DAYNAME(MAX(class_date))
      INTO v_initial_date,  v_initial_date_desc 
     FROM tbl_e24_assistance_record 
     WHERE fk_course = 1 
       AND reschedule_date IS NULL; 
      set stringnada =concat(stringnada, concat(' 1v_initial_date: ',  v_initial_date)); 
      set stringnada =concat(stringnada, concat(' 1v_initial_date_desc: ',  v_initial_date_desc));    
         
   ELSE  -- Si no existen clases, tomar el dia inical del curso y las horas totales
      -- Se obtiene el dia inical en formato numerico desde el dia 0 D.C.
      -- Se obtiene el dia inicial en texto ( dia de la semana en ingles)
      select  TO_DAYS(initial_date), DAYNAME(initial_date) 
      INTO v_initial_date,  v_initial_date_desc 
      from tbl_e24_courses where pk_course = p_pk_course;
     
      set stringnada =concat(stringnada, concat(' v_initial_date: ',  v_initial_date)); 
      set stringnada =concat(stringnada, concat(' v_initial_date_desc: ',  v_initial_date_desc)); 
                                               
   END IF;
             
  -- barrer cursor y colocar un peso a cada dia
  OPEN cur_schedul_calendar;

    schedul_loop: LOOP
    FETCH cur_schedul_calendar 
     INTO v_fk_bss_day,
          v_class_time,
          v_class_day;
    
    IF no_more_rows THEN
          CLOSE cur_schedul_calendar;
          LEAVE schedul_loop;
    END IF;  
      
    set stringnada =concat(stringnada, concat(' v_fk_bss_day: ',  v_fk_bss_day));        
    set stringnada =concat(stringnada, concat(' v_class_time: ',  v_class_time));        
    set stringnada =concat(stringnada, concat(' v_class_day: ',  v_class_day));        
            
    IF ( 'MONDAY' LIKE UPPER(v_class_day)) THEN           
     -- Colocar el tiempo que dura la clase este dia
     SET v_monday_time = v_monday_time + v_class_time; 
    ELSEIF ( 'TUESDAY' LIKE UPPER(v_class_day))  THEN
     SET v_tuesday_time = v_tuesday_time + v_class_time;
    ELSEIF ( 'WEDNESDAY' LIKE UPPER(v_class_day))  THEN
     SET v_wednesday_time = v_wednesday_time+  v_class_time;
    ELSEIF ( 'THURSDAY' LIKE UPPER(v_class_day))  THEN   
     SET v_thursday_time = v_thursday_time +  v_class_time;
    ELSEIF ( 'FRIDAY' LIKE UPPER(v_class_day))  THEN 
     SET v_friday_time = v_friday_time + v_class_time;
    ELSEIF ( 'SATURDAY' LIKE UPPER(v_class_day))  THEN
     SET v_saturday_time = v_saturday_time + v_class_time;
    ELSEIF ( 'SUNDAY' LIKE UPPER(v_class_day))  THEN
     SET v_sunday_time = v_sunday_time + v_class_time;
    END IF;
                      
                          
    END LOOP schedul_loop;  
    
     set stringnada =concat(stringnada, concat(' v_monday_time: ',  v_monday_time));        
     set stringnada =concat(stringnada, concat(' v_tuesday_time: ',  v_tuesday_time));        
     set stringnada =concat(stringnada, concat(' v_wednesday_time: ',  v_wednesday_time));        
     set stringnada =concat(stringnada, concat(' v_thursday_time: ',  v_thursday_time));        
     set stringnada =concat(stringnada, concat(' v_friday_time: ',  v_friday_time));        
     set stringnada =concat(stringnada, concat(' v_saturday_time: ',  v_saturday_time));        
     set stringnada =concat(stringnada, concat(' v_sunday_time: ',  v_sunday_time));        
    
        
    IF ( 'MONDAY' LIKE UPPER(v_initial_date_desc)) THEN     
     -- validar si la bandera find_day es true, si es asi agregar un dia a la fecha inicial 
        SET find_day      =  TRUE;
        SET v_count_time  =  v_count_time + v_monday_time;
    END IF;
  
    IF ( 'TUESDAY' LIKE UPPER(v_initial_date_desc)) THEN     
     -- validar si la bandera find_day es true, si es asi agregar un dia a la fecha inicial 
        SET find_day      =  TRUE;
        SET v_count_time  =  v_count_time + v_tuesday_time;    
    
    ELSEIF(find_day) THEN    
         SET v_count_time  =  v_count_time + v_tuesday_time;   
         SET v_initial_date = v_initial_date + 1;
    END IF;    
    
    IF ( 'WEDNESDAY' LIKE UPPER(v_initial_date_desc)) THEN     
     -- validar si la bandera find_day es true, si es asi agregar un dia a la fecha inicial 
        SET find_day      =  TRUE;
        SET v_count_time  =  v_count_time + v_wednesday_time;    
    
    ELSEIF(find_day) THEN    
         SET v_count_time  =  v_count_time + v_wednesday_time;   
         SET v_initial_date = v_initial_date + 1;
    END IF; 
    
    IF ( 'THURSDAY' LIKE UPPER(v_initial_date_desc)) THEN     
     -- validar si la bandera find_day es true, si es asi agregar un dia a la fecha inicial 
        SET find_day      =  TRUE;
        SET v_count_time  =  v_count_time + v_thursday_time;    
    
    ELSEIF(find_day) THEN    
         SET v_count_time  =  v_count_time + v_thursday_time;   
         SET v_initial_date = v_initial_date + 1;
    END IF; 
    
    IF ( 'FRIDAY' LIKE UPPER(v_initial_date_desc)) THEN     
     -- validar si la bandera find_day es true, si es asi agregar un dia a la fecha inicial 
        SET find_day      =  TRUE;
        SET v_count_time  =  v_count_time + v_friday_time;    
    
    ELSEIF(find_day) THEN    
         SET v_count_time  =  v_count_time + v_friday_time;   
         SET v_initial_date = v_initial_date + 1;
    END IF; 
    
    IF ( 'SATURDAY' LIKE UPPER(v_initial_date_desc)) THEN     
     -- validar si la bandera find_day es true, si es asi agregar un dia a la fecha inicial 
        SET find_day      =  TRUE;
        SET v_count_time  =  v_count_time + v_saturday_time;    
    
    ELSEIF(find_day) THEN    
         SET v_count_time  =  v_count_time + v_saturday_time;   
         SET v_initial_date = v_initial_date + 1;
    END IF; 
    
    IF ( 'SUNDAY' LIKE UPPER(v_initial_date_desc)) THEN     
     -- validar si la bandera find_day es true, si es asi agregar un dia a la fecha inicial 
        SET find_day      =  TRUE;
        SET v_count_time  =  v_count_time + v_sunday_time;    
    
    ELSEIF(find_day) THEN    
         SET v_count_time  =  v_count_time + v_sunday_time;   
         SET v_initial_date = v_initial_date + 1;
    END IF;     
            
           set stringnada =concat(stringnada, concat(' v_count_time: ',  v_count_time));        
           set stringnada =concat(stringnada, concat(' v_initial_date: ',  v_initial_date));
           -- set contador = contador +1;
   set stringnada =concat(stringnada, concat('--- v_total_time: ',  v_total_time));        
           set stringnada =concat(stringnada, concat('--- v_count_time: ',  v_count_time));

  -- crear un while y barrer mientras no se rebase la cantida de horas
  -- sumar cada dia en 1 y sumar las horas correspondientes al dia
  counter_loop: LOOP
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;
    
  	SET v_count_time  = v_count_time + v_monday_time;
    SET v_initial_date = v_initial_date + 1;
    set contador = contador +1;

    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;
    
  	SET v_count_time  = v_count_time + v_tuesday_time;
    SET v_initial_date = v_initial_date + 1;
    set contador = contador +1;
    
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;
    
  	SET v_count_time  = v_count_time + v_wednesday_time;
    SET v_initial_date = v_initial_date + 1;
    set contador = contador +1;
    
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;
    
  	SET v_count_time  = v_count_time + v_thursday_time;
    SET v_initial_date = v_initial_date + 1;
    set contador = contador +1;
    
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;
    
  	SET v_count_time  = v_count_time + v_friday_time;
    SET v_initial_date = v_initial_date + 1;
    set contador = contador +1;
    
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;
    
  	SET v_count_time  = v_count_time + v_saturday_time;
    SET v_initial_date = v_initial_date + 1;
    set contador = contador +1;
    
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;
    
  	SET v_count_time  = v_count_time + v_sunday_time;
    SET v_initial_date = v_initial_date + 1;   
    set contador = contador +1;  
  END LOOP counter_loop;
  
   set stringnada = concat(stringnada, concat(' contador: ',  contador));  
  -- */
  
  -- convertir la fecha en un dia "racional"
  return stringnada;
  -- RETURN  FROM_DAYS(v_initial_date);
 
END$$

CREATE DEFINER=`user2676070`@`localhost` FUNCTION `courseInitialEndDate`(p_pk_course INT) RETURNS date
    READS SQL DATA
    DETERMINISTIC
BEGIN
	DECLARE v_initial_date       INT;
  DECLARE v_initial_date_desc  VARCHAR(10);  
  DECLARE v_total_time         INT DEFAULT 0;    
  DECLARE v_count_time         INT DEFAULT 0;      
  DECLARE v_fk_bss_day         INT DEFAULT 0;
  DECLARE v_class_day          VARCHAR(10);
  DECLARE v_class_time         INT DEFAULT 0;
  DECLARE v_monday_time        INT DEFAULT 0;  
  DECLARE v_tuesday_time       INT DEFAULT 0;  
  DECLARE v_wednesday_time     INT DEFAULT 0;
  DECLARE v_thursday_time      INT DEFAULT 0;
  DECLARE v_friday_time        INT DEFAULT 0;  
  DECLARE v_saturday_time      INT DEFAULT 0;
  DECLARE v_sunday_time        INT DEFAULT 0;
  DECLARE no_more_rows         BOOLEAN;
  DECLARE find_day             BOOLEAN DEFAULT FALSE;
  DECLARE contador             int default 0;
  DECLARE stringnada           VARCHAR(1000) DEFAULT '';
  
  
   -- Obtener un cursor con los id , tiempo que dura la clase y dia de la semana en ingles
  DECLARE cur_schedul_calendar CURSOR FOR
   select cs1.fk_bss_day, TIME_TO_SEC( cs1.final_hour  ) - TIME_TO_SEC( cs1.initial_hour  ) AS class_time, cb1.desc_day   
    from tbl_e24_course_schedule  cs1
     join tbl_e24_cat_bss_day  cb1 on (cs1.fk_bss_day = cb1.pk_bss_day)
     where fk_course = p_pk_course;
       
   -- Declare 'handlers' for exceptions
    DECLARE CONTINUE HANDLER FOR NOT FOUND 
                 SET no_more_rows = TRUE;     
  
  
  
  
  -- Se obtiene el dia inical en formato numerico desde el dia 0 D.C.
  -- Se obtiene el dia inicial en texto ( dia de la semana en ingles)
  select  TO_DAYS(initial_date), DAYNAME(initial_date) 
  INTO v_initial_date,  v_initial_date_desc 
  from tbl_e24_courses where pk_course = p_pk_course;
  
  
   set stringnada =concat(stringnada, concat(' v_initial_date: ',  v_initial_date)); 
   set stringnada =concat(stringnada, concat(' v_initial_date_desc: ',  v_initial_date_desc)); 
  
  -- obtener el tiempo total del curso
  SELECT SUM(TIME_TO_SEC( l1.duration  ))
      INTO v_total_time    
      FROM tbl_e24_cat_level_detail l1 
      JOIN tbl_e24_courses c2 
        ON ( c2.fk_level = l1.fk_level  
             AND c2.pk_course = p_pk_course             
            )
         AND l1.status = 1 ;
            
           
  set stringnada =concat(stringnada, concat(' v_total_time: ',  v_total_time)); 
  
  -- barrer cursor y colocar un peso a cada dia
  OPEN cur_schedul_calendar;

    schedul_loop: LOOP
    FETCH cur_schedul_calendar 
     INTO v_fk_bss_day,
          v_class_time,
          v_class_day;
    
    IF no_more_rows THEN
          CLOSE cur_schedul_calendar;
          LEAVE schedul_loop;
    END IF;  
      
    set stringnada =concat(stringnada, concat(' v_fk_bss_day: ',  v_fk_bss_day));        
    set stringnada =concat(stringnada, concat(' v_class_time: ',  v_class_time));        
    set stringnada =concat(stringnada, concat(' v_class_day: ',  v_class_day));        
            
    IF ( 'MONDAY' LIKE UPPER(v_class_day)) THEN           
     -- Colocar el tiempo que dura la clase este dia
     SET v_monday_time = v_monday_time + v_class_time; 
    ELSEIF ( 'TUESDAY' LIKE UPPER(v_class_day))  THEN
     SET v_tuesday_time = v_tuesday_time + v_class_time;
    ELSEIF ( 'WEDNESDAY' LIKE UPPER(v_class_day))  THEN
     SET v_wednesday_time = v_wednesday_time+  v_class_time;
    ELSEIF ( 'THURSDAY' LIKE UPPER(v_class_day))  THEN   
     SET v_thursday_time = v_thursday_time +  v_class_time;
    ELSEIF ( 'FRIDAY' LIKE UPPER(v_class_day))  THEN 
     SET v_friday_time = v_friday_time + v_class_time;
    ELSEIF ( 'SATURDAY' LIKE UPPER(v_class_day))  THEN
     SET v_saturday_time = v_saturday_time + v_class_time;
    ELSEIF ( 'SUNDAY' LIKE UPPER(v_class_day))  THEN
     SET v_sunday_time = v_sunday_time + v_class_time;
    END IF;
                      
                          
    END LOOP schedul_loop;  
    
     set stringnada =concat(stringnada, concat(' v_monday_time: ',  v_monday_time));        
     set stringnada =concat(stringnada, concat(' v_tuesday_time: ',  v_tuesday_time));        
     set stringnada =concat(stringnada, concat(' v_wednesday_time: ',  v_wednesday_time));        
     set stringnada =concat(stringnada, concat(' v_thursday_time: ',  v_thursday_time));        
     set stringnada =concat(stringnada, concat(' v_friday_time: ',  v_friday_time));        
     set stringnada =concat(stringnada, concat(' v_saturday_time: ',  v_saturday_time));        
     set stringnada =concat(stringnada, concat(' v_sunday_time: ',  v_sunday_time));        
    
        
    IF ( 'MONDAY' LIKE UPPER(v_initial_date_desc)) THEN     
     -- validar si la bandera find_day es true, si es asi agregar un dia a la fecha inicial 
        SET find_day      =  TRUE;
        SET v_count_time  =  v_count_time + v_monday_time;
    END IF;
  
    IF ( 'TUESDAY' LIKE UPPER(v_initial_date_desc)) THEN     
     -- validar si la bandera find_day es true, si es asi agregar un dia a la fecha inicial 
        SET find_day      =  TRUE;
        SET v_count_time  =  v_count_time + v_tuesday_time;    
    
    ELSEIF(find_day) THEN    
         SET v_count_time  =  v_count_time + v_tuesday_time;   
         SET v_initial_date = v_initial_date + 1;
    END IF;    
    
    IF ( 'WEDNESDAY' LIKE UPPER(v_initial_date_desc)) THEN     
     -- validar si la bandera find_day es true, si es asi agregar un dia a la fecha inicial 
        SET find_day      =  TRUE;
        SET v_count_time  =  v_count_time + v_wednesday_time;    
    
    ELSEIF(find_day) THEN    
         SET v_count_time  =  v_count_time + v_wednesday_time;   
         SET v_initial_date = v_initial_date + 1;
    END IF; 
    
    IF ( 'THURSDAY' LIKE UPPER(v_initial_date_desc)) THEN     
     -- validar si la bandera find_day es true, si es asi agregar un dia a la fecha inicial 
        SET find_day      =  TRUE;
        SET v_count_time  =  v_count_time + v_thursday_time;    
    
    ELSEIF(find_day) THEN    
         SET v_count_time  =  v_count_time + v_thursday_time;   
         SET v_initial_date = v_initial_date + 1;
    END IF; 
    
    IF ( 'FRIDAY' LIKE UPPER(v_initial_date_desc)) THEN     
     -- validar si la bandera find_day es true, si es asi agregar un dia a la fecha inicial 
        SET find_day      =  TRUE;
        SET v_count_time  =  v_count_time + v_friday_time;    
    
    ELSEIF(find_day) THEN    
         SET v_count_time  =  v_count_time + v_friday_time;   
         SET v_initial_date = v_initial_date + 1;
    END IF; 
    
    IF ( 'SATURDAY' LIKE UPPER(v_initial_date_desc)) THEN     
     -- validar si la bandera find_day es true, si es asi agregar un dia a la fecha inicial 
        SET find_day      =  TRUE;
        SET v_count_time  =  v_count_time + v_saturday_time;    
    
    ELSEIF(find_day) THEN    
         SET v_count_time  =  v_count_time + v_saturday_time;   
         SET v_initial_date = v_initial_date + 1;
    END IF; 
    
    IF ( 'SUNDAY' LIKE UPPER(v_initial_date_desc)) THEN     
     -- validar si la bandera find_day es true, si es asi agregar un dia a la fecha inicial 
        SET find_day      =  TRUE;
        SET v_count_time  =  v_count_time + v_sunday_time;    
    
    ELSEIF(find_day) THEN    
         SET v_count_time  =  v_count_time + v_sunday_time;   
         SET v_initial_date = v_initial_date + 1;
    END IF;     
            
           set stringnada =concat(stringnada, concat(' v_count_time: ',  v_count_time));        
           set stringnada =concat(stringnada, concat(' v_initial_date: ',  v_initial_date));
           set contador = contador +1;


  -- crear un while y barrer mientras no se rebase la cantida de horas
  -- sumar cada dia en 1 y sumar las horas correspondientes al dia
  counter_loop: LOOP
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;
    
  	SET v_count_time  = v_count_time + v_monday_time;
    SET v_initial_date = v_initial_date + 1;
    set contador = contador +1;

    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;
    
  	SET v_count_time  = v_count_time + v_tuesday_time;
    SET v_initial_date = v_initial_date + 1;
    set contador = contador +1;
    
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;
    
  	SET v_count_time  = v_count_time + v_wednesday_time;
    SET v_initial_date = v_initial_date + 1;
    set contador = contador +1;
    
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;
    
  	SET v_count_time  = v_count_time + v_thursday_time;
    SET v_initial_date = v_initial_date + 1;
    set contador = contador +1;
    
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;
    
  	SET v_count_time  = v_count_time + v_friday_time;
    SET v_initial_date = v_initial_date + 1;
    set contador = contador +1;
    
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;
    
  	SET v_count_time  = v_count_time + v_saturday_time;
    SET v_initial_date = v_initial_date + 1;
    set contador = contador +1;
    
    IF  v_count_time  >= v_total_time THEN LEAVE counter_loop; END IF;
    
  	SET v_count_time  = v_count_time + v_sunday_time;
    SET v_initial_date = v_initial_date + 1;   
    set contador = contador +1;  
  END LOOP counter_loop;
  
   set stringnada = concat(stringnada, concat(' contador: ',  contador));  
  
  
  -- convertir la fecha en un dia "racional"
  -- RETURN stringnada;
  RETURN  FROM_DAYS(v_initial_date);
END$$

CREATE DEFINER=`user2676070`@`localhost` FUNCTION `percentComplete`(p_pk_course INT) RETURNS decimal(5,2)
    READS SQL DATA
    DETERMINISTIC
BEGIN
	DECLARE v_percent_complete DECIMAL(5,2);
  DECLARE v_time_spent       INT;
  DECLARE v_total_time       INT;       
  
  -- Inicializar porcentaje en cero
  SET v_percent_complete = 0;
 
  -- Obtener suma de horas gastadas en clase al momento, 
  -- se une la tabla catalogo detalle, para obtener de ahi las horas,
  -- se une la tabla de estatus de clase, para obtener de ahi cuales son recalendarizadas
  -- las recalendarizadas no se consideran como gastadas 
  SELECT SUM(TIME_TO_SEC( TEMP.duration  )) 
    INTO v_time_spent
    FROM (
          SELECT c1.duration
            FROM tbl_e24_assistance_record a1
            JOIN tbl_e24_cat_level_detail c1 
              ON a1.fk_level_detail = c1.pk_level_detail
            JOIN tbl_e24_cat_status_class c2 
              ON (a1.fk_status_class = c2.pk_status_class 
                  AND  c2.is_reschedule_motive = 0)
           WHERE fk_course = p_pk_course
          GROUP BY a1.class_date , a1.fk_course,fk_client
         )    AS TEMP;
    
    -- Si el tiempo gastado es 0, terminar 
    IF v_time_spent IS NULL OR v_time_spent = 0 THEN      
      RETURN v_percent_complete;
    END IF;
    
                  
    -- Se obtiene el tiempo total de el curso 
    SELECT SUM(TIME_TO_SEC( l1.duration  ))
      INTO v_total_time    
      FROM tbl_e24_cat_level_detail l1 
      JOIN tbl_e24_courses c2 
        ON ( c2.fk_level = l1.fk_level  
             AND c2.pk_course = 1
            );
            
    -- Si el tiempo TOTAL es 0, terminar 
    IF v_total_time IS NULL OR v_total_time = 0 THEN      
      RETURN v_percent_complete;
    END IF;            
       
    -- Se obtiene el porcentaje completado del curso
    SET v_percent_complete = ((v_time_spent /v_total_time) * 100);
         
	RETURN v_percent_complete;
END$$

DELIMITER ;
