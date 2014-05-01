<?php
/* @var $this UnavailableScheduleController */
/* @var $model UnavailableSchedule */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'unavailable-schedule-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_bss_day'); ?>
		<?php echo $form->textField($model,'fk_bss_day'); ?>
		<?php echo $form->error($model,'fk_bss_day'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_teacher'); ?>
		<?php echo $form->textField($model,'fk_teacher'); ?>
		<?php echo $form->error($model,'fk_teacher'); ?>
	</div>

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
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->