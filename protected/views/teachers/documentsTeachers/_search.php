<?php
/* @var $this DocumentsTeachersController */
/* @var $model DocumentsTeachers */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'fk_document'); ?>
		<?php echo $form->textField($model,'fk_document'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_teacher'); ?>
		<?php echo $form->textField($model,'fk_teacher'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pk_docs_teacher'); ?>
		<?php echo $form->textField($model,'pk_docs_teacher',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->