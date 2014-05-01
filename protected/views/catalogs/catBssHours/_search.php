<?php
/* @var $this CatBssHoursController */
/* @var $model CatBssHours */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk_bss_hour'); ?>
		<?php echo $form->textField($model,'pk_bss_hour'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'initial_hour'); ?>
		<?php echo $form->textField($model,'initial_hour'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'final_hour'); ?>
		<?php echo $form->textField($model,'final_hour'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'range_time'); ?>
		<?php echo $form->textField($model,'range_time'); ?>
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