--
-- Drop procedure and functions
--
DROP PROCEDURE IF EXISTS stp_courses;
DROP PROCEDURE IF EXISTS stp_courses_cursor;
DROP PROCEDURE IF EXISTS stp_coursedetail;
DROP PROCEDURE IF EXISTS GetMaestrosDisponible;
DROP FUNCTION IF EXISTS percentComplete;
DROP FUNCTION IF EXISTS courseEndDate;
DROP FUNCTION IF EXISTS courseInitialEndDate;

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`user2646055`@`localhost` FUNCTION `courseEndDate`(p_pk_course INT) RETURNS varchar(1000) CHARSET latin1
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

CREATE DEFINER=`user2646055`@`localhost` FUNCTION `courseInitialEndDate`(p_pk_course INT) RETURNS date
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

CREATE DEFINER=`user2646055`@`localhost` FUNCTION `percentComplete`(p_pk_course INT) RETURNS decimal(5,2)
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

--
-- Procedimientos
--
CREATE DEFINER=`user2646055`@`localhost` PROCEDURE `GetMaestrosDisponible`(in horarioMsg text)
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

CREATE DEFINER=`user2646055`@`localhost` PROCEDURE `stp_coursedetail`(IN  p_pk_course        INT,
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
               -- GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
                                            -- @errno    = MYSQL_ERRNO,
                                            -- @text     = MESSAGE_TEXT;
          -- SET p_message = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
          SET p_message = 'Ocurrio un error.';
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

CREATE DEFINER=`user2646055`@`localhost` PROCEDURE `stp_courses`(IN  p_pk_course  INT,
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
                -- GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
                --                      @errno    = MYSQL_ERRNO,
                --                      @text     = MESSAGE_TEXT;
          -- SET p_message = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
          SET p_message = 'Ocurrio un error.';
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

CREATE DEFINER=`user2646055`@`localhost` PROCEDURE `stp_courses_cursor`( IN  p_pk_course  INT,
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
                -- GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
                --                      @errno    = MYSQL_ERRNO,
                --                      @text     = MESSAGE_TEXT;
          -- SET p_message = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
          SET p_message = 'Ocurrio un error.';
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

DELIMITER ;
