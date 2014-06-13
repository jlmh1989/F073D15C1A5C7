<?php
/* @var $this CoursesController */
/* @var $model ClassroomAddress */
/* @var $form CActiveForm */
$ajaxDom = '
        $("#cancelarDomicilio").hide();
        $("#guardarDomicilio").hide();
        $("#irAtras").show();
        $("#guardar").show();
        $("#ClassroomAddress_street").prop("disabled", true);
        $("#ClassroomAddress_street_number").prop("disabled", true);
        $("#ClassroomAddress_street_number_int").prop("disabled", true);
        $("#ClassroomAddress_neighborhood").prop("disabled", true);
        $("#ClassroomAddress_county").prop("disabled", true);
        $("#ClassroomAddress_fk_state_dir").prop("disabled", true);
        $("#ClassroomAddress_country").prop("disabled", true);
        $("#ClassroomAddress_zipcode").prop("disabled", true);
        $("#ClassroomAddress_phone").prop("disabled", true);
        $("#ClassroomAddress_datos_mapa").prop("disabled", true);'; 
if($_SESSION['curso']['nuevo'] === 1 || $_SESSION['curso']['nuevo'] === 2){
    $ajaxDom = '$("#cancelarDomicilio").show();
                $("#guardarDomicilio").show();
                $("#irAtras").hide();
                $("#guardar").hide();
                $("#ClassroomAddress_street").prop("disabled", false);
                $("#ClassroomAddress_street_number").prop("disabled", false);
                $("#ClassroomAddress_street_number_int").prop("disabled", false);
                $("#ClassroomAddress_neighborhood").prop("disabled", false);
                $("#ClassroomAddress_county").prop("disabled", false);
                $("#ClassroomAddress_fk_state_dir").prop("disabled", false);
                $("#ClassroomAddress_country").prop("disabled", false);
                $("#ClassroomAddress_zipcode").prop("disabled", false);
                $("#ClassroomAddress_phone").prop("disabled", false);
                $("#ClassroomAddress_datos_mapa").prop("disabled", false);';
}
Yii::app()->clientScript->registerScript('script',
        '
        $(".mapa_div").hide();
        
        $("#irAtras").click(function(){
            $(location).attr("href","'.Yii::app()->createUrl('courses/courses/asignarMaestro').'");
        });
        
        '.$ajaxDom.
        '
        $.ajax({
            url: "'.Yii::app()->createUrl("courses/courses/getDomicilioHtml").'", 
            dataType: "text"
         }).done(function( msg ) {
            if(msg !== ""){
                $( "#tablaDmicilios tbody" ).html(msg);
            }
         });
         
        $(function () {
            $("#ClassroomAddress_datos_mapa").blur();
        });
        
        ',CClientScript::POS_READY);
?>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("maps", "3", {other_params:'sensor=false'});
    var latitud;
    var longitud;
    var isLoadInit = true;
    
    function loadApiGoogle() {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +
                     'callback=pintarMapa';
        document.body.appendChild(script);
    }
    
    function pintarMapa() {
        var latLng = new google.maps.LatLng(latitud, longitud);
        var mapOptions = {
            center: latLng,
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControlOptions: {sensor: true,
                position: google.maps.ControlPosition.LEFT_BOTTOM,
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}};

        var map = new google.maps.Map(document.getElementById("mapa"), mapOptions);
        new google.maps.Marker({map: map,
            position: latLng,
            title: 'Ubicacion Curso'});
    }
    
    function cargaMapa(){
        var datoMapa = $("#ClassroomAddress_datos_mapa").val();
        var arrayDM = datoMapa.split(",");
        latitud = $.trim(arrayDM[0]);
        longitud = $.trim(arrayDM[1]);
        if((latitud.trim() !== "") && (longitud.trim() !== "")){
            pintarMapa();
            $(".mapa_div").show();
        }else{
            $(".mapa_div").hide();
        }
    }
    
    function cargarDomicilio(pk){
        $.ajax({
            type: "POST",
            url: "<?= Yii::app()->createUrl('courses/courses/getDomicilioJson');?>",
            data: { pk: pk},
            dataType: "text"
        }).done(function( msg ) {
            var json = $.parseJSON(msg);
            $("#ClassroomAddress_pk_classroom_direction").val(json.pk_classroom_direction);
            $("#ClassroomAddress_fk_client").val(json.fk_client);
            $("#ClassroomAddress_street").val(json.street);
            $("#ClassroomAddress_street_number").val(json.street_number);
            $("#ClassroomAddress_street_number_int").val(json.street_number_int);
            $("#ClassroomAddress_neighborhood").val(json.neighborhood);
            $("#ClassroomAddress_county").val(json.county);
            $("#ClassroomAddress_fk_state_dir").val(json.fk_state_dir);
            $("#ClassroomAddress_country").val(json.country);
            $("#ClassroomAddress_zipcode").val(json.zipcode);
            $("#ClassroomAddress_status").val(json.status);
            $("#ClassroomAddress_phone").val(json.phone);
            $("#ClassroomAddress_datos_mapa").val(json.datos_mapa);
            $("#ClassroomAddress_datos_mapa").blur();
        });
    }
    
    function nuevoDomicilio(){
        $.ajax("<?= Yii::app()->createUrl('courses/courses/guardarDireccion')?>");
        $("#dir_clase_th").html("CREAR NUEVA DIRECCI&Oacute;N");
        $("#cancelarDomicilio").show();
        $("#guardarDomicilio").show();
        $("#nuevoDomicilio").hide();
        $(".mapa_div").hide();
        $("#irAtras").hide();
        $("#guardar").hide();
        $("#ClassroomAddress_street").val("");
        $("#ClassroomAddress_street_number").val("");
        $("#ClassroomAddress_street_number_int").val("");
        $("#ClassroomAddress_neighborhood").val("");
        $("#ClassroomAddress_county").val("");
        $("#ClassroomAddress_fk_state_dir").val("");
        $("#ClassroomAddress_country").val("");
        $("#ClassroomAddress_zipcode").val("");
        $("#ClassroomAddress_phone").val("");
        $("#ClassroomAddress_datos_mapa").val("");
        $("#ClassroomAddress_pk_classroom_direction").val("");
        $("#ClassroomAddress_street").prop("disabled", false);
        $("#ClassroomAddress_street_number").prop("disabled", false);
        $("#ClassroomAddress_street_number_int").prop("disabled", false);
        $("#ClassroomAddress_neighborhood").prop("disabled", false);
        $("#ClassroomAddress_county").prop("disabled", false);
        $("#ClassroomAddress_fk_state_dir").prop("disabled", false);
        $("#ClassroomAddress_country").prop("disabled", false);
        $("#ClassroomAddress_zipcode").prop("disabled", false);
        $("#ClassroomAddress_phone").prop("disabled", false);
        $("#ClassroomAddress_datos_mapa").prop("disabled", false);
    }
    
    function cancelarDomicilio(){
        $.ajax({
            type: "POST",
            url: "<?= Yii::app()->createUrl('courses/courses/cancelarDireccion');?>"
        }).done(function( msg ) {
            $(location).attr("href","<?= Yii::app()->createUrl('courses/courses/asignarDireccion');?>");
        });
    }
    
    function guardarDomicilio(){
        $("#direccion_courses-form").submit();
    }
    
    function editarDomicilio(){
        $.ajax("<?= Yii::app()->createUrl('courses/courses/editarDireccion')?>");
        $("#dir_clase_th").html("EDITAR DIRECCI&Oacute;N");
        $("#cancelarDomicilio").show();
        $("#guardarDomicilio").show();
        $("#nuevoDomicilio").hide();
        $("#irAtras").hide();
        $("#guardar").hide();
        $("#ClassroomAddress_street").prop("disabled", false);
        $("#ClassroomAddress_street_number").prop("disabled", false);
        $("#ClassroomAddress_street_number_int").prop("disabled", false);
        $("#ClassroomAddress_neighborhood").prop("disabled", false);
        $("#ClassroomAddress_county").prop("disabled", false);
        $("#ClassroomAddress_fk_state_dir").prop("disabled", false);
        $("#ClassroomAddress_country").prop("disabled", false);
        $("#ClassroomAddress_zipcode").prop("disabled", false);
        $("#ClassroomAddress_phone").prop("disabled", false);
        $("#ClassroomAddress_datos_mapa").prop("disabled", false);
    }
    
    function guardarCurso(){
        $.ajax({
            type: "POST",
            url: "<?= Yii::app()->createUrl('courses/courses/guardarCursoBD');?>"
        }).done(function( msg ) {
            $(location).attr("href","<?= Yii::app()->createUrl('courses/courses/index');?>");
        });
    }
</script>
<div class="form">
    <table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'direccion_courses-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'action' => Yii::app()->createUrl('courses/courses/asignarDireccion'),
)); ?>
        <tr>
            <td id="direccion_th" colspan="4" style="text-align: center; font-weight: bold">
                ASIGNAR DIRECCI&Oacute;N
            </td>
        </tr>
        </table>
    <table class="zebra" id="tablaDmicilios">
        <thead>
            <tr>
                <th></th>
                <th width="400px" style="font-weight: bold; font-size: 12px">Direcci&oacute;n</th>
                <th width="200px" style="font-weight: bold; font-size: 12px">Municipio</th>
                <th width="200px" style="font-weight: bold; font-size: 12px">Estado</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
    <table class="zebra">
        <tr>
            <td width="130px">
                <div class="boton" id="nuevoDomicilio" onclick="nuevoDomicilio()">Nuevo</div>
            </td>
            <td width="130px">
                <div class="boton" id="editarDomicilio" onclick="editarDomicilio()">Editar</div>
            </td>
            <td width="130px">
                <div class="boton" id="cancelarDomicilio" onclick="cancelarDomicilio()">Cancelar</div>
            </td>
            <td>
                <div class="boton" id="guardarDomicilio" onclick="guardarDomicilio()">Guardar</div>
            </td>
        </tr>
    </table>
    <table class="zebra">
        <tr>
            <th id="dir_clase_th" colspan="4" style="text-align: center">DIRECCI&Oacute;N SELECCIONADO</th>
        </tr>
        <tr>
            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($model,'street'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($model,'street',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'street'); ?></td>
            </div>

            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($model,'street_number'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($model,'street_number'); ?>
		<?php echo $form->error($model,'street_number'); ?></td>
            </div>
        </tr>
        <tr>
            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($model,'street_number_int'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($model,'street_number_int',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'street_number_int'); ?></td>
            </div>

            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($model,'neighborhood'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($model,'neighborhood',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'neighborhood'); ?></td>
            </div>
        </tr>
        <tr>
            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($model,'county'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($model,'county',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'county'); ?></td>
	</div>

	<div class="row">
            <td class="dir_clase_td"><?php echo $form->labelEx($model,'fk_state_dir'); ?></td>
		<td class="dir_clase_td"><?php echo $form->dropDownList($model,'fk_state_dir', CatDetail::model()->getCatDetailsOptions(constantesCatalogos::ESTADO,  constantes::LANG), 
                        array(
                        "tabindex" => "0",
                        "empty" => constantes::OPCION_COMBO)
                    );?>
		<?php echo $form->error($model,'fk_state_dir'); ?></td>
	</div>
        </tr>
        <tr>
            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($model,'country'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($model,'country',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'country'); ?></td>
            </div>

            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($model,'zipcode'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($model,'zipcode',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'zipcode'); ?></td>
            </div>
        </tr>
        <tr>
            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($model,'phone'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($model,'phone',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'phone'); ?></td>
            </div>
            <div class="row">
                <td class="datos_mapa_td"><?php echo $form->labelEx($model,'datos_mapa'); ?></td>
		<td class="datos_mapa_td"><?php echo $form->textField($model,'datos_mapa',array('size'=>25,'maxlength'=>25,'onblur'=>'cargaMapa()')); ?>
		<?php echo $form->error($model,'datos_mapa'); ?></td>
                <?php echo $form->hiddenField($model,'pk_classroom_direction');
                    echo $form->hiddenField($model,'status');
                    echo $form->hiddenField($model,'fk_client'); ?>
            </div>
        </tr>
        <tr>
            <td colspan="4" class="datos_mapa_td"><div id="mapa" style="width:700px;height:300px;" class="mapa_div"></div></td>
        </tr>
    </table>
    <hr>
    <table class="zebra">
        <tr>
            <td width="240px"><div class="boton" id="irAtras"><< Atr&aacute;s</div></td>
            <td width="240px"></td>
            <td width="240px"></td>
            <div class="row buttons">
                <td><div class="boton" id="guardar" onclick="guardarCurso()">Guardar >></div></td>
        </div>
        </tr>
        <?php $this->endWidget(); ?>
</table>
</div><!-- form -->
        
