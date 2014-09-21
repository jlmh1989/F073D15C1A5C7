<?php
/* @var $this MaterialsViewController */
/* @var $model MaterialsView */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'materials-view-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pk_material'); ?>
		<?php echo $form->textField($model,'pk_material'); ?>
		<?php echo $form->error($model,'pk_material'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc_material'); ?>
		<?php echo $form->textField($model,'desc_material',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'desc_material'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fk_type_material'); ?>
		<?php echo $form->textField($model,'fk_type_material'); ?>
		<?php echo $form->error($model,'fk_type_material'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc_cat_detail_es'); ?>
		<?php echo $form->textField($model,'desc_cat_detail_es',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'desc_cat_detail_es'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_stock'); ?>
		<?php echo $form->textField($model,'total_stock',array('size'=>21,'maxlength'=>21)); ?>
		<?php echo $form->error($model,'total_stock'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'actual_stock'); ?>
		<?php echo $form->textField($model,'actual_stock',array('size'=>21,'maxlength'=>21)); ?>
		<?php echo $form->error($model,'actual_stock'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc_level'); ?>
		<?php echo $form->textField($model,'desc_level',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'desc_level'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->