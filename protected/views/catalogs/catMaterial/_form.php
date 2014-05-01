<?php
/* @var $this CatMaterialController */
/* @var $model CatMaterial */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cat-material-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->