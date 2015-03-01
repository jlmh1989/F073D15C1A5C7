<?php
/* @var $this CoursesController */
/* @var $model CursoDatos */
/* @var $form CActiveForm */
?>
<div class="form">
    <table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'courses-formDatos',
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
            <td class="datos_td" width="240px"><?php echo $form->dropDownList($model,'fk_client', Clients::model()->getClientsActivos(), array(
                        "tabindex" => "0",
                        "empty" => constantes::OPCION_COMBO,)
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
                                        //Se quita restriccion de fecha anterior al dia actual, para dar alta curso
                                        //'minDate'=>0,
                                  ),
                                  'htmlOptions'=>array('size'=>20,'class'=>'date', //'value'=>date("d F, Y")
                                  ),
                            )); 
                ?>
		<?php echo $form->error($model,'initial_date'); ?></td>
	</div>
        </tr>
        <tr>
            <td class="datos_td"><?php echo $form->labelEx($model,'desc_curse'); ?></td>
            <td class="datos_td"><?php echo $form->textField($model,'desc_curse',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'desc_curse'); ?></td>
	</div>
        </tr>
        </table>
    <hr>
    <table>
        <tr>
        <td width="240px"></td>
        <td width="240px"></td>
        <td width="240px"></td>
        <div class="row buttons">
        <td><?php echo CHtml::submitButton('Siguiente >>'); ?></td>
        </div>
        </tr>
    </table>
</div>
<?php $this->endWidget(); ?>
