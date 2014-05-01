<?php
/* @var $this UnavailableDatesController */
/* @var $model UnavailableDates */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'unavailable-dates-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'initial_date'); ?>
		<?php echo $form->textField($model,'initial_date'); ?>
		<?php echo $form->error($model,'initial_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'final_date'); ?>
		<?php echo $form->textField($model,'final_date'); ?>
		<?php echo $form->error($model,'final_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_course'); ?>
		<?php echo $form->textField($model,'fk_course',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fk_course'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_unavailability_type'); ?>
		<?php echo $form->textField($model,'fk_unavailability_type'); ?>
		<?php echo $form->error($model,'fk_unavailability_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->