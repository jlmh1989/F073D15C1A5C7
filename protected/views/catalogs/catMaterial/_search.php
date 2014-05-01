<?php
/* @var $this CatMaterialController */
/* @var $model CatMaterial */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk_material'); ?>
		<?php echo $form->textField($model,'pk_material'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_material'); ?>
		<?php echo $form->textField($model,'desc_material',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_type_material'); ?>
		<?php echo $form->textField($model,'fk_type_material'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->