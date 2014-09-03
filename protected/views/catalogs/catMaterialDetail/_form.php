<?php
/* @var $this CatMaterialDetailController */
/* @var $model CatMaterialDetail */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cat-material-detail-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pk_material_detail'); ?>
		<?php echo $form->textField($model,'pk_material_detail',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'pk_material_detail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'material_code'); ?>
		<?php echo $form->textField($model,'material_code',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'material_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'availability'); ?>
		<?php echo $form->textField($model,'availability'); ?>
		<?php echo $form->error($model,'availability'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_cat_material'); ?>
		<?php echo $form->textField($model,'fk_cat_material'); ?>
		<?php echo $form->error($model,'fk_cat_material'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->