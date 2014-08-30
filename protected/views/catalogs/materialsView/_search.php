<?php
/* @var $this MaterialsViewController */
/* @var $model MaterialsView */
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

	<div class="row">
		<?php echo $form->label($model,'desc_cat_detail_es'); ?>
		<?php echo $form->textField($model,'desc_cat_detail_es',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_stock'); ?>
		<?php echo $form->textField($model,'total_stock',array('size'=>21,'maxlength'=>21)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'actual_stock'); ?>
		<?php echo $form->textField($model,'actual_stock',array('size'=>21,'maxlength'=>21)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_level'); ?>
		<?php echo $form->textField($model,'desc_level',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->