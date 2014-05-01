<?php
/* @var $this AssistanceRecordController */
/* @var $data AssistanceRecord */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_assistance')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_assistance), array('view', 'id'=>$data->pk_assistance)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_date')); ?>:</b>
	<?php echo CHtml::encode($data->class_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_course')); ?>:</b>
	<?php echo CHtml::encode($data->fk_course); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_client')); ?>:</b>
	<?php echo CHtml::encode($data->fk_client); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_student')); ?>:</b>
	<?php echo CHtml::encode($data->fk_student); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_status_class')); ?>:</b>
	<?php echo CHtml::encode($data->fk_status_class); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reschedule_date')); ?>:</b>
	<?php echo CHtml::encode($data->reschedule_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('reschedule_time')); ?>:</b>
	<?php echo CHtml::encode($data->reschedule_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancellation_reason')); ?>:</b>
	<?php echo CHtml::encode($data->cancellation_reason); ?>
	<br />

	*/ ?>

</div>