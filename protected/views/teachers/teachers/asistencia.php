<?php

$this->breadcrumbs = array(
    'Cursos' => array('teachers/teachers/cursos'),
    'Curso[' . $_SESSION['asistencia']['descCurso'] . ']',
    'Asistencia'
);
$this->menu = array(
    array('label' => 'Cursos', 'url' => Yii::app()->createUrl("teachers/teachers/cursos")),
);
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(
        Yii::app()->clientScript->getCoreScriptUrl().
        '/jui/css/base/jquery-ui.css'
);
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/js/jsNotifications/ext/jboesch-Gritter/css/jquery.gritter.css');
$cs->registerScriptFile($baseUrl.'/js/jsNotifications/ext/jboesch-Gritter/js/jquery.gritter.min.js');
$cs->registerScriptFile($baseUrl.'/js/jsNotifications/jsNotifications.js');
Yii::app()->clientScript->registerScript('script',
        '
        $("#trRecalendarizar").hide();
        $("#trCancelacionLbl").hide();
        $("#trCancelacionTxt").hide();
        $("#dialogAsistencia").dialog({
            autoOpen: false,
            modal: true,
            dialogClass: "no-close",
            resizable: false,
            draggable: false,
            width : "auto",
            height : "auto",
            buttons:{
                "Guardar": function(){
                    guardarAssistencia();
                },
                "Cancelar": function(){
                    $("#dialogAsistencia").dialog("close");
                }
            }
        }).css("font-size", "13px");
        $(".ui-dialog-titlebar").hide();

        $("#estatusClase").change(function() {
            if((this.value == '.constantes::CLASE_RECALENDARIZADO_GRP.') || (this.value == '.constantes::CLASE_RECALENDARIZADO_IND.')){
                $("#trRecalendarizar").show();
            }else{
                $("#trRecalendarizar").hide();
            }
            if((this.value == '.constantes::CLASE_CANCELADA_GRP.') || (this.value == '.constantes::CLASE_CANCELADA_IND.')){
                $("#trCancelacionLbl").show();
                $("#trCancelacionTxt").show();
            }else{
                $("#trCancelacionLbl").hide();
                $("#trCancelacionTxt").hide();
            }
        });

        $.ajax({
            url: "'.Yii::app()->createUrl("teachers/teachers/getCursoCalendario").'", 
            dataType: "text",
            async: true,
            data: { diffMes: 0},
         }).done(function( msg ) {
            if(msg !== ""){
                var arrayMsg = msg.split("@");
                $("#tablaCursoMes tbody").html(arrayMsg[0]);
                $("#tituloTabla").html("ASISTENCIA - "+arrayMsg[1]);
            }
         });
        '
        ,CClientScript::POS_READY);
