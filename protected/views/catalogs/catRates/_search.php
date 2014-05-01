<?php
/* @var $this CatRatesController */
/* @var $model CatRates */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk_rate'); ?>
		<?php echo $form->textField($model,'pk_rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_tarifa'); ?>
		<?php echo $form->textField($model,'desc_tarifa',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rate'); ?>
		<?php echo $form->textField($model,'rate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->