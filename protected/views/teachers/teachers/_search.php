<?php
/* @var $this TeachersController */
/* @var $model Teachers */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk_teacher'); ?>
		<?php echo $form->textField($model,'pk_teacher'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_rate'); ?>
		<?php echo $form->textField($model,'fk_rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'street'); ?>
		<?php echo $form->textField($model,'street',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'street_numer'); ?>
		<?php echo $form->textField($model,'street_numer'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'street_number_int'); ?>
		<?php echo $form->textField($model,'street_number_int',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'neighborhood'); ?>
		<?php echo $form->textField($model,'neighborhood',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_nationality'); ?>
		<?php echo $form->textField($model,'fk_nationality'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_state_dir'); ?>
		<?php echo $form->textField($model,'fk_state_dir'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'county'); ?>
		<?php echo $form->textField($model,'county',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zipcode'); ?>
		<?php echo $form->textField($model,'zipcode',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'birthdate'); ?>
		<?php echo $form->textField($model,'birthdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_state_birth'); ?>
		<?php echo $form->textField($model,'fk_state_birth'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_education'); ?>
		<?php echo $form->textField($model,'fk_education'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nationality_other'); ?>
		<?php echo $form->textField($model,'nationality_other',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fk_status_document'); ?>
		<?php echo $form->textField($model,'fk_status_document'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cellphone'); ?>
		<?php echo $form->textField($model,'cellphone',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'entrance_score'); ?>
		<?php echo $form->textField($model,'entrance_score'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'spesification'); ?>
		<?php echo $form->textField($model,'spesification',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comments'); ?>
		<?php echo $form->textField($model,'comments',array('size'=>60,'maxlength'=>300)); ?>
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