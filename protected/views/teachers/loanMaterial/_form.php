<?php
/* @var $this LoanMaterialController */
/* @var $model LoanMaterial */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'loan-material-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_course'); ?>
		<?php echo $form->textField($model,'fk_course',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fk_course'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_teacher'); ?>
		<?php echo $form->textField($model,'fk_teacher'); ?>
		<?php echo $form->error($model,'fk_teacher'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_material_detail'); ?>
		<?php echo $form->textField($model,'fk_material_detail',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fk_material_detail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pick_date'); ?>
		<?php echo $form->textField($model,'pick_date'); ?>
		<?php echo $form->error($model,'pick_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drop_date'); ?>
		<?php echo $form->textField($model,'drop_date'); ?>
		<?php echo $form->error($model,'drop_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->