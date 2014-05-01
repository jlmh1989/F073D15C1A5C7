<?php
/* @var $this AssistanceRecordController */
/* @var $model AssistanceRecord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'assistance-record-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'class_date'); ?>
		<?php echo $form->textField($model,'class_date'); ?>
		<?php echo $form->error($model,'class_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_course'); ?>
		<?php echo $form->textField($model,'fk_course',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fk_course'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_client'); ?>
		<?php echo $form->textField($model,'fk_client',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fk_client'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_student'); ?>
		<?php echo $form->textField($model,'fk_student',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fk_student'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_status_class'); ?>
		<?php echo $form->textField($model,'fk_status_class'); ?>
		<?php echo $form->error($model,'fk_status_class'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reschedule_date'); ?>
		<?php echo $form->textField($model,'reschedule_date'); ?>
		<?php echo $form->error($model,'reschedule_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reschedule_time'); ?>
		<?php echo $form->textField($model,'reschedule_time'); ?>
		<?php echo $form->error($model,'reschedule_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cancellation_reason'); ?>
		<?php echo $form->textField($model,'cancellation_reason',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cancellation_reason'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->