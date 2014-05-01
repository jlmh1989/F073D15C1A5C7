<?php
/* @var $this UnavailableScheduleController */
/* @var $model UnavailableSchedule */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk_unavailable_schedule'); ?>
		<?php echo $form->textField($model,'pk_unavailable_schedule',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_bss_day'); ?>
		<?php echo $form->textField($model,'fk_bss_day'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_teacher'); ?>
		<?php echo $form->textField($model,'fk_teacher'); ?>
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
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->