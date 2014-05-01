<?php
/* @var $this MaterialLevelController */
/* @var $model MaterialLevel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'fk_level'); ?>
		<?php echo $form->textField($model,'fk_level'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_material'); ?>
		<?php echo $form->textField($model,'fk_material'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pk_material_level'); ?>
		<?php echo $form->textField($model,'pk_material_level',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->