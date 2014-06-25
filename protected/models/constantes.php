<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class constantes{
    private static $opcion = array("tabindex" => "0","empty" => "Seleccione una opci&oacute;n");
    const OPCION_COMBO = "Seleccione una opci&oacute;n";
    public static $opcion_si_no = array(1=>'SI',0=>'NO');
    public static $opcion_status = array(1=>'ACTIVO',0=>'INACTIVO');
    const LANG = "es";
    const ROL_ESTUDIANTE = "58";
    const ROL_MAESTRO = "59";
    const ROL_CLIENTE = "60";
    const ROL_ADMINISTRADOR = "61";
    const ROL_ADMIN_SISTEMA = "62";
    const CLIENTE_EMPRESA = "2";
    const CLIENTE_PARTICULAR = "3";
    const ACTIVO = "1";
    const INACTIVO = "0";
    const SI = "1";
    const NO = "0";
    const OTRA_NACIONALIDAD = "12";
    const FORMATO_FECHA = "yy-mm-dd";
    const PATRON_PASS = '$1$Ehc23$09P';
    const CURSO_GRUPAL = "5";
    const CURSO_INDIVIDUAL = "4";

    public static function getOpcionCombo() {
        return self::$opcion;
    }
    
    public static function getOpcionSiNo(){
        return self::$opcion_si_no;
    }
    
    public static function getOpcionStatus(){
        return self::$opcion_status;
    }
}

