-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-06-2014 a las 22:45:18
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `e24db`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMaestrosDisponible`(in horarioMsg text)
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
			insert into maestro values(pk_maestro, nombre_maestro);
		end if;
	end loop leer_maestro_cursor;
	close maestro_cursor;
	
	select m.pk_teacher, m.name from maestro m;
	drop table horario;
	drop table maestro;
END$$

DELIMITER ;

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
  PRIMARY KEY (`pk_assistance`),
  UNIQUE KEY `XPKe24_assistance_record` (`pk_assistance`,`fk_course`,`fk_student`,`fk_client`),
  KEY `fk_curse` (`fk_course`),
  KEY `fk_student` (`fk_student`),
  KEY `fk_client` (`fk_client`),
  KEY `XIF1e24_assistance_record` (`fk_course`,`fk_client`),
  KEY `XIF3e24_assistance_record` (`fk_status_class`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Volcado de datos para la tabla `tbl_e24_assistance_record`
--

INSERT INTO `tbl_e24_assistance_record` (`pk_assistance`, `class_date`, `fk_course`, `fk_client`, `fk_student`, `fk_status_class`, `reschedule_date`, `reschedule_time`, `cancellation_reason`) VALUES
(1, '2013-12-20', 1, 1, 1, 19, NULL, NULL, NULL),
(2, '2013-12-20', 1, 1, 2, 19, NULL, NULL, NULL),
(3, '2013-12-20', 1, 1, 3, 19, NULL, NULL, NULL),
(4, '2013-12-20', 1, 1, 4, 19, NULL, NULL, NULL),
(5, '2013-12-20', 1, 1, 5, 19, NULL, NULL, NULL),
(6, '2013-12-22', 1, 1, 1, 19, NULL, NULL, NULL),
(7, '2013-12-22', 1, 1, 2, 19, NULL, NULL, NULL),
(8, '2013-12-22', 1, 1, 3, 19, NULL, NULL, NULL),
(9, '2013-12-22', 1, 1, 4, 19, NULL, NULL, NULL),
(10, '2013-12-22', 1, 1, 5, 19, NULL, NULL, NULL),
(11, '2013-12-24', 1, 1, 1, 20, NULL, NULL, NULL),
(12, '2013-12-24', 1, 1, 2, 20, NULL, NULL, NULL),
(13, '2013-12-24', 1, 1, 3, 20, NULL, NULL, NULL),
(14, '2013-12-24', 1, 1, 4, 20, NULL, NULL, NULL),
(15, '2013-12-24', 1, 1, 5, 20, NULL, NULL, NULL),
(16, '2013-12-26', 1, 1, 1, 18, NULL, NULL, NULL),
(17, '2013-12-26', 1, 1, 2, 19, NULL, NULL, NULL),
(18, '2013-12-26', 1, 1, 3, 19, NULL, NULL, NULL),
(19, '2013-12-26', 1, 1, 4, 19, NULL, NULL, NULL),
(20, '2013-12-26', 1, 1, 5, 20, NULL, NULL, NULL),
(21, '2013-12-28', 1, 1, 1, 21, NULL, NULL, NULL),
(22, '2013-12-28', 1, 1, 2, 21, NULL, NULL, NULL),
(23, '2013-12-28', 1, 1, 3, 21, NULL, NULL, NULL),
(24, '2013-12-28', 1, 1, 4, 21, NULL, NULL, NULL),
(25, '2013-12-28', 1, 1, 5, 21, NULL, NULL, NULL),
(26, '2013-12-30', 1, 1, 1, 19, NULL, NULL, NULL),
(27, '2013-12-30', 1, 1, 2, 19, NULL, NULL, NULL),
(28, '2013-12-30', 1, 1, 3, 19, NULL, NULL, NULL),
(29, '2013-12-30', 1, 1, 4, 19, NULL, NULL, NULL),
(30, '2013-12-30', 1, 1, 5, 19, NULL, NULL, NULL),
(31, '2014-01-11', 1, 1, 1, 19, NULL, NULL, NULL),
(32, '2014-01-11', 1, 1, 2, 19, NULL, NULL, NULL),
(33, '2014-01-11', 1, 1, 3, 19, NULL, NULL, NULL),
(34, '2014-01-11', 1, 1, 4, 19, NULL, NULL, NULL),
(35, '2014-01-11', 1, 1, 5, 19, NULL, NULL, NULL),
(36, '2014-01-13', 1, 1, NULL, 14, '2014-01-14', '08:00:00', 'La empresa realizo inventario'),
(37, '2014-01-14', 1, 1, 1, 19, NULL, NULL, NULL),
(38, '2014-01-14', 1, 1, 2, 19, NULL, NULL, NULL),
(39, '2014-01-14', 1, 1, 3, 19, NULL, NULL, NULL),
(40, '2014-01-14', 1, 1, 4, 19, NULL, NULL, NULL),
(41, '2014-01-14', 1, 1, 5, 19, NULL, NULL, NULL),
(42, '2014-01-15', 1, 1, 1, 19, NULL, NULL, NULL),
(43, '2014-01-15', 1, 1, 2, 19, NULL, NULL, NULL),
(44, '2014-01-15', 1, 1, 3, 19, NULL, NULL, NULL),
(45, '2014-01-15', 1, 1, 4, 19, NULL, NULL, NULL),
(46, '2014-01-15', 1, 1, 5, 19, NULL, NULL, NULL),
(47, '2014-01-17', 1, 1, 1, 19, NULL, NULL, NULL),
(48, '2014-01-17', 1, 1, 2, 19, NULL, NULL, NULL),
(49, '2014-01-17', 1, 1, 3, 19, NULL, NULL, NULL),
(50, '2014-01-17', 1, 1, 4, 19, NULL, NULL, NULL),
(51, '2014-01-17', 1, 1, 5, 19, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tbl_e24_billing_data`
--

