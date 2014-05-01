<?php
/* @var $this ClientsController */
/* @var $data Clients */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_client')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_client), array('view', 'id'=>$data->pk_client)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_type_client')); ?>:</b>
	<?php echo CHtml::encode($data->fk_type_client); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_name')); ?>:</b>
	<?php echo CHtml::encode($data->client_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_name')); ?>:</b>
	<?php echo CHtml::encode($data->contact_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_mail')); ?>:</b>
	<?php echo CHtml::encode($data->contact_mail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_phone')); ?>:</b>
	<?php echo CHtml::encode($data->contact_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_phone_ext')); ?>:</b>
	<?php echo CHtml::encode($data->contact_phone_ext); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('client_web')); ?>:</b>
	<?php echo CHtml::encode($data->client_web); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('billing_data')); ?>:</b>
	<?php echo CHtml::encode($data->billing_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_cellphone')); ?>:</b>
	<?php echo CHtml::encode($data->contact_cellphone); ?>
	<br />

	*/ ?>

</div>