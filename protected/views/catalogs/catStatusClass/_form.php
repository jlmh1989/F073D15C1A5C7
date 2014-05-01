<?php
/* @var $this CatStatusClassController */
/* @var $model CatStatusClass */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cat-status-class-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'desc_status_class'); ?>
		<?php echo $form->textField($model,'desc_status_class',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'desc_status_class'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'long_desc'); ?>
		<?php echo $form->textField($model,'long_desc',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'long_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_reschedule_motive'); ?>
		<?php echo $form->textField($model,'is_reschedule_motive'); ?>
		<?php echo $form->error($model,'is_reschedule_motive'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_type_class'); ?>
		<?php echo $form->textField($model,'fk_type_class'); ?>
		<?php echo $form->error($model,'fk_type_class'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_role_class'); ?>
		<?php echo $form->textField($model,'fk_role_class'); ?>
		<?php echo $form->error($model,'fk_role_class'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->