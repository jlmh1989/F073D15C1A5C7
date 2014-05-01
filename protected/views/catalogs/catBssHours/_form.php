<?php
/* @var $this CatBssHoursController */
/* @var $model CatBssHours */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cat-bss-hours-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'initial_hour'); ?>
		<?php echo $form->textField($model,'initial_hour'); ?>
		<?php echo $form->error($model,'initial_hour'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'final_hour'); ?>
		<?php echo $form->textField($model,'final_hour'); ?>
		<?php echo $form->error($model,'final_hour'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'range_time'); ?>
		<?php echo $form->textField($model,'range_time'); ?>
		<?php echo $form->error($model,'range_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->