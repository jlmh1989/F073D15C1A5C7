<?php
/* @var $this AssistanceRecordController */
/* @var $model AssistanceRecord */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk_assistance'); ?>
		<?php echo $form->textField($model,'pk_assistance',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'class_date'); ?>
		<?php echo $form->textField($model,'class_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_course'); ?>
		<?php echo $form->textField($model,'fk_course',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_client'); ?>
		<?php echo $form->textField($model,'fk_client',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_student'); ?>
		<?php echo $form->textField($model,'fk_student',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_status_class'); ?>
		<?php echo $form->textField($model,'fk_status_class'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reschedule_date'); ?>
		<?php echo $form->textField($model,'reschedule_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reschedule_time'); ?>
		<?php echo $form->textField($model,'reschedule_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cancellation_reason'); ?>
		<?php echo $form->textField($model,'cancellation_reason',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->