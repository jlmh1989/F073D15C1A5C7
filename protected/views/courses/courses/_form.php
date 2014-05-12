<?php
/* @var $this CoursesController */
/* @var $model Courses */
/* @var $form CActiveForm */
$scriptGetHorarioHtml = '
        $.ajax({
            url: "'.Yii::app()->createUrl("courses/courses/getHorarioHtml").'", 
            dataType: "text"
         }).done(function( msg ) {
             $("#tr_horario").css("visibility","");
             $( "#tablaHorario tbody" ).html(msg);
         });';
if($model->pk_course == null){
    unset($_SESSION['horarioCurso']);
    $scriptGetHorarioHtml = '';
}

Yii::app()->clientScript->registerScript('script',
        '
        $(".mapa_div").hide();
        $("#datos_th").click(function() {
            if($(".datos_td").is(":visible")){
                $(".datos_td").hide();
            }else{
                $(".datos_td").show();
            }
        });
        
        $("#horario_th").click(function() {
            if($(".horario_td").is(":visible")){
                $(".horario_td").hide();
            }else{
                $(".horario_td").show();
            }
        });
        
        $("#direccion_th").click(function() {
            if($(".direccion_td").is(":visible")){
                $(".direccion_td").hide();
            }else{
                $(".direccion_td").show();
            }
        });
        
        $("#datos_mapa_th").click(function() {
            if($(".datos_mapa_td").is(":visible")){
                $(".datos_mapa_td").hide();
            }else{
                $(".datos_mapa_td").show();                
            }
        });
        '.$scriptGetHorarioHtml,
        CClientScript::POS_READY);
?>
<script type="text/javascript" src="//www.google.com/jsapi"></script>
<script type="text/javascript">
    /*<![CDATA[*/
    google.load("maps", "3", {'other_params': 'sensor=false'});

    var map = null;
    /*]]>*/
    
    /*<![CDATA[*/
    function pintarMapa(latitud, longitud) {
        var mapOptions = {center: new google.maps.LatLng(latitud, longitud),
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControlOptions: {sensor: true,
                position: google.maps.ControlPosition.LEFT_BOTTOM,
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}};

        map = new google.maps.Map(document.getElementById("mapa"), mapOptions);

        var EGMapMarker1 = new google.maps.Marker({map: map,
            position: new google.maps.LatLng(latitud, longitud),
            title: 'Ubicacion Curso'});
    }
    //google.maps.event.addDomListener(window, "load",pintarMapa);

    /*]]>*/

    function cargaMapa(){   
        var datoMapa = $("#Courses_dato_mapa").val();
        var arrayDM = datoMapa.split(",");
        var latitud = $.trim(arrayDM[0]);
        var longitud = $.trim(arrayDM[1]);
        console.log(arrayDM);
        if((latitud.trim() !== "") && (longitud.trim() !== "")){
            pintarMapa(latitud.trim(), longitud.trim());
            $(".mapa_div").show();
        }else{
            $(".mapa_div").hide();
        }
    }
    
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
    
    function cargaDomicilioCliente(fkClient){
        if(fkClient == ''){
            $("#calleCT").val("");
            $("#numeroCT").val("");
            $("#numeroIntCT").val("");
            $("#coloniaCT").val("");
            $("#municipioCT").val("");
            $("#estadoCT").val("");
            $("#paisCT").val("");
            $("#cpCT").val("");
            $("#telCT").val("");
        }else{
            $.ajax({
                type: "POST",
                url: "<?= Yii::app()->createUrl('courses/courses/domicilioCliente');?>",
                data: { fkClient: fkClient},
                dataType: "text"
                })
                .done(function( msg ) {
                    var json = $.parseJSON(msg);
                    if(json.existe){
                        $("#calleCT").val(json.calle);
                        $("#numeroCT").val(json.numero);
                        $("#numeroIntCT").val(json.numeroInt);
                        $("#coloniaCT").val(json.colonia);
                        $("#municipioCT").val(json.municipio);
                        $("#estadoCT").val(json.estado);
                        $("#paisCT").val(json.pais);
                        $("#cpCT").val(json.cp);
                        $("#telCT").val(json.telefono);
                    }else{
                        $("#calleCT").val("");
                        $("#numeroCT").val("");
                        $("#numeroIntCT").val("");
                        $("#coloniaCT").val("");
                        $("#municipioCT").val("");
                        $("#estadoCT").val("");
                        $("#paisCT").val("");
                        $("#cpCT").val("");
                        $("#telCT").val("");
                    }
                });
        }
    }
