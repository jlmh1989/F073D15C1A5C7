<?php
/* @var $this TeachersController */
/* @var $data Teachers */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_teacher')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_teacher), array('view', 'id'=>$data->pk_teacher)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_rate')); ?>:</b>
	<?php echo CHtml::encode($data->fk_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('street')); ?>:</b>
	<?php echo CHtml::encode($data->street); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('street_numer')); ?>:</b>
	<?php echo CHtml::encode($data->street_numer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('street_number_int')); ?>:</b>
	<?php echo CHtml::encode($data->street_number_int); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('neighborhood')); ?>:</b>
	<?php echo CHtml::encode($data->neighborhood); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_nationality')); ?>:</b>
	<?php echo CHtml::encode($data->fk_nationality); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_state_dir')); ?>:</b>
	<?php echo CHtml::encode($data->fk_state_dir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('county')); ?>:</b>
	<?php echo CHtml::encode($data->county); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zipcode')); ?>:</b>
	<?php echo CHtml::encode($data->zipcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birthdate')); ?>:</b>
	<?php echo CHtml::encode($data->birthdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_state_birth')); ?>:</b>
	<?php echo CHtml::encode($data->fk_state_birth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_education')); ?>:</b>
	<?php echo CHtml::encode($data->fk_education); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nationality_other')); ?>:</b>
	<?php echo CHtml::encode($data->nationality_other); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_status_document')); ?>:</b>
	<?php echo CHtml::encode($data->fk_status_document); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cellphone')); ?>:</b>
	<?php echo CHtml::encode($data->cellphone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('entrance_score')); ?>:</b>
	<?php echo CHtml::encode($data->entrance_score); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spesification')); ?>:</b>
	<?php echo CHtml::encode($data->spesification); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>