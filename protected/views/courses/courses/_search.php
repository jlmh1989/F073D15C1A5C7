<?php
/* @var $this CoursesController */
/* @var $model Courses */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk_course'); ?>
		<?php echo $form->textField($model,'pk_course',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_level'); ?>
		<?php echo $form->textField($model,'fk_level'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_client'); ?>
		<?php echo $form->textField($model,'fk_client',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_teacher'); ?>
		<?php echo $form->textField($model,'fk_teacher'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_type_course'); ?>
		<?php echo $form->textField($model,'fk_type_course'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_group'); ?>
		<?php echo $form->textField($model,'fk_group',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'initial_date'); ?>
		<?php echo $form->textField($model,'initial_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_curse'); ?>
		<?php echo $form->textField($model,'desc_curse',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'other_level'); ?>
		<?php echo $form->textField($model,'other_level',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->