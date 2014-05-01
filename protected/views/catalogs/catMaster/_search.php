<?php
/* @var $this CatMasterController */
/* @var $model CatMaster */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk_cat_master'); ?>
		<?php echo $form->textField($model,'pk_cat_master'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_cat_master'); ?>
		<?php echo $form->textField($model,'desc_cat_master',array('size'=>20,'maxlength'=>20)); ?>
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