<?php
/* @var $this CatDetailController */
/* @var $model CatDetail */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk_cat_detail'); ?>
		<?php echo $form->textField($model,'pk_cat_detail'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_cat_detail_es'); ?>
		<?php echo $form->textField($model,'desc_cat_detail_es',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_cat_detail_en'); ?>
		<?php echo $form->textField($model,'desc_cat_detail_en',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_cat_master'); ?>
		<?php echo $form->textField($model,'fk_cat_master'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->