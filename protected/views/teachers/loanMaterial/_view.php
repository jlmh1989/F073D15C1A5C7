<?php
/* @var $this LoanMaterialController */
/* @var $data LoanMaterial */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_loan_material')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_loan_material), array('view', 'id'=>$data->pk_loan_material)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_course')); ?>:</b>
	<?php echo CHtml::encode($data->fk_course); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_teacher')); ?>:</b>
	<?php echo CHtml::encode($data->fk_teacher); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_material_detail')); ?>:</b>
	<?php echo CHtml::encode($data->fk_material_detail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pick_date')); ?>:</b>
	<?php echo CHtml::encode($data->pick_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drop_date')); ?>:</b>
	<?php echo CHtml::encode($data->drop_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />


</div>