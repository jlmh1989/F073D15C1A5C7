<?php
/* @var $this StudentsController */
/* @var $data Students */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_student')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_student), array('view', 'id'=>$data->pk_student)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_client')); ?>:</b>
	<?php echo CHtml::encode($data->fk_client); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('neigborhod')); ?>:</b>
	<?php echo CHtml::encode($data->neigborhod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('county')); ?>:</b>
	<?php echo CHtml::encode($data->county); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('zipcode')); ?>:</b>
	<?php echo CHtml::encode($data->zipcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birthdate')); ?>:</b>
	<?php echo CHtml::encode($data->birthdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('street')); ?>:</b>
	<?php echo CHtml::encode($data->street); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('street_number')); ?>:</b>
	<?php echo CHtml::encode($data->street_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('street_number_int')); ?>:</b>
	<?php echo CHtml::encode($data->street_number_int); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_state_dir')); ?>:</b>
	<?php echo CHtml::encode($data->fk_state_dir); ?>
	<br />

	*/ ?>

</div>