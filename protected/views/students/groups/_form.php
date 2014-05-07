<?php
/* @var $this GroupsController */
/* @var $model Groups */
/* @var $form CActiveForm */
?>

<div class="form">
<table width="100%" border="0">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groups-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
        <tr>
	<div class="row">
            <td><?php echo $form->labelEx($model,'desc_group'); ?></td>
		<td width="240px"><?php echo $form->textField($model,'desc_group',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'desc_group'); ?></td>
	</div>

	<div class="row">
            <td><?php echo $form->labelEx($model,'status'); ?></td>
            <td><?php echo $form->dropDownList($model,'status', constantes::getOpcionStatus(), constantes::getOpcionCombo()); ?>
		<?php echo $form->error($model,'status'); ?></td>
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