<?php
/* @var $this CatStatusClassController */
/* @var $model CatStatusClass */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk_status_class'); ?>
		<?php echo $form->textField($model,'pk_status_class'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_status_class'); ?>
		<?php echo $form->textField($model,'desc_status_class',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'long_desc'); ?>
		<?php echo $form->textField($model,'long_desc',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_reschedule_motive'); ?>
		<?php echo $form->textField($model,'is_reschedule_motive'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_type_class'); ?>
		<?php echo $form->textField($model,'fk_type_class'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_role_class'); ?>
		<?php echo $form->textField($model,'fk_role_class'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->