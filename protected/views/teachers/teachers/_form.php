<?php
/* @var $this TeachersController */
/* @var $model Teachers */
/* @var $form CActiveForm */
$readOnly = 'readonly';
if($model->pk_teacher == null){
    unset($_SESSION['inactivoUS']);
    $readOnly = '';
}
?>

<?php
    Yii::app()->clientScript->registerScript('script',
        'if(parseInt($("#Teachers_fk_nationality").val()) !== '.constantes::OTRA_NACIONALIDAD.'){
            $("#Teachers_nationality_other").prop("disabled",true);
        }
        
        $("#user_th").click(function() {
            if($(".user").is(":visible")){
                $(".user").hide();
            }else{
                $(".user").show();
            }
        });
        
        $("#maestro_th").click(function() {
            if($(".maestro_td").is(":visible")){
                $(".maestro_td").hide();
            }else{
                $(".maestro_td").show();
            }
        });
        
        $("#domicilio_th").click(function() {
            if($(".domicilio_td").is(":visible")){
                $(".domicilio_td").hide();
            }else{
                $(".domicilio_td").show();
            }
        });
        
        $("#papeleria_th").click(function() {
            if($(".papeleria_td").is(":visible")){
                $(".papeleria_td").hide();
            }else{
                $(".papeleria_td").show();
            }
        });
        
        $("#horario_th").click(function() {
            if($(".horario_td").is(":visible")){
                $(".horario_td").hide();
            }else{
                $(".horario_td").show();
            }
        });
        
        ',
        CClientScript::POS_READY);
?>

<script>
    function otraNacionalidad(value){
        if(parseInt(value) !== <?php echo constantes::OTRA_NACIONALIDAD; ?>){
            $("#Teachers_nationality_other").prop("disabled",true);
            $("#Teachers_nationality_other").val("");
        }else{
            $("#Teachers_nationality_other").prop("disabled",false);
        }
    }
    
    function horaNoDisponible(pkDay, idHour, hrInicio, hrFin){
        var CssClass = $("#"+pkDay+"_"+idHour).attr('class');
        if(CssClass == "button_activo"){
            $.ajax({
                    type: "POST",
                    url: "<?= Yii::app()->createUrl('teachers/teachers/addInactivoUS');?>",
                    data: { pkDay: pkDay, idHour: idHour, inicio: hrInicio, fin: hrFin },
                    dataType: "html"
                    })
                    .done(function( msg ) {
                        $("#"+pkDay+"_"+idHour).attr('class','button_inactivo');
                        $("#"+pkDay+"_"+idHour).attr('value','INACTIVO');
                    });
        }else{
            $.ajax({
                    type: "POST",
                    url: "<?= Yii::app()->createUrl('teachers/teachers/delInactivoUS');?>",
                    data: { pkDay: pkDay, idHour: idHour, inicio: hrInicio, fin: hrFin },
                    dataType: "html"
                    })
                    .done(function( msg ) {
                        $("#"+pkDay+"_"+idHour).attr('class','button_activo');
                        $("#"+pkDay+"_"+idHour).attr('value','ACTIVO');
                    });
            
        }
    }
</script>

