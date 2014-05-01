<?php
/* @var $this CourseScheduleController */
/* @var $data CourseSchedule */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_course_schedule')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_course_schedule), array('view', 'id'=>$data->pk_course_schedule)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_course')); ?>:</b>
	<?php echo CHtml::encode($data->fk_course); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_bss_day')); ?>:</b>
	<?php echo CHtml::encode($data->fk_bss_day); ?>
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