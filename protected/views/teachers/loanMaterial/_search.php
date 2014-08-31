<?php
/* @var $this LoanMaterialController */
/* @var $model LoanMaterial */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk_loan_material'); ?>
		<?php echo $form->textField($model,'pk_loan_material',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_course'); ?>
		<?php echo $form->textField($model,'fk_course',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_teacher'); ?>
		<?php echo $form->textField($model,'fk_teacher'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_material_detail'); ?>
		<?php echo $form->textField($model,'fk_material_detail',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pick_date'); ?>
		<?php echo $form->textField($model,'pick_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drop_date'); ?>
		<?php echo $form->textField($model,'drop_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->