<div class="form">
    <table class="zebra">
         
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'teachers-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>
    <!-- 
    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php //echo $form->errorSummary($model); ?>
    
    -->
        <?php
        if($model->pk_teacher == null || Yii::app()->user->getState("rol") === constantes::ROL_ADMINISTRADOR){
        ?>
        <tr>
            <th id="user_th" colspan="4" class="zebra_th" style="text-align: center">DATOS DE USUARIO</th>
        </tr>
        <tr>
            <div class="row">
                <td class="user"><?php echo $form->labelEx($modelUser,'username'); ?></td>
		<td class="user"><?php echo $form->textField($modelUser,'username',array('size'=>60,'maxlength'=>100, 'readonly'=>$readOnly)); ?>
		<?php echo $form->error($modelUser,'username'); ?></td>
	</div>

	<div class="row">
            <td class="user"><?php echo $form->labelEx($modelUser,'password'); ?></td>
		<td class="user"><?php echo $form->passwordField($modelUser,'password',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelUser,'password'); ?></td>
	</div>
        </tr>
        <?php 
        }
        ?>
         <tr>
             <th id="maestro_th" colspan="4" style="text-align: center">DATOS DEL MAESTRO</th>
        </tr>
    <tr>
    <div class="row">
        
        <td class="maestro_td"><?php echo $form->labelEx($model, 'name'); ?></td>
        <td class="maestro_td" width="270px"><?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'name'); ?></td>
        
        <td class="maestro_td"><?php echo $form->labelEx($model, 'birthdate'); ?></td>
        <td class="maestro_td"><?php $this->widget('CMaskedTextField', array(
                                'attribute'=>'birthdate',
                                'name'=>'birthdate',
                                'model'=>$model,
                                'placeholder'=>' ',
                                'mask' => '9999-99-99',
                                'htmlOptions' => array('size' => 10, 'placeholder' => 'AAAA-MM-DD')
                                )
                            ); ?>
        <?php echo $form->error($model, 'birthdate'); ?></td>
        
    </div>
    </tr>
    
    <tr>
        <td class="maestro_td"><?php echo $form->labelEx($model, 'fk_nationality'); ?></td>
        <td class="maestro_td"><?php echo $form->dropDownList($model,'fk_nationality',  CatDetail::model()->getCatDetailsOptions(constantesCatalogos::NACIONALIDAD,  constantes::LANG),
                array(
                        "tabindex" => "0",
                        "empty" => constantes::OPCION_COMBO,
                        'onChange' => 'otraNacionalidad(this.value)')
                    ); ?>
        <?php echo $form->error($model, 'fk_nationality'); ?></td>
        
        <td class="maestro_td"><?php echo $form->labelEx($model, 'nationality_other'); ?></td>
        <td class="maestro_td"><?php echo $form->textField($model, 'nationality_other', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'nationality_other'); ?></td>
       
    </tr>
    
    <tr>
        <td class="maestro_td"><?php echo $form->labelEx($model, 'email'); ?></td>
        <td class="maestro_td"><?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'email'); ?></td>
        
         <td class="maestro_td"><?php echo $form->labelEx($model, 'fk_state_birth'); ?></td>
        <td class="maestro_td"><?php echo $form->dropDownList($model,'fk_state_birth',  CatDetail::model()->getCatDetailsOptions(constantesCatalogos::ESTADO,  constantes::LANG), constantes::getOpcionCombo()); ?>
        <?php echo $form->error($model, 'fk_state_birth'); ?></td>
    </tr>
    
    <tr>
    <div class="row">
        <td class="maestro_td"><?php echo $form->labelEx($model, 'fk_education'); ?></td>
        <td class="maestro_td"><?php echo $form->dropDownList($model,'fk_education',  CatDetail::model()->getCatDetailsOptions(constantesCatalogos::ESCOLARIDAD,constantes::LANG), constantes::getOpcionCombo()); ?>
        <?php echo $form->error($model, 'fk_education'); ?></td>
    </div>
    <div class="row">
        <td class="maestro_td"><?php echo $form->labelEx($model, 'fk_status_document'); ?> </td>
        <td class="maestro_td"><?php echo $form->dropDownList($model,'fk_status_document',  CatDetail::model()->getCatDetailsOptions(constantesCatalogos::ESTATUS_PAPELERIA,constantes::LANG), constantes::getOpcionCombo()); ?>
        <?php echo $form->error($model, 'fk_status_document'); ?></td>
    </div>
    </tr>
    
    <tr>
    <div class="row">
        <td class="maestro_td"><?php echo $form->labelEx($model, 'phone'); ?></td>
        <td class="maestro_td"><?php echo $form->textField($model, 'phone', array('size' => 15, 'maxlength' => 15)); ?>
        <?php echo $form->error($model, 'phone'); ?></td>
        
        <td class="maestro_td"><?php echo $form->labelEx($model, 'cellphone'); ?></td>
        <td class="maestro_td"><?php echo $form->textField($model, 'cellphone', array('size' => 15, 'maxlength' => 15)); ?>
        <?php echo $form->error($model, 'cellphone'); ?></td>
    </div>
    </tr>
    
    <tr>
    <div class="row">
        
        <td class="maestro_td"><?php echo $form->labelEx($model, 'entrance_score'); ?></td>
        <td class="maestro_td"><?php echo $form->textField($model, 'entrance_score'); ?>
        <?php echo $form->error($model, 'entrance_score'); ?></td>
        
        <td class="maestro_td"><?php echo $form->labelEx($model, 'rate'); ?></td>
        <td class="maestro_td"><?php echo $form->textField($model, 'rate'); ?>
        <?php echo $form->error($model, 'rate'); ?></td>
    </div>
    </tr>
    
    <tr>
    <div class="row">
        <td class="maestro_td"><?php echo $form->labelEx($model, 'spesification'); ?></td>
        <td class="maestro_td"><?php echo $form->textArea($model, 'spesification', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'spesification'); ?></td>
        
        <td class="maestro_td"><?php echo $form->labelEx($model, 'comments'); ?></td>
        <td class="maestro_td"><?php echo $form->textArea($model, 'comments', array('size' => 60, 'maxlength' => 300)); ?>
        <?php echo $form->error($model, 'comments'); ?>  </td>
    </div>
    </tr>
    
    <tr>
        <th id="domicilio_th" colspan="4" style="text-align: center">DATOS DEL DOMICILIO</th>
    </tr>
    
    <tr>
    <div class="row">
        
        <td class="domicilio_td"><?php echo $form->labelEx($model, 'street'); ?></td>
        <td class="domicilio_td"><?php echo $form->textField($model, 'street', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'street'); ?></td>
        
        
        <td class="domicilio_td"><?php echo $form->labelEx($model, 'street_numer'); ?></td>
            <td class="domicilio_td"><?php echo $form->textField($model, 'street_numer'); ?>
            <?php echo $form->error($model, 'street_numer'); ?></td>
        
    </div>
    </tr>
    
    <tr>
    <div class="row">
        
        <td class="domicilio_td"><?php echo $form->labelEx($model, 'street_number_int'); ?></td>
        <td class="domicilio_td"><?php echo $form->textField($model, 'street_number_int', array('size' => 5, 'maxlength' => 5)); ?>
        <?php echo $form->error($model, 'street_number_int'); ?></td>
        
        
        
        <td class="domicilio_td"><?php echo $form->labelEx($model, 'neighborhood'); ?></td>
        <td class="domicilio_td"><?php echo $form->textField($model, 'neighborhood', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'neighborhood'); ?></td>
        
    </div>
    </tr>
    
    <tr>
    <div class="row">
        
        <td class="domicilio_td"><?php echo $form->labelEx($model, 'fk_state_dir'); ?></td>
        <td class="domicilio_td"><?php echo $form->dropDownList($model,'fk_state_dir',  CatDetail::model()->getCatDetailsOptions(constantesCatalogos::ESTADO,  constantes::LANG), constantes::getOpcionCombo()); ?>
        <?php echo $form->error($model, 'fk_state_dir'); ?></td>
        
          <td class="domicilio_td"><?php echo $form->labelEx($model, 'county'); ?></td>
        <td class="domicilio_td"><?php echo $form->textField($model, 'county', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'county'); ?></td>
    </div>
    </tr>
    
    <tr>
    <div class="row">
        
        <td class="domicilio_td"><?php echo $form->labelEx($model, 'zipcode'); ?></td>
        <td class="domicilio_td"><?php echo $form->textField($model, 'zipcode', array('size' => 5, 'maxlength' => 5)); ?>
        <?php echo $form->error($model, 'zipcode'); ?></td>
        
    </div>
    </tr>
    
    <tr>
        <th id="papeleria_th" colspan="4" style="text-align: center">PAPELER&Iacute;A QUE ENTREG&Oacute;</th>
    </tr>
    <div class="row">
        <?php echo CHtml::activeCheckBoxList($modelCD, 'desc_document', CatDocuments::model()->getCatDocumentsActivo(), 
        array("separator" => "",'template'=>'<tr><td class="papeleria_td" align="right">{input}</td><td class="papeleria_td">{label}</td></tr>')); ?>
        
    </div>
    <tr>
        
    <tr>
        <th id="horario_th" colspan="4" style="text-align: center">HORARIO NO DISPONIBLE</th>
    </tr>
    
    <div class="row">
        <td class="horario_td"><?php //echo $form->labelEx($model, 'status'); ?></td>
        <td class="horario_td"><?php echo $form->hiddenfield($model, 'status'); ?>
        <?php echo $form->error($model, 'status'); ?></td>
        <td class="horario_td"></td>
        <td class="horario_td"></td>
    </div>
    </tr>
    <tr>
        <!-- Horario -->
        <table class="horario_td">
            <tr>
            <td></td>
            <?php
             foreach (CatBssDay::model()->getCatBssDay(constantes::ACTIVO) as $bssDay) {
                 echo '<td style="text-align: center"><b>'.$bssDay->desc_day.'</b></td>';
                }
            ?>
            </tr>
            <?php
            $i = 0;
             foreach (CatBssHours::model()->getCatBssHours(constantes::ACTIVO) as $bssHour) {
                 echo '<tr>';
                 echo '<td>'.date_format(date_create($bssHour->initial_hour),'H:i').' - '.date_format(date_create($bssHour->final_hour),'H:i').'</td>';
                 
                foreach (CatBssDay::model()->getCatBssDay(constantes::ACTIVO) as $bssDay) {
                    echo '<td style="text-align: center">'.CHtml::button('ACTIVO',array('onclick'=>'horaNoDisponible('.$bssDay->pk_bss_day.', '.$i.', "'.$bssHour->initial_hour.'" , "'.$bssHour->final_hour.'")','class'=>'button_activo','id'=>$bssDay->pk_bss_day.'_'.$i)).'</td>';
                }
                $i++;
                 echo '</tr>';
             }
            ?>
        </table>
    </tr>
    <tr>
    <div class="row buttons">
        <td><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></td>
        <td></td>
        <td></td>
        <td></td>
    </div>
    </tr>

<?php $this->endWidget(); ?>
</table>
</div><!-- form -->
<?php
if($model->pk_teacher != null && $_SESSION['inactivoUSTam'] > 0){
    echo '<script>';
    foreach($_SESSION['inactivoUS'] as $keyDay => $arrayDay){
        foreach($arrayDay as $keyHour => $arrayHour){
            echo '$("#'.$keyDay.'_'.$keyHour.'").attr("class","button_inactivo");';
            echo '$("#'.$keyDay.'_'.$keyHour.'").attr("value","INACTIVO");';
        }
    }
    echo '</script>';
}
?>