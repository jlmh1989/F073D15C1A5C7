<?php
/* @var $this UnavailableScheduleController */
/* @var $data UnavailableSchedule */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_unavailable_schedule')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_unavailable_schedule), array('view', 'id'=>$data->pk_unavailable_schedule)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_bss_day')); ?>:</b>
	<?php echo CHtml::encode($data->fk_bss_day); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_teacher')); ?>:</b>
	<?php echo CHtml::encode($data->fk_teacher); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('initial_hour')); ?>:</b>
	<?php echo CHtml::encode($data->initial_hour); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('final_hour')); ?>:</b>
	<?php echo CHtml::encode($data->final_hour); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>