<?php
/* @var $this CatDocumentsController */
/* @var $model CatDocuments */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk_document'); ?>
		<?php echo $form->textField($model,'pk_document'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_document'); ?>
		<?php echo $form->textField($model,'desc_document',array('size'=>50,'maxlength'=>50)); ?>
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