<?php
/* @var $this CoursesController */
/* @var $data Courses */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_course')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_course), array('view', 'id'=>$data->pk_course)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_level')); ?>:</b>
	<?php echo CHtml::encode($data->fk_level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_client')); ?>:</b>
	<?php echo CHtml::encode($data->fk_client); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_teacher')); ?>:</b>
	<?php echo CHtml::encode($data->fk_teacher); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_type_course')); ?>:</b>
	<?php echo CHtml::encode($data->fk_type_course); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_group')); ?>:</b>
	<?php echo CHtml::encode($data->fk_group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('initial_date')); ?>:</b>
	<?php echo CHtml::encode($data->initial_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_curse')); ?>:</b>
	<?php echo CHtml::encode($data->desc_curse); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_level')); ?>:</b>
	<?php echo CHtml::encode($data->other_level); ?>
	<br />

	*/ ?>

</div>