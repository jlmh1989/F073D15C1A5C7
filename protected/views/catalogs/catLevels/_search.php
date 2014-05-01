<?php
/* @var $this CatLevelsController */
/* @var $model CatLevels */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk_level'); ?>
		<?php echo $form->textField($model,'pk_level'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_level'); ?>
		<?php echo $form->textField($model,'desc_level',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_associated_book'); ?>
		<?php echo $form->textField($model,'fk_associated_book'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_hours'); ?>
		<?php echo $form->textField($model,'total_hours'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->