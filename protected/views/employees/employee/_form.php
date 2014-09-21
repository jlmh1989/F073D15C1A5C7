<?php
/* @var $this EmployeeController */
/* @var $model Employees */
/* @var $form CActiveForm */
$readOnly = 'readonly';
$readOnlyCliente = false;
$scriptInit = '';
if($model->pk_employee == null){
    $readOnly = '';
}
$scriptInit .= '$("#user_th").click(function() {
            if($(".user").is(":visible")){
                $(".user").hide();
            }else{
                $(".user").show();
            }
        });
        
        $("#estudiante_th").click(function() {
            if($(".estudiante_td").is(":visible")){
                $(".estudiante_td").hide();
            }else{
                $(".estudiante_td").show();
            }
        });';
Yii::app()->clientScript->registerScript('script',
        $scriptInit,
        CClientScript::POS_READY);
?>

<div class="form">
    <table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employees-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

            <?php
        if($model->pk_employee == null || 
                Yii::app()->user->getState("rol") === constantes::ROL_ADMINISTRADOR ||
                Yii::app()->user->getState("rol") === constantes::ROL_ADMIN_SISTEMA){
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
             <th id="estudiante_th" colspan="4" style="text-align: center">DATOS DEL EMPLEADO</th>
        </tr>
        <tr>


	<div class="row">
            <td class="estudiante_td"><?php echo $form->labelEx($model,'name'); ?></td>
		<td class="estudiante_td"><?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?></td>
	</div>
	<div class="row">
            <td class="estudiante_td"><?php echo $form->labelEx($model,'entrance_date'); ?></td>		
		<td class="estudiante_td"><?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array('attribute'=>'entrance_date',
                                  'name'=>'entrance_date',
                                  'model'=>$model,
                                  'options' => array(
                                        'mode'=>'focus',
                                        'dateFormat'=>  constantes::FORMATO_FECHA,
                                        'showAnim' => 'slideDown',
                                        'changeMonth'=>true,
                                        'changeYear'=>true,
                                        'maxDate'=>"+0D",
                                  ),
                                  'htmlOptions'=>array('size'=>20,'class'=>'date', //'value'=>date("d F, Y")
                                  ),
                            )); 
                ?>                    
		<?php echo $form->error($model,'entrance_date'); ?></td>
	</div>        
        </tr>

        <tr>
	<div class="row">
            <td class="estudiante_td"><?php echo $form->labelEx($model,'email'); ?></td>
		<td class="estudiante_td"><?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?></td>
	</div>


	<div class="row">
            <td class="estudiante_td"><?php echo $form->labelEx($model,'phone'); ?></td>
		<td class="estudiante_td"><?php echo $form->textField($model,'phone',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'phone'); ?></td>
	</div>        
        </tr>
        
        <tr>
	<div class="row">
            <td class="estudiante_td"><?php echo $form->labelEx($model,'street'); ?></td>
		<td class="estudiante_td"><?php echo $form->textField($model,'street',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'street'); ?></td>
	</div>            
	<div class="row">
            <td class="estudiante_td"><?php echo $form->labelEx($model,'neigborhod'); ?></td>
		<td class="estudiante_td"><?php echo $form->textField($model,'neigborhod',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'neigborhod'); ?></td>
	</div>            



        </tr>
        
        <tr>
	<div class="row">
            <td class="estudiante_td"><?php echo $form->labelEx($model,'county'); ?></td>
		<td class="estudiante_td"><?php echo $form->textField($model,'county',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'county'); ?></td>
	</div>  
	<div class="row">
            <td class="estudiante_td"><?php echo $form->labelEx($model,'fk_state_dir'); ?></td>
		<td class="estudiante_td"><?php echo $form->dropDownList($model,'fk_state_dir',  CatDetail::model()->getCatDetailsOptions(constantesCatalogos::ESTADO,  constantes::LANG), constantes::getOpcionCombo()); ?>
		<?php echo $form->error($model,'fk_state_dir'); ?></td>
	</div>        
	
        </tr>
        <tr>
	<div class="row">
            <td class="estudiante_td"><?php echo $form->labelEx($model,'street_number'); ?></td>
		<td class="estudiante_td"><?php echo $form->textField($model,'street_number'); ?>
		<?php echo $form->error($model,'street_number'); ?></td>
	</div>            
	<div class="row">
            <td class="estudiante_td"><?php echo $form->labelEx($model,'street_number_int'); ?></td>
		<td class="estudiante_td"><?php echo $form->textField($model,'street_number_int',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'street_number_int'); ?></td>
	</div>


        </tr>        
        <tr>
        <div class="row">
            <td class="estudiante_td"><?php echo $form->labelEx($model,'zipcode'); ?></td>
		<td class="estudiante_td"><?php echo $form->textField($model,'zipcode',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'zipcode'); ?></td>
	</div>

	<div class="row">
            <td class="estudiante_td"><?php echo $form->labelEx($model,'birthdate'); ?></td>
		<td class="estudiante_td"><?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array('attribute'=>'birthdate',
                                  'name'=>'birthdate',
                                  'model'=>$model,
                                  'options' => array(
                                        'mode'=>'focus',
                                        'dateFormat'=>  constantes::FORMATO_FECHA,
                                        'showAnim' => 'slideDown',
                                        'changeMonth'=>true,
                                        'changeYear'=>true,
                                        'maxDate'=>"+0D",
                                  ),
                                  'htmlOptions'=>array('size'=>20,'class'=>'date', //'value'=>date("d F, Y")
                                  ),
                            )); 
                ?>
		<?php echo $form->error($model,'birthdate'); ?></td>
	</div>


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