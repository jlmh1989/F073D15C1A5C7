<?php
/* @var $this StudentsGroupController */
/* @var $data StudentsGroup */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_student_group')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_student_group), array('view', 'id'=>$data->pk_student_group)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_group')); ?>:</b>
	<?php echo CHtml::encode($data->fk_group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_student')); ?>:</b>
	<?php echo CHtml::encode($data->fk_student); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_client')); ?>:</b>
	<?php echo CHtml::encode($data->fk_client); ?>
	<br />


</div>