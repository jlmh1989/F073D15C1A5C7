<?php
/* @var $this CoursesController */
/* @var $form CActiveForm */
$scriptGetHorarioHtml = '';
if(isset($_SESSION['horarioCurso'])){
    $scriptGetHorarioHtml = '
        $.ajax({
            url: "'.Yii::app()->createUrl("courses/courses/getHorarioHtml").'", 
            dataType: "text"
         }).done(function( msg ) {
            if(msg !== ""){
                $("#tr_horario").css("visibility","");
                $( "#tablaHorario tbody" ).html(msg);
            }
         });';
}
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(
        Yii::app()->clientScript->getCoreScriptUrl().
        '/jui/css/base/jquery-ui.css'
);
Yii::app()->clientScript->registerScript('script',
        '
        $("#irAtras").click(function(){
            $(location).attr("href","'.Yii::app()->createUrl('courses/courses/createDatos').'");
        });
        
        $("#error").hide();
        
        '.$scriptGetHorarioHtml
        ,CClientScript::POS_READY);
?>
<script type="text/javascript">
    function eliminarHorario(bssDay, id){
        $.ajax({
            type: "POST",
            url: "<?= Yii::app()->createUrl('courses/courses/eliminarHorario');?>",
            data: { bssDay: bssDay, id : id},
            dataType: "text"
        }).done(function( msg ) {
            $.ajax({
                url: "<?= Yii::app()->createUrl('courses/courses/getHorarioHtml');?>", 
                dataType: "text"
             }).done(function( msg ) {
                 if(msg === ""){
                     $("#tr_horario").css("visibility","hidden");
                 }
                 $("#tablaHorario tbody").html(msg);
             });
        });
    }
    
    function agregarHorario(){
        $("#labelErrorHorario").html("");
        $("#horaInicio").val("00:00");
        $("#horaFin").val("00:00");
        $("#labelAgregarHorario").html("Agregar horario para el d&iacute;a <b>" + $("#bssDay option:selected").text()+"</b>");
        $("#dialog").dialog({
            dialogClass: "no-close",
            resizable: false,
            draggable: false,
            modal: true,
            create: function( event, ui ) {
                $("#dialog").css("visibility","");
            },
            buttons:{
                "Agregar": function(){
                    $.ajax({
                    type: "POST",
                    url: "<?= Yii::app()->createUrl('courses/courses/agregarHorario');?>",
                    data: { bssDay: $("#bssDay").val(), inicio : $("#horaInicio").val(), fin : $("#horaFin").val()},
                    dataType: "text"
                    })
                    .done(function( msg ) {
                        var json = $.parseJSON(msg);
                        if(json.estatus){
                            $.ajax({
                               url: "<?= Yii::app()->createUrl('courses/courses/getHorarioHtml');?>", 
                               dataType: "text"
                            }).done(function( msg ) {
                                $("#tr_horario").css("visibility","");
                                $( "#tablaHorario tbody" ).html(msg);
                                $("#dialog").dialog("close"); 
                            });
                        }else{
                            $("#labelErrorHorario").html(json.mensaje);
                        }
                    });
                },
                "Cancelar": function() {
                    $(this).dialog("close");
                }
            }
        }).css("font-size", "14px");
    }
    
    function siguiente(){
        $.ajax({
            url: "<?= Yii::app()->createUrl('courses/courses/validarHorario');?>", 
            dataType: "text"
         }).done(function( msg ) {
             var json = $.parseJSON(msg);
             if(json.existe){
                 $("#courses-formHorario").submit();
             }else{
                 $('#error')
                    .show({duration: 0, queue: true})
                    .delay(3000)
                    .hide({duration: 0, queue: true});
             }
         });
    }
</script>
<div class="form">
    <table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'courses-formHorario',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'action' => Yii::app()->createUrl('courses/courses/createHorario'),
)); ?>
        <tr>
             <th id="horario_th" colspan="4" style="text-align: center">
                DEFINIR HORARIO
            </th>
         </tr>
         <tr>
             <td class="horario_td" style="text-align: right"><?php echo CHtml::label('Dia','diaH'); ?></td>
             <td class="horario_td" width="240px"><?php echo CHtml::dropDownList('bssDay', '', CatBssDay::model()->getCatBssDayListData(constantes::ACTIVO)); ?></td>
             <td class="horario_td" width="240px"><?php echo CHtml::button('Agregar', array('onClick'=>'agregarHorario()')); ?></td>
             <td class="horario_td"></td>
         </tr>
         <tr id="tr_horario" style="visibility: hidden">
            <td colspan="4">
                <table class="zebra" align="center" class="horario_td" id="tablaHorario">
                    <thead>
                        <tr>
                            <td width="100px" align="center" style="font-weight: bold; font-size: 12px">Dia</td>
                            <td width="100px" align="center" style="font-weight: bold; font-size: 12px">Hora Inicio</td>
                            <td width="100px" align="center" style="font-weight: bold; font-size: 12px">Hora Fin</td>
                            <td width="100px" align="center" style="font-weight: bold; font-size: 12px"></td>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </td>
        </tr>
        </table>
    <hr>
    <table>
        <tr>
            <td width="130px"><div class="boton" id="irAtras"><< Atr&aacute;s</div></td>
            <td width="480px" colspan="2" style="text-align: center"><span id="error" style="color: red; font-weight: bold">Debe capturar al menos un horario.</span></td>
            <div class="row buttons">
                <td><div class="boton" id="irAtras" onclick="siguiente()">Siguiente >></div></td>
        </div>
        </tr>
    </table>
</div>
<?php $this->endWidget(); ?>

<div id="dialog" title="Agregar horario" style="visibility: hidden">
    <span id="labelAgregarHorario" style="text-align: center"></span>
    <form>
        <table class="zebra">
            <tr>
                <td width="50px">Inicio</td>
                <td><?php $this->widget('CMaskedTextField', array(
                                'name'=>'horaInicio',
                                'value' => '00:00',
                                'mask' => '99:99',
                                'htmlOptions' => array('size' => 5)
                                )
                            ); ?></td>
            </tr>
            <tr>
                <td>Fin</td>
                <td><?php $this->widget('CMaskedTextField', array(
                                'name'=>'horaFin',
                                'value' => '00:00',
                                'mask' => '99:99',
                                'htmlOptions' => array('size' => 5)
                                )
                            ); ?></td>
            </tr>
        </table>
        <span id="labelErrorHorario" style="text-align: center; color: red; font-weight: bold"></span>
    </form>
</div>