INSERT INTO `tbl_e24_billing_data` (`pk_billing_data`, `fk_client`, `street`, `street_number`, `street_number_int`, `bussiness_name`, `county`, `neighborhood`, `state`, `country`, `zipcode`, `rfc`, `status`) VALUES
(1, 1, 'demo fact calle 1', 2222, '', 'cemex de mexico', 'monterrey', 'centro', 'Nuevo Leon', 'Mexico', '66130', 'jenr834892eng', 1),
(2, 1, 'demo fact calle 2', 3333, NULL, 'cemex de mexico', 'monterrey', 'tecnologico', 'Nuevo Leon', 'Mexico', '66130', 'ernt740234gns', 1),
(3, 3, 'demo fact calle 3', 3333, '123', 'vitro', 'san nicolas', 'las palmas', 'Nuevo Leon', 'Mexico', '77879', 'ajne828382nhs', 1),
(4, 4, 'demo fact calle 4', 4444, NULL, 'mi empresa', 'san pedro', 'del valle', 'Nuevo Leon', 'Mexico', '23242', 'jsneur9302nhs', 1),
(5, 9, 'ejemplo calle', 123, '1', 'ejemplo razon modif', 'monterrey', 'ejemplo colonia', 'Nuevo Léon', 'México', '64830', 'jsneur9302nhs', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `tbl_e24_cat_bss_day`
--

INSERT INTO `tbl_e24_cat_bss_day` (`pk_bss_day`, `desc_day`, `initial_hour`, `final_hour`, `range_time`, `status`) VALUES
(4, 'Lunes', '07:00:00', '20:00:00', '01:30:00', 1),
(5, 'Martes', '07:00:00', '20:00:00', '01:30:00', 1),
(6, 'Miercoles', '07:00:00', '20:00:00', '01:30:00', 1),
(7, 'Jueves', '07:00:00', '20:00:00', '01:30:00', 1),
(8, 'Viernes', '07:00:00', '20:00:00', '01:30:00', 1),
(9, 'Sabado', '09:00:00', '13:00:00', '03:00:00', 1);

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
-- Volcado de datos para la tabla `tbl_e24_cat_bss_hours`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Volcado de datos para la tabla `tbl_e24_cat_detail`
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
(45, 'Zacatecas', 'Zacatecas', 1, 30),
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
(62, 'Super Usuario', 'Super User', 1, 33);

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
-- Volcado de datos para la tabla `tbl_e24_cat_documents`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbl_e24_cat_levels`
--

INSERT INTO `tbl_e24_cat_levels` (`pk_level`, `desc_level`, `fk_associated_book`, `total_hours`, `status`) VALUES
(3, 'Basico 1', 1, 50, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `tbl_e24_cat_level_detail`
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
(34, 3, 'FINAL EXAM AND REVIEW', '01:30:00', 'Final Exam', 'Final Exam', 1, 1);

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
-- Volcado de datos para la tabla `tbl_e24_cat_master`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_e24_cat_material`
--

INSERT INTO `tbl_e24_cat_material` (`pk_material`, `desc_material`, `fk_type_material`) VALUES
(1, 'ABP.B1 SPLIT A', 9),
(2, 'ABP.B1 SPLIT A Cuaderno', 10);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_e24_cat_rates`
--

INSERT INTO `tbl_e24_cat_rates` (`pk_rate`, `desc_tarifa`, `rate`) VALUES
(1, 'Base', 130.5),
(2, 'Avanzado', 250.5);

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
-- Volcado de datos para la tabla `tbl_e24_cat_status_class`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `tbl_e24_classroom_address`
--

INSERT INTO `tbl_e24_classroom_address` (`pk_classroom_direction`, `fk_client`, `street`, `street_number`, `street_number_int`, `neighborhood`, `county`, `fk_state_dir`, `country`, `zipcode`, `status`, `phone`, `datos_mapa`) VALUES
(1, 1, 'clase demo 1', 6666, '66', 'doctores', 'monterrey', 31, 'mexico', '06613', 1, '8166666666', '25.656047, -100.279583'),
(2, 2, 'calse demo 2', 6666, '66', 'doctores', 'monterrey', 31, 'mexico', '06613', 1, '8166666666', '25.661535, -100.282713'),
(3, 3, 'calse demo 3', 7777, '77', 'fundadores', 'san pedro', 31, 'mexico', '06613', 1, '8177777777', '25.656047, -100.279583'),
(4, 4, 'calse demo 4', 8888, '88', 'del poniente', 'santa catarina', 31, 'mexico', '66713', 1, '8188888888', '25.656047, -100.279583'),
(5, 6, 'ejemplo calle', 123, '1', 'ejemplo colonia', 'Municipio', 31, 'Mexico', '68000', 0, '0123456789', '25.656047, -100.279583'),
(6, 7, 'ejemplo calle', 1234, '2', 'colonia', 'Monterrey', 31, 'México', '64830', 1, '12344444444', ''),
(7, 8, 'ejemplo calle', 1234, '2', 'ejemplo colonia', 'Monterrey', 31, 'Mexico', '68000', 1, '0101010101', '25.656047, -100.279583'),
(8, 9, 'ejemplo calle modif', 1234, '2', 'ejemplo colonia', 'Monterrey', 31, 'Mexico', '68000', 1, '0101010101', ''),
(9, 2, 'Calle aeropuerto', 4958, '5', 'colonia Aero', 'Escobedo', 31, 'México', '64800', 1, '845783939', '25.778579, -100.106994');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `tbl_e24_clients`
--

INSERT INTO `tbl_e24_clients` (`pk_client`, `fk_type_client`, `fk_user`, `client_name`, `client_photo`, `contact_name`, `contact_mail`, `contact_phone`, `contact_phone_ext`, `client_web`, `status`, `billing_data`, `contact_cellphone`) VALUES
(1, 2, 3, 'Cemex SA', '601733.jpg', 'demo cliente 1', 'cliente.demo.1@cemex.com', '813333333333', '333', 'www.cemex.com', 1, 1, '0443333333333'),
(2, 3, 46, 'particular demo 1', '', 'particular demo 1', 'particular.demo.2@demo.com', '8144444444', '4444', NULL, 1, 0, '0444444444444'),
(3, 2, 47, 'vitro', '', 'demo cliente 2', 'cliente.demo.2@vitro.com', '8155555555', '555', 'www.vitro.com', 1, 1, '0445555555555'),
(4, 3, 48, 'particular demo 2', '', 'particular demo 2', 'particular.demo.2@demo.com', '8155555555', '555', NULL, 1, 1, '0445555555555'),
(5, 2, 49, 'mi empresa', '', 'nombre persona empresa', 'correo', '951228384', '', '', 1, 0, '8110818911'),
(6, 2, 50, 'ejemplo empresa 1', '', 'nombre persona empresa', 'ejemplo@ejemplo', '1234567890', '1234', 'www.ejemplo.es', 0, 0, '8100000000'),
(7, 2, 51, 'AAEE', '', 'Jose Hernandez', 'ejemplo@ejemplo', '528110818911', '1234', 'ejemplo.pagina.web', 1, 0, '528110818911'),
(8, 2, 11, 'EEEEE', '', 'nombre e', 'correoe@correoe.com', '1234567890', '1234', 'ejemplo.pagina.web', 1, 0, '8100000000'),
(9, 2, 12, 'AAAAAAMODIF', '', 'nombre aaa', 'aaaa@aa.aa', '1234567890', '1234', 'ejemplo.pagina.web', 0, 1, '8100000000');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `tbl_e24_courses`
--

INSERT INTO `tbl_e24_courses` (`pk_course`, `fk_level`, `fk_client`, `fk_teacher`, `fk_type_course`, `fk_group`, `fk_classrom_address`, `initial_date`, `desc_curse`, `other_level`, `status`) VALUES
(1, 3, 1, 11, 5, 1, 1, '2013-12-20', 'Curso basico cemez 1', '', 1),
(2, 3, 1, 4, 5, 2, 1, '2013-12-22', 'Curso basico cemez 2', NULL, 1),
(3, 3, 3, 3, 5, 3, 3, '2013-12-23', 'Curso vitro  1', '', 1),
(4, 3, 3, 4, 5, 4, 3, '2013-12-24', 'Curso vitro  2', NULL, 1),
(5, 3, 2, 3, 4, NULL, 2, '2013-12-25', 'Curso particular  1', NULL, 0),
(6, 3, 4, 4, 4, NULL, 4, '2013-12-25', 'Curso particular  2', NULL, 0),
(7, 3, 3, 11, 4, 2, 3, '2014-04-24', 'Ejemplo Curso 08:00', '', 1),
(8, 3, 1, 3, 4, 2, 1, '2014-04-16', 'Ejemplo curso con horario', '', 0),
(9, 3, 4, 7, 4, 2, 4, '2014-05-08', 'Curso con horario', '', 1),
(10, 3, 7, 5, 4, 2, 6, '2014-05-13', 'Ejemplo Curso 10101', '', 1),
(11, 3, 7, 5, 4, 2, 6, '2014-05-13', 'Ejemplo Curso 10101', '', 1),
(12, 3, 7, 5, 4, 2, 6, '2014-05-13', 'Ejemplo Curso 10101', '', 1),
(13, 3, 7, 5, 4, 2, 6, '2014-05-13', 'Ejemplo Curso 10101', '', 0),
(14, 3, 7, 5, 4, 2, 6, '2014-05-13', 'Ejemplo Curso 10101', '', 1),
(15, 3, 1, 12, 4, 2, 1, '2014-05-23', 'Ejemplo curso cemex', '', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Volcado de datos para la tabla `tbl_e24_course_schedule`
--

INSERT INTO `tbl_e24_course_schedule` (`pk_course_schedule`, `fk_course`, `fk_bss_day`, `initial_hour`, `final_hour`, `status`) VALUES
(4, 2, 6, '08:00:00', '09:30:00', 1),
(5, 2, 7, '08:00:00', '09:30:00', 1),
(6, 2, 8, '08:00:00', '09:30:00', 1),
(10, 4, 5, '08:00:00', '09:30:00', 1),
(11, 4, 6, '08:00:00', '09:30:00', 1),
(12, 4, 7, '08:00:00', '09:30:00', 1),
(13, 5, 4, '08:00:00', '09:30:00', 1),
(14, 5, 5, '08:00:00', '09:30:00', 1),
(15, 5, 6, '08:00:00', '09:30:00', 1),
(16, 5, 7, '08:00:00', '09:30:00', 1),
(17, 5, 8, '08:00:00', '09:30:00', 1),
(18, 6, 9, '08:00:00', '13:00:00', 1),
(19, 8, 4, '08:00:00', '08:00:00', 1),
(20, 8, 6, '09:00:00', '09:00:00', 1),
(21, 8, 7, '09:00:00', '09:00:00', 1),
(22, 8, 8, '08:00:00', '08:00:00', 1),
(35, 9, 5, '11:00:00', '12:00:00', 1),
(36, 14, 4, '10:00:00', '10:30:00', 1),
(37, 14, 5, '10:00:00', '10:30:00', 1),
(39, 15, 4, '10:00:00', '10:30:00', 1),
(40, 3, 4, '08:00:00', '09:30:00', 1),
(41, 3, 5, '08:00:00', '09:30:00', 1),
(42, 3, 6, '08:00:00', '09:30:00', 1),
(47, 1, 4, '08:00:00', '09:30:00', 1),
(48, 1, 5, '10:00:00', '11:00:00', 1),
(49, 1, 6, '08:00:00', '09:30:00', 1),
(50, 1, 8, '08:00:00', '09:30:00', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Volcado de datos para la tabla `tbl_e24_documents_teachers`
--

INSERT INTO `tbl_e24_documents_teachers` (`fk_document`, `fk_teacher`, `status`, `pk_docs_teacher`) VALUES
(1, 3, 1, 8),
(2, 3, 1, 9),
(3, 3, 1, 10),
(3, 4, 1, 11),
(4, 3, 1, 12),
(4, 4, 1, 13),
(5, 3, 1, 14),
(5, 4, 1, 15),
(6, 4, 1, 16),
(7, 4, 1, 17),
(2, 6, 1, 19),
(4, 6, 1, 20),
(5, 6, 1, 21),
(1, 6, 1, 24),
(1, 7, 1, 25),
(5, 7, 1, 26),
(8, 7, 1, 27),
(1, 8, 1, 28),
(5, 8, 1, 29),
(1, 9, 1, 30),
(4, 9, 1, 31),
(6, 9, 1, 32),
(1, 10, 1, 33),
(4, 10, 1, 34),
(5, 10, 1, 35),
(1, 11, 1, 36),
(4, 11, 1, 37),
(5, 11, 1, 38),
(1, 12, 1, 39),
(4, 12, 1, 40),
(6, 12, 1, 41);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbl_e24_groups`
--

INSERT INTO `tbl_e24_groups` (`pk_group`, `desc_group`, `status`) VALUES
(1, 'cemex-2014-1', 1),
(2, 'cemex-2014-2', 1),
(3, 'vitro-2014-1', 1),
(4, 'vitro-2014-2', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_e24_material_level`
--

INSERT INTO `tbl_e24_material_level` (`fk_level`, `fk_material`, `status`, `pk_material_level`) VALUES
(3, 1, 1, 1),
(3, 2, 1, 2);

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
  `neigborhod` varchar(100) NOT NULL,
  `county` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `birthdate` date NOT NULL,
  `street` varchar(100) NOT NULL,
  `street_number` smallint(5) unsigned NOT NULL,
  `street_number_int` varchar(5) DEFAULT NULL,
  `fk_state_dir` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`pk_student`),
  UNIQUE KEY `XPKe24_students` (`pk_student`),
  KEY `XIF1e24_students` (`fk_client`),
  KEY `fk_user` (`fk_user`),
  KEY `fk_state_dir` (`fk_state_dir`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `tbl_e24_students`
--

INSERT INTO `tbl_e24_students` (`pk_student`, `fk_client`, `fk_user`, `name`, `email`, `neigborhod`, `county`, `phone`, `zipcode`, `birthdate`, `street`, `street_number`, `street_number_int`, `fk_state_dir`) VALUES
(1, 1, 1, 'estudiante cemex 1 update', 'est.1.cemex@demo.com', 'centro 1', 'monterrey', '8180887259', '66579', '1984-10-21', 'del paseo 1', 2212, 'b2', 31),
(2, 1, 35, 'estudiante cemex 2', 'est.2.cemex@demo.com', 'centro 2', 'monterrey', '8180887254', '66579', '1984-06-21', 'del paseo 2', 2212, 'b2', 31),
(3, 1, 36, 'estudiante cemex 3', 'est.3.cemex@demo.com', 'centro 3', 'monterrey', '8180887245', '66579', '1984-04-21', 'del paseo 3', 2212, 'b2', 31),
(4, 1, 37, 'estudiante cemex 4', 'est.4.cemex@demo.com', 'centro 4', 'monterrey', '8180856759', '66579', '1984-01-21', 'del paseo 4', 2212, 'b2', 31),
(5, 1, 38, 'estudiante cemex 5', 'est.5.cemex@demo.com', 'centro 5', 'monterrey', '8133387259', '66579', '1984-02-20', 'del paseo 5', 2212, 'b2', 31),
(6, 3, 39, 'estudiante vitro 1 update', 'est.1.cemex@demo.com', 'centro 1', 'monterrey', '8180887259', '66579', '1984-10-21', 'del paseo 1', 2212, 'b2', 31),
(7, 3, 41, 'estudiante vitro 2', 'est.2.vitro@demo.com', 'centro 2', 'monterrey', '8180887254', '66579', '1984-06-21', 'del paseo 2', 2212, 'b2', 31),
(8, 3, 42, 'estudiante vitro 3', 'est.3.vitro@demo.com', 'centro 3', 'monterrey', '8180887245', '66579', '1984-04-21', 'del paseo 3', 2212, 'b2', 31),
(9, 3, 43, 'estudiante vitro 4', 'est.4.vitro@demo.com', 'centro 4', 'monterrey', '8180856759', '66579', '1984-01-21', 'del paseo 4', 2212, 'b2', 31),
(10, 3, 44, 'estudiante vitro 5', 'est.5.vitro@demo.com', 'centro 5', 'monterrey', '8133387259', '66579', '1984-02-20', 'del paseo 5', 2212, 'b2', 31),
(11, 2, 45, 'estudiante personal 1', 'est.1.personal@demo.com', 'centro 6', 'monterrey', '8133387259', '66579', '1984-02-20', 'del paseo 5', 2212, 'b2', 31),
(12, 4, 40, 'estudiante personal 2', 'est.2.personal@demo.com', 'centro 7', 'monterrey', '8133387259', '66579', '1984-02-20', 'del paseo 5', 2212, 'b2', 31),
(13, 5, 21, 'Estudiante dos a', 'estudiante2@edu.com', 'Colonia estudiante 2', 'Monterrey', '3847563847', '34555', '2012-07-04', 'Calle estudiante 2', 123, '3c', 31);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tbl_e24_students_group`
--

INSERT INTO `tbl_e24_students_group` (`fk_group`, `fk_student`, `status`, `fk_client`, `pk_student_group`) VALUES
(1, 1, 1, 1, 1),
(1, 2, 1, 1, 2),
(1, 3, 1, 1, 3),
(1, 6, 1, 3, 4),
(1, 7, 1, 3, 5),
(1, 8, 1, 3, 6),
(2, 4, 1, 1, 7),
(2, 5, 1, 1, 8),
(3, 9, 1, 3, 9),
(3, 10, 1, 3, 10);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `tbl_e24_teachers`
--

INSERT INTO `tbl_e24_teachers` (`pk_teacher`, `fk_user`, `name`, `street`, `street_numer`, `street_number_int`, `neighborhood`, `fk_nationality`, `fk_state_dir`, `county`, `zipcode`, `birthdate`, `fk_state_birth`, `fk_education`, `nationality_other`, `fk_status_document`, `phone`, `cellphone`, `email`, `entrance_score`, `rate`, `spesification`, `comments`, `status`) VALUES
(3, 2, 'Maestro Demo 1', 'Calle demo 1', 1111, 'A-1', 'colonia demo 1', 11, 31, 'municipio demo 1', '06730', '1984-02-20', 31, 51, NULL, 54, '8111111111', '0441111111111', 'demo2@demo.com', 80, 135.5, 'espesificacion demo 1', 'comentario demo 1', 1),
(4, 22, 'Maestro Demo 2', 'Calle demo 2', 2222, 'B-2', 'colonia demo 2', 12, 31, 'municipio demo 2', '66730', '1982-03-19', NULL, 52, 'Americana', 55, '8222222222', '0442222222222', 'demo2@demo.com', 90, 145.5, 'espesificacion demo 2', 'comentario demo 2', 1),
(5, 23, 'maestro prueba', 'ejemplo calle', 123, '', 'ejemplo colonia', 11, 31, 'Monterrey', '68000', '2014-03-02', 31, 50, NULL, 55, '1234567890', '1234567890', '', 9, 155.5, '', '', 1),
(6, 24, 'maestro prueba update', 'ejemplo calle', 123, '123', 'ejemplo colonia', 11, 31, 'Monterrey', '68000', '2014-03-15', 31, 50, NULL, 55, '1234567890', '1234567890', 'ejemplo@ejemplo.ejemplo', 9, 165.5, 'esopecificaciones', 'comentarios', 1),
(7, 14, 'maestro prueba', 'ejemplo calle', 123, '123', 'ejemplo colonia', 11, 31, 'Monterrey', '68000', '2014-04-04', 31, 50, NULL, 56, '1234567890', '1234567890', 'ejemplo@ejemplo.ejemplo', 9, 175.5, 'ejemplo', 'ejemplo', 0),
(8, 15, 'Maestro', 'calle', 123, '1', 'colonia', 12, 31, 'Monterrey', '68000', '2011-12-01', 31, 50, '', 55, '012121212', '1212121212', 'ejemplo@ejemplo.com', 9, 185.5, '', '', 1),
(9, 16, 'Maestro 1', 'calle', 123, '1', 'colonia', 11, 31, 'Mty', '68000', '2013-11-06', 31, 50, NULL, 55, '12121212', '12121212', 'ejemplo@ejemplo.com', 8, 195.5, '', '', 1),
(10, 17, 'Mestro1', 'calle', 123, '1', 'colonia', 11, 31, 'Mty', '68000', '2014-03-05', 31, 50, NULL, 55, '12121212', '12121212', 'ejemplo@ejemplo.com', 8, 175.5, '', '', 1),
(11, 18, 'Maestro 2', 'calle', 123, '1', 'colonia', 11, 31, 'Monterrey', '68000', '2013-12-03', 31, 50, NULL, 55, '1212121212', '1212121212', 'ejemplo@ejemplo.com', 8, 195.5, '', '', 1),
(12, 19, 'nombre maestro apellido 4', 'calle', 123, '1', 'coloni', 11, 31, 'Mty', '64000', '2014-04-07', 31, 50, NULL, 55, '12121212', '1212121212', '', 8, 115.5, '', '', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbl_e24_unavailable_dates`
--

INSERT INTO `tbl_e24_unavailable_dates` (`pk_unavailable_dates`, `initial_date`, `final_date`, `fk_course`, `status`, `fk_unavailability_type`) VALUES
(1, '2014-01-01', '2014-01-10', 1, 0, 15),
(2, '2014-02-02', '2014-02-11', 4, 0, 16),
(3, '2014-01-15', '2014-01-20', 6, 0, 7);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=161 ;

--
-- Volcado de datos para la tabla `tbl_e24_unavailable_schedule`
--

INSERT INTO `tbl_e24_unavailable_schedule` (`pk_unavailable_schedule`, `fk_bss_day`, `fk_teacher`, `initial_hour`, `final_hour`, `status`) VALUES
(9, 4, 4, '10:00:00', '11:00:00', 1),
(10, 5, 4, '11:00:00', '13:00:00', 1),
(11, 5, 4, '16:00:00', '17:00:00', 1),
(12, 6, 4, '10:00:00', '11:00:00', 1),
(13, 7, 4, '11:00:00', '13:00:00', 1),
(14, 7, 4, '17:00:00', '18:00:00', 1),
(15, 8, 4, '10:00:00', '11:00:00', 1),
(16, 9, 4, '07:00:00', '10:00:00', 1),
(124, 4, 11, '06:30:00', '08:00:00', 1),
(125, 4, 11, '09:00:00', '10:30:00', 1),
(126, 5, 11, '08:00:00', '09:30:00', 1),
(127, 6, 11, '06:30:00', '08:00:00', 1),
(128, 7, 11, '07:30:00', '09:00:00', 1),
(129, 7, 11, '09:30:00', '11:00:00', 1),
(130, 8, 11, '07:30:00', '10:00:00', 1),
(131, 9, 11, '06:30:00', '08:30:00', 1),
(132, 9, 11, '09:00:00', '10:00:00', 1),
(145, 4, 3, '11:00:00', '13:00:00', 1),
(146, 5, 3, '11:00:00', '13:00:00', 1),
(147, 5, 3, '16:00:00', '17:00:00', 1),
(148, 6, 3, '11:00:00', '13:00:00', 1),
(149, 7, 3, '11:00:00', '13:00:00', 1),
(150, 7, 3, '17:00:00', '18:00:00', 1),
(151, 8, 3, '11:00:00', '13:00:00', 1),
(152, 9, 3, '07:00:00', '13:00:00', 1),
(157, 4, 12, '06:30:00', '07:30:00', 1),
(158, 5, 12, '06:30:00', '07:30:00', 1),
(159, 5, 12, '08:30:00', '10:00:00', 1),
(160, 9, 12, '06:30:00', '09:00:00', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=52 ;

--
-- Volcado de datos para la tabla `tbl_e24_users`
--

INSERT INTO `tbl_e24_users` (`pk_user`, `fk_role`, `username`, `password`, `status`) VALUES
(1, 58, 'estudiante', '$1$Ehc23$2EA1fqAP8LL2bZ0q7ikM60', 1),
(2, 59, 'maestro', '$1$Ehc23$cum98xoyTSVb7zExxVIOL1', 1),
(3, 60, 'clienteCemex', '$1$Ehc23$715rAiVG5VKc7NuRNTgQI1', 1),
(4, 61, 'admin', '$1$Ehc23$1ttveg7nyIhUmQqsgEpC80', 1),
(11, 60, 'ejemplo', '$1$Ehc23$4KVzLmJX98/0lAIrl1oxh0', 1),
(12, 60, 'aaa', '$1$Ehc23$kyu1ROrRRR11J4L3R0y9j/', 1),
(13, 62, 'root', '$1$Ehc23$8H.PdjVFxuPyREmdOrav51', 1),
(14, 59, 'maestro', '$1$Ehc23$cum98xoyTSVb7zExxVIOL1', 1),
(15, 59, 'maestro0', '$1$Ehc23$Tzg5ASHfuP8ExFJq.Q2Q10', 1),
(16, 59, 'maestro1', '$1$Ehc23$1nWP/sp9NbBtAzSfGjVTg0', 1),
(17, 59, 'maestro1', '$1$Ehc23$1nWP/sp9NbBtAzSfGjVTg0', 1),
(18, 59, 'maestro2', '$1$Ehc23$nHLoX3/Inrod6HYyuS7WE0', 1),
(19, 59, 'maestro4', '$1$Ehc23$OoCVGQ9j2ngbnNsIwYtOj0', 1),
(21, 58, 'estudiante2', '$1$Ehc23$qTGdqGlffam4CUQuiq66k1', 1),
(22, 59, 'maestro5', '$1$Ehc23$UFzGkXC0inxsTCuMgWwYN1', 1),
(23, 59, 'maestro6', '$1$Ehc23$UKDaLlatbpmksJsymwa/41', 1),
(24, 59, 'maestro7', '$1$Ehc23$pVNvZXvPb5qwPLs41rs3v1', 1),
(35, 58, 'estudiante3', '$1$Ehc23$0gmbfj7jA56nuLzd8M8Gf.', 1),
(36, 58, 'estudiante4', '$1$Ehc23$499B0emTLIUlUVbUQRV25/', 1),
(37, 58, 'estudiante5', '$1$Ehc23$oYUoOgtyqlJyfSsbWe.5F/', 1),
(38, 58, 'estudiante6', '$1$Ehc23$MGskHqlALszFJ5hv/WQiF/', 1),
(39, 58, 'estudiante7', '$1$Ehc23$7aJi1hXYETQj3pWGEJ1MM/', 1),
(40, 58, 'estudiante8', '$1$Ehc23$FPeagrY6u6oH.VYlzRoCG1', 1),
(41, 58, 'estudiante9', '$1$Ehc23$RZGSWRrIP.x8kopuLllCR/', 1),
(42, 58, 'estudiante10', '$1$Ehc23$QwW66QVUGoHuBUyD1UHwb/', 1),
(43, 58, 'estudiante11', '$1$Ehc23$PH0yBHHzzQA6TS9EMoWBH0', 1),
(44, 58, 'estudiante12', '$1$Ehc23$eeh6YeaJIxYdZbk7Lw4OZ.', 1),
(45, 58, 'estudiante13', '$1$Ehc23$cQER.niOkbfO3gdJqBDAp0', 1),
(46, 60, 'cliente1', '$1$Ehc23$/LELfTqEtiBR5r0x6zh/N.', 1),
(47, 60, 'cliente2', '$1$Ehc23$hWtbDzjEHa1qPf8iLYMCN.', 1),
(48, 60, 'cliente3', '$1$Ehc23$2UZxcYaBr5zHv8ficWaRT/', 1),
(49, 60, 'cliente4', '$1$Ehc23$1A/K4d54vWMVw/x6/8A/T1', 1),
(50, 60, 'cliente5', '$1$Ehc23$k1VFOz9tTpUA1v46noOUr.', 1),
(51, 60, 'cliente6', '$1$Ehc23$eeNfspbl.mDkgX1xMf8fF1', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_e24_assistance_record`
--
ALTER TABLE `tbl_e24_assistance_record`
  ADD CONSTRAINT `fk_assistance_pk_courses` FOREIGN KEY (`fk_course`, `fk_client`) REFERENCES `tbl_e24_courses` (`pk_course`, `fk_client`),
  ADD CONSTRAINT `fk_assistance_pk_statusclass` FOREIGN KEY (`fk_status_class`) REFERENCES `tbl_e24_cat_status_class` (`pk_status_class`),
  ADD CONSTRAINT `fk_assistance_pk_students` FOREIGN KEY (`fk_student`) REFERENCES `tbl_e24_students` (`pk_student`);

--
-- Filtros para la tabla `tbl_e24_billing_data`
--
ALTER TABLE `tbl_e24_billing_data`
  ADD CONSTRAINT `fk_billingdata_pk_clients` FOREIGN KEY (`fk_client`) REFERENCES `tbl_e24_clients` (`pk_client`);

--
-- Filtros para la tabla `tbl_e24_cat_detail`
--
ALTER TABLE `tbl_e24_cat_detail`
  ADD CONSTRAINT `fk_cat_detail_pk_cat_master` FOREIGN KEY (`fk_cat_master`) REFERENCES `tbl_e24_cat_master` (`pk_cat_master`);

--
-- Filtros para la tabla `tbl_e24_cat_level_detail`
--
ALTER TABLE `tbl_e24_cat_level_detail`
  ADD CONSTRAINT `fk_levelsdetail_pk_levels` FOREIGN KEY (`fk_level`) REFERENCES `tbl_e24_cat_levels` (`pk_level`);

--
-- Filtros para la tabla `tbl_e24_cat_material`
--
ALTER TABLE `tbl_e24_cat_material`
  ADD CONSTRAINT `fk_type_material_pk_cat_detail` FOREIGN KEY (`fk_type_material`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`);

--
-- Filtros para la tabla `tbl_e24_cat_status_class`
--
ALTER TABLE `tbl_e24_cat_status_class`
  ADD CONSTRAINT `fk_role_class_pk_cat_detail` FOREIGN KEY (`fk_role_class`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`),
  ADD CONSTRAINT `fk_type_class_pk_cat_detail` FOREIGN KEY (`fk_type_class`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`);

--
-- Filtros para la tabla `tbl_e24_classroom_address`
--
ALTER TABLE `tbl_e24_classroom_address`
  ADD CONSTRAINT `fk_classroom_pk_clients` FOREIGN KEY (`fk_client`) REFERENCES `tbl_e24_clients` (`pk_client`),
  ADD CONSTRAINT `fk_state_dir_pk_cat_detail` FOREIGN KEY (`fk_state_dir`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`);

--
-- Filtros para la tabla `tbl_e24_clients`
--
ALTER TABLE `tbl_e24_clients`
  ADD CONSTRAINT `fk_type_client_pk_cat_detail` FOREIGN KEY (`fk_type_client`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`),
  ADD CONSTRAINT `fk_user_pk_user` FOREIGN KEY (`fk_user`) REFERENCES `tbl_e24_users` (`pk_user`);

--
-- Filtros para la tabla `tbl_e24_courses`
--
ALTER TABLE `tbl_e24_courses`
  ADD CONSTRAINT `fk_curses_pk_catlevels` FOREIGN KEY (`fk_level`) REFERENCES `tbl_e24_cat_levels` (`pk_level`),
  ADD CONSTRAINT `fk_curses_pk_classrrom_address` FOREIGN KEY (`fk_classrom_address`) REFERENCES `tbl_e24_classroom_address` (`pk_classroom_direction`),
  ADD CONSTRAINT `fk_curses_pk_clients` FOREIGN KEY (`fk_client`) REFERENCES `tbl_e24_clients` (`pk_client`),
  ADD CONSTRAINT `fk_curses_pk_groups` FOREIGN KEY (`fk_group`) REFERENCES `tbl_e24_groups` (`pk_group`),
  ADD CONSTRAINT `fk_curses_pk_teachers` FOREIGN KEY (`fk_teacher`) REFERENCES `tbl_e24_teachers` (`pk_teacher`),
  ADD CONSTRAINT `fk_type_course_pk_cat_detail` FOREIGN KEY (`fk_type_course`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`);

--
-- Filtros para la tabla `tbl_e24_course_schedule`
--
ALTER TABLE `tbl_e24_course_schedule`
  ADD CONSTRAINT `fk_courseschedule_pk_bssday` FOREIGN KEY (`fk_bss_day`) REFERENCES `tbl_e24_cat_bss_day` (`pk_bss_day`),
  ADD CONSTRAINT `fk_courseschedule_pk_courses` FOREIGN KEY (`fk_course`) REFERENCES `tbl_e24_courses` (`pk_course`);

--
-- Filtros para la tabla `tbl_e24_documents_teachers`
--
ALTER TABLE `tbl_e24_documents_teachers`
  ADD CONSTRAINT `fk_docsteachers_pk_catdocs` FOREIGN KEY (`fk_document`) REFERENCES `tbl_e24_cat_documents` (`pk_document`),
  ADD CONSTRAINT `fk_docsteachers_pk_teachers` FOREIGN KEY (`fk_teacher`) REFERENCES `tbl_e24_teachers` (`pk_teacher`);

--
-- Filtros para la tabla `tbl_e24_material_level`
--
ALTER TABLE `tbl_e24_material_level`
  ADD CONSTRAINT `fk_materiallevel_pk_catlevels` FOREIGN KEY (`fk_level`) REFERENCES `tbl_e24_cat_levels` (`pk_level`),
  ADD CONSTRAINT `fk_materiallevel_pk_catmaterial` FOREIGN KEY (`fk_material`) REFERENCES `tbl_e24_cat_material` (`pk_material`);

--
-- Filtros para la tabla `tbl_e24_students`
--
ALTER TABLE `tbl_e24_students`
  ADD CONSTRAINT `fkState_pkCatDetail` FOREIGN KEY (`fk_state_dir`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`),
  ADD CONSTRAINT `fk_client_pk_client_clients` FOREIGN KEY (`fk_client`) REFERENCES `tbl_e24_clients` (`pk_client`),
  ADD CONSTRAINT `fk_user_pk_user_students` FOREIGN KEY (`fk_user`) REFERENCES `tbl_e24_users` (`pk_user`);

--
-- Filtros para la tabla `tbl_e24_teachers`
--
ALTER TABLE `tbl_e24_teachers`
  ADD CONSTRAINT `fk_nationality_pk_cat_detail` FOREIGN KEY (`fk_nationality`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`),
  ADD CONSTRAINT `fk_state_birth_pk_cat_detail` FOREIGN KEY (`fk_state_birth`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`),
  ADD CONSTRAINT `fk_state_pk_cat_detail` FOREIGN KEY (`fk_state_dir`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`),
  ADD CONSTRAINT `fk_status_documents_pk_cat_detail` FOREIGN KEY (`fk_status_document`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`),
  ADD CONSTRAINT `fk_user_pk_catrates` FOREIGN KEY (`fk_user`) REFERENCES `tbl_e24_users` (`pk_user`);

--
-- Filtros para la tabla `tbl_e24_unavailable_dates`
--
ALTER TABLE `tbl_e24_unavailable_dates`
  ADD CONSTRAINT `fk_course_pk_course` FOREIGN KEY (`fk_course`) REFERENCES `tbl_e24_courses` (`pk_course`),
  ADD CONSTRAINT `fk_unav_type_pk_detail` FOREIGN KEY (`fk_unavailability_type`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`);

--
-- Filtros para la tabla `tbl_e24_unavailable_schedule`
--
ALTER TABLE `tbl_e24_unavailable_schedule`
  ADD CONSTRAINT `fk_unvschedule_pk_bssday` FOREIGN KEY (`fk_bss_day`) REFERENCES `tbl_e24_cat_bss_day` (`pk_bss_day`),
  ADD CONSTRAINT `fk_unvschedule_pk_teachers` FOREIGN KEY (`fk_teacher`) REFERENCES `tbl_e24_teachers` (`pk_teacher`);

--
-- Filtros para la tabla `tbl_e24_users`
--
ALTER TABLE `tbl_e24_users`
  ADD CONSTRAINT `fk_role_user_pk_cat_detail` FOREIGN KEY (`fk_role`) REFERENCES `tbl_e24_cat_detail` (`pk_cat_detail`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