</script>

<div class="form">
    <table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'courses-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
        
        <tr>
            <th id="datos_th" colspan="4" class="zebra_th" style="text-align: center">DATOS DEL CURSO</th>
        </tr>
        
       <tr>
           <div class="row">
               <td class="datos_td"><?php echo $form->labelEx($model,'fk_client'); ?></td>
            <td class="datos_td"><?php echo $form->dropDownList($model,'fk_client', Clients::model()->getClientsActivos(), array(
                        "tabindex" => "0",
                        "empty" => constantes::OPCION_COMBO,
                        'onChange' => 'cargaDomicilioCliente(this.value)')
                    ); ?>
		<?php echo $form->error($model,'fk_client'); ?></td>
	</div>
       
       <div class="row">
            <td class="datos_td"><?php echo $form->labelEx($model,'fk_type_course'); ?></td>
            <td class="datos_td"><?php echo $form->dropDownList($model,'fk_type_course',  CatDetail::model()->getCatDetailsOptions(constantesCatalogos::TIPO_CURSO,  constantes::LANG), constantes::getOpcionCombo()); ?>
		<?php echo $form->error($model,'fk_type_course'); ?></td>
	</div>

        </tr>
        
        <tr>
            <div class="row">
            
                <td class="datos_td"><?php echo $form->labelEx($model,'fk_level'); ?></td>
                <td class="datos_td" width="240px"><?php echo $form->dropDownList($model,'fk_level', CatLevels::model()->getCatLevels(), constantes::getOpcionCombo()); ?>
		<?php echo $form->error($model,'fk_level'); ?></td>
	</div>
        <div class="row">
            <td class="datos_td"><?php echo $form->labelEx($model,'other_level'); ?></td>
            <td class="datos_td"><?php echo $form->textField($model,'other_level',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'other_level'); ?></td>
	</div>
        </tr>
        
        <tr>
	<div class="row">
            <div class="row">
            <td class="datos_td"><?php echo $form->labelEx($model,'fk_group'); ?></td>
		<td class="datos_td"><?php echo $form->dropDownList($model,'fk_group', Groups::model()->getGroups(), constantes::getOpcionCombo()); ?>
		<?php echo $form->error($model,'fk_group'); ?></td>
	</div>
            
            <td class="datos_td"><?php echo $form->labelEx($model,'fk_teacher'); ?></td>
		<td class="datos_td"><?php echo $form->dropDownList($model,'fk_teacher', Teachers::model()->getTeachers(), constantes::getOpcionCombo()); ?>
		<?php echo $form->error($model,'fk_teacher'); ?></td>
	</div>
        </tr>
        <tr>
	
	<div class="row">
            <td class="datos_td"><?php echo $form->labelEx($model,'initial_date'); ?></td>
                <td class="datos_td"><?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array('attribute'=>'initial_date',
                                  'name'=>'initial_date',
                                  'model'=>$model,
                                  'options' => array(
                                                'mode'=>'focus',
                                                'dateFormat'=> constantes::FORMATO_FECHA,
                                                'showAnim' => 'slideDown',
                                  ),
                                  'htmlOptions'=>array('size'=>20,'class'=>'date', //'value'=>date("d F, Y")
                                  ),
                            )); 
                ?>
		<?php echo $form->error($model,'initial_date'); ?></td>
	</div>
        <div class="row">
            <td class="datos_td"><?php echo $form->labelEx($model,'desc_curse'); ?></td>
            <td class="datos_td"><?php echo $form->textField($model,'desc_curse',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'desc_curse'); ?></td>
	</div>
        </tr>
         <tr>
             <th id="horario_th" colspan="4" style="text-align: center">
                DEFINIR HORARIO
            </th>
         </tr>
         <?php
         $visible = "";
         if(!isset($_SESSION["horarioCurso"])){
             $visible = "hidden";
         }
         ?>
         <tr id="tr_horario" style="visibility: <?= $visible ?>">
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
        <tr>
             <td class="horario_td" style="text-align: right"><?php echo CHtml::label('Dia','diaH'); ?></td>
             <td class="horario_td"><?php echo CHtml::dropDownList('bssDay', '', CatBssDay::model()->getCatBssDayListData(constantes::ACTIVO)); ?></td>
             <td class="horario_td"><?php echo CHtml::button('Agregar', array('onClick'=>'agregarHorario()')); ?></td>
             <td class="horario_td"></td>
         </tr>
        <tr>
            <th id="direccion_th" colspan="4" style="text-align: center">
                DIRECCION DONDE SE IMPARTIRAN LAS CLASES
            </th>
        </tr>
        <tr>
            <td class="direccion_td">
                <?php echo CHtml::label('Calle','calleCL'); ?>
            </td>
            <td class="direccion_td">
                <?php echo CHtml::textField('calleCT', '', array('disabled'=>true, 'id'=>'calleCT')); ?>
            </td>
            <td class="direccion_td">
                <?php echo CHtml::label('N&uacute;mero','numeroCL'); ?>
            </td>
            <td class="direccion_td">
                <?php echo CHtml::textField('numeroCT', '', array('disabled'=>true, 'id'=>'numeroCT')); ?>
            </td>
        </tr>
        
        <tr>
            <td class="direccion_td">
                <?php echo CHtml::label('N&uacute;mero Interior','numeroIntCL'); ?>
            </td>
            <td class="direccion_td">
                <?php echo CHtml::textField('numeroIntCT', '', array('disabled'=>true, 'id'=>'numeroIntCT')); ?>
            </td>
            <td class="direccion_td">
                <?php echo CHtml::label('Colonia','coloniaCL'); ?>
            </td>
            <td class="direccion_td">
                <?php echo CHtml::textField('coloniaCT', '', array('disabled'=>true, 'id'=>'coloniaCT')); ?>
            </td>
        </tr>
        
        <tr>
            <td class="direccion_td">
                <?php echo CHtml::label('Municipio','municipioCL'); ?>
            </td>
            <td class="direccion_td">
                <?php echo CHtml::textField('municipioCT', '', array('disabled'=>true, 'id'=>'municipioCT')); ?>
            </td>
            <td class="direccion_td">
                <?php echo CHtml::label('Estado','estadoCL'); ?>
            </td>
            <td class="direccion_td">
                <?php echo CHtml::textField('estadoCT', '', array('disabled'=>true, 'id'=>'estadoCT')); ?>
            </td>
        </tr>
        
        <tr>
            <td class="direccion_td">
                <?php echo CHtml::label('Pa&iacute;s','paisCL'); ?>
            </td>
            <td class="direccion_td">
                <?php echo CHtml::textField('paisCT', '', array('disabled'=>true, 'id'=>'paisCT')); ?>
            </td>
            <td class="direccion_td">
                <?php echo CHtml::label('C&oacute;digo Postal','cpCL'); ?>
            </td>
            <td class="direccion_td">
                <?php echo CHtml::textField('cpCT', '', array('disabled'=>true, 'id'=>'cpCT')); ?>
            </td>
        </tr>
        
        <tr>
            <td class="direccion_td">
                <?php echo CHtml::label('Tel&eacute;fono','telCL'); ?>
            </td>
            <td class="direccion_td">
                <?php echo CHtml::textField('telCT', '', array('disabled'=>true, 'id'=>'telCT')); ?>
            </td>
        </tr>
        <tr>
            <th id="datos_mapa_th" colspan="4" style="text-align: center">
                DATOS PARA EL MAPA
            </th>
        </tr>
        <tr>
	<div class="row">
                <td class="datos_mapa_td"><?php //echo $form->labelEx($model,'dato_mapa'); ?></td>
		<td class="datos_mapa_td"><?php //echo $form->textField($model,'dato_mapa',array('size'=>25,'maxlength'=>25,'onblur'=>'cargaMapa()')); ?>
		<?php //echo $form->error($model,'dato_mapa'); ?></td>
	</div>
        
        <tr>
            <td colspan="4" class="datos_mapa_td"><div id="mapa" style="width:700px;height:300px;" class="mapa_div"></div></td>
        </tr>
        
        </tr>
        <tr>
	<div class="row buttons">
            <td><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></td>
	</div>
            <td></td>
            <td></td>
            <td></td>
        </tr>

<?php $this->endWidget(); ?>
</table>
</div><!-- form -->

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