?>
<script>
    var diffMes = 0;
    var notificacion=new jsNotifications({
        autoCloseTime : 4,
        showAlerts: true,
        title: "Portal English e24"
    });
    function atrasFecha(){
        diffMes--;
        $.ajax({
            url: "<?= Yii::app()->createUrl('teachers/teachers/getCursoCalendario'); ?>", 
            dataType: "text",
            async: true,
            data: { diffMes: diffMes},
         }).done(function( msg ) {
            if(msg !== ""){
                var arrayMsg = msg.split("@");
                $("#tablaCursoMes tbody").html(arrayMsg[0]);
                $("#tituloTabla").html("ASISTENCIA - "+arrayMsg[1]);
            }
         });
    }
    
    function siguienteFecha(){
        diffMes++;
        $.ajax({
            url: "<?= Yii::app()->createUrl('teachers/teachers/getCursoCalendario'); ?>", 
            dataType: "text",
            async: true,
            data: { diffMes: diffMes},
         }).done(function( msg ) {
            if(msg !== ""){
                var arrayMsg = msg.split("@");
                $("#tablaCursoMes tbody").html(arrayMsg[0]);
                $("#tituloTabla").html("ASISTENCIA - "+arrayMsg[1]);
            }
         });
    }
    
    function capturarAsistencia(esNuevo, fechaClase, pkAsistencia, fkStatusClase, fechaRecandelarizado, horaRecalendarizado, razonCancelacion, fkNivelDetalle){
        $("#trRecalendarizar").hide();
        $("#trCancelacionLbl").hide();
        $("#trCancelacionTxt").hide();
        $("#pkAsistencia").val("");
        $("#fechaClase").val(fechaClase);
        
        if(esNuevo === 1){
            $("#estatusClase").val(0);
            $("#detalleNivel").val(0);
            $("#razonCancelacion").val("");
        }else{
            $("#estatusClase").val(fkStatusClase);
            $("#detalleNivel").val(fkNivelDetalle);
            $("#razonCancelacion").val(razonCancelacion);
            $("#fechaRecalendarizar").val(fechaRecandelarizado);
            $("#horaRecalendarizar").val(horaRecalendarizado);
            $("#pkAsistencia").val(pkAsistencia);
            if((fkStatusClase === <?= constantes::CLASE_CANCELADA_GRP ?>) || (fkStatusClase === <?= constantes::CLASE_CANCELADA_IND ?>)){
                $("#trCancelacionLbl").show();
                $("#trCancelacionTxt").show();
            }
            
            if((fkStatusClase === <?= constantes::CLASE_RECALENDARIZADO_GRP ?>) || (fkStatusClase === <?= constantes::CLASE_RECALENDARIZADO_IND ?>)){
                $("#trRecalendarizar").show();
            }
        }
        $("#dialogAsistencia").dialog("open");
    }
    
    function guardarAssistencia(){
        var fkStatusClase = parseInt($("#estatusClase").val());
        if($("#estatusClase").val() === ""){
            notificacion.show('error','Seleccionar estatus de clase.');
            return;
        }
        if((fkStatusClase === <?= constantes::CLASE_CANCELADA_GRP ?>) || (fkStatusClase === <?= constantes::CLASE_CANCELADA_IND ?>)){
            if($("#razonCancelacion").val().trim().length <= 0){
                notificacion.show('error','Capturar razón de cancelación.');
                return;
            }
        }else if((fkStatusClase === <?= constantes::CLASE_RECALENDARIZADO_GRP ?>) || (fkStatusClase === <?= constantes::CLASE_RECALENDARIZADO_IND ?>)){
            if(($("#fechaRecalendarizar").val().trim().length <= 0) || ($("#horaRecalendarizar").val().trim().length <= 0)){
                notificacion.show('error','Capturar fecha y hora de recalendarización.');
                return;
            }
            if($("#horaRecalendarizar").val() === "00:00"){
                notificacion.show('error','Hora de recalendarización no válida.');
                return;
            }
        }
        
        var esNuevo = 0;
        if($("#pkAsistencia").val() === ""){
            esNuevo = 1;
        }
        
        $.ajax({
            url: "<?= Yii::app()->createUrl('teachers/teachers/guardarAsistenciaClase'); ?>", 
            dataType: "text",
            async: true,
            data: { esNuevo: esNuevo, 
                    pkAsistencia : $("#pkAsistencia").val(), 
                    fechaClase : $("#fechaClase").val(),
                    fkStatusClase : fkStatusClase,
                    fechaRecalendar : $("#fechaRecalendarizar").val(),
                    horaRecalendar : $("#horaRecalendarizar").val(),
                    razonCancelacion : $("#razonCancelacion").val(),
                    fkLevelDetalle : $("#detalleNivel").val()},
         }).done(function( msg ) {
            $("#dialogAsistencia").dialog("close");
            $.ajax({
                url: "<?= Yii::app()->createUrl('teachers/teachers/getCursoCalendario'); ?>", 
                dataType: "text",
                async: true,
                data: { diffMes: diffMes},
             }).done(function( msg ) {
                if(msg !== ""){
                    var arrayMsg = msg.split("@");
                    $("#tablaCursoMes tbody").html(arrayMsg[0]);
                    $("#tituloTabla").html("ASISTENCIA - "+arrayMsg[1]);
                }
             });
         });
    }
</script>
<table class="calendarioMes">
    <thead id="CalendarHead">
        <tr>
            <td style="text-align: left; "><span style="cursor: pointer" onclick="atrasFecha()">< ANTERIOR</span></td>
            <td style="text-align: center; font-weight: bold"><span id="tituloTabla"></span></td>
            <td style="text-align: right;"><span style=" cursor: pointer" onclick="siguienteFecha()">SIGUIENTE ></span></td>
        </tr>
    </thead>
</table>
<table class="MonthlyCalendar" id="tablaCursoMes">
    <thead class="CalendarHead">
        <tr>
            <th class="DateHeader first">LUN</th>
            <th class="DateHeader">MAR</th>
            <th class="DateHeader">MI&Eacute;</th>
            <th class="DateHeader">JUE</th>
            <th class="DateHeader">VIE</th>
            <th class="DateHeader">S&Aacute;B</th>
            <th class="DateHeader last">DOM</th>
        </tr>
    </thead>
    <tbody class="CalendarBody">
    </tbody>
</table>

<div id="dialogAsistencia" title="Capturar Asistencia" class="ui-widget">
    <input type="hidden" id="pkAsistencia">
    <input type="hidden" id="fechaClase">
    <table class="ui-widget ui-widget-content">
        <tr class="ui-widget-header ">
          <th colspan="4" style="text-align:center">Asistencia Clase</th>
        </tr>
      <tr>
        <td>Estatus</td>
        <td><?php echo CHtml::dropDownList('estatusClase', '', CatStatusClass::model()->getCatStatusClassListData($_SESSION['asistencia']['pkTipoCurso']), 
                    array(
                        "tabindex" => "0",
                        "empty" => constantes::OPCION_COMBO)
                    ); ?></td>
        <td>Detalle Nivel</td>
        <td><?php echo CHtml::dropDownList('detalleNivel', '', CatLevelDetail::model()->getCatLevelDetailsListData($_SESSION['asistencia']['pkNivel']), 
                    array(
                        "tabindex" => "0",
                        "empty" => constantes::OPCION_COMBO)
                    ); ?></td>
      </tr>
      <tr id="trRecalendarizar">
         <td>fecha</td>
        <td><?php
                  $this->widget('zii.widgets.jui.CJuiDatePicker',
                          array('attribute'=>'initial_date',
                                'name'=>'fechaRecalendarizar',
                                'options' => array(
                                      'mode'=>'focus',
                                      'dateFormat'=> constantes::FORMATO_FECHA,
                                      'showAnim' => 'slideDown',
                                      'minDate'=>0,
                                ),
                                'htmlOptions'=>array('size'=>20,'class'=>'date', //'value'=>date("d F, Y")
                                ),
                          )); 
              ?></td>
        <td>Hora</td>
        <td><?php $this->widget('CMaskedTextField', array(
                              'name'=>'horaRecalendarizar',
                              'value' => '00:00',
                              'mask' => '99:99',
                              'htmlOptions' => array('size' => 5)
                              )
                          ); ?></td>
      </tr>
      <tr id="trCancelacionLbl">
          <td colspan="4">Raz&oacute;n cancelaci&oacute;n</td>
      </tr>
      <tr id="trCancelacionTxt">
          <td colspan="4"><?php echo CHtml::textArea('razonCancelacion','',array('rows'=>2,'maxlength'=>100, 'style' => 'resize: none; width : 100%')); ?></td>
      </tr>
    </table>
    
    <table class="ui-widget ui-widget-content" id="tablaAlumnos">
        <tr class="ui-widget-header ">
          <th colspan="4" style="text-align:center">Asistencia Alumnos</th>
        </tr>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    
</div>
