<?php
/* @var $this CourseScheduleController */
/* @var $model CourseSchedule */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk_course_schedule'); ?>
		<?php echo $form->textField($model,'pk_course_schedule',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_course'); ?>
		<?php echo $form->textField($model,'fk_course',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_bss_day'); ?>
		<?php echo $form->textField($model,'fk_bss_day'); ?>
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