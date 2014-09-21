<?php
/* @var $this EmployeeController */
/* @var $data Employees */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_employee')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_employee), array('view', 'id'=>$data->pk_employee)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_user')); ?>:</b>
	<?php echo CHtml::encode($data->fk_user); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('entrance_date')); ?>:</b>
	<?php echo CHtml::encode($data->entrance_date); ?>
	<br />

	*/ ?>

</div>