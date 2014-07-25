<?php
/* @var $this CatLevelsController */
/* @var $model CatLevels */
/* @var $form CActiveForm */
?>

<div class="form">
    <table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cat-levels-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
        <tr>
            <th class="zebra_th" colspan="4" style="text-align: center"><?= $model->isNewRecord ? 'Crear Nuevo Nivel' : 'Actualizar Nivel - '.$model->desc_level ?></th>
        </tr>
        <tr>    
            <td><?php echo $form->labelEx($model,'desc_level'); ?></td>
            <td width="250"><?php echo $form->textField($model,'desc_level',array('size'=>50,'maxlength'=>50)); ?>
            <?php echo $form->error($model,'desc_level'); ?></td>

            <td><?php echo $form->labelEx($model,'fk_associated_book'); ?></td>
            <td><?php echo $form->textField($model,'fk_associated_book'); ?>
            <?php echo $form->error($model,'fk_associated_book'); ?></td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'total_hours'); ?></td>
            <td><?php echo $form->textField($model,'total_hours'); ?>
            <?php echo $form->error($model,'total_hours'); ?></td>

            <td style="visibility: <?= $model->isNewRecord ? 'hidden' : 'visible' ?>"><?php echo $form->labelEx($model,'status'); ?></td>
            <td style="visibility: <?= $model->isNewRecord ? 'hidden' : 'visible' ?>"><?php echo $form->dropDownList($model,'status', constantes::getOpcionStatus(), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($model,'status'); ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: center"><?php echo CHtml::submitButton($model->isNewRecord ? 'Siguiente' : 'Guardar'); ?></td>
        </tr>
<?php $this->endWidget(); ?>
</table>
</div><!-- form -->