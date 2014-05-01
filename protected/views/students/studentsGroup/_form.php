<?php
/* @var $this StudentsGroupController */
/* @var $model StudentsGroup */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'students-group-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_group'); ?>
		<?php echo $form->textField($model,'fk_group',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fk_group'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_student'); ?>
		<?php echo $form->textField($model,'fk_student',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fk_student'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_client'); ?>
		<?php echo $form->textField($model,'fk_client',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fk_client'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->