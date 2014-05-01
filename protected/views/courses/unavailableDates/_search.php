<?php
/* @var $this UnavailableDatesController */
/* @var $model UnavailableDates */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk_unavailable_dates'); ?>
		<?php echo $form->textField($model,'pk_unavailable_dates',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'initial_date'); ?>
		<?php echo $form->textField($model,'initial_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'final_date'); ?>
		<?php echo $form->textField($model,'final_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_course'); ?>
		<?php echo $form->textField($model,'fk_course',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_unavailability_type'); ?>
		<?php echo $form->textField($model,'fk_unavailability_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->