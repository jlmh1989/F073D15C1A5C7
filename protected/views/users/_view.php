<?php
/* @var $this UsersController */
/* @var $data Users */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_user')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_user), array('view', 'id'=>$data->pk_user)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_role')); ?>:</b>
	<?php echo CHtml::encode($data->fk_role); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>