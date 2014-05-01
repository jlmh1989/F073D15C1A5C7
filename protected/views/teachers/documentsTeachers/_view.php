<?php
/* @var $this DocumentsTeachersController */
/* @var $data DocumentsTeachers */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_docs_teacher')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_docs_teacher), array('view', 'id'=>$data->pk_docs_teacher)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_document')); ?>:</b>
	<?php echo CHtml::encode($data->fk_document); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_teacher')); ?>:</b>
	<?php echo CHtml::encode($data->fk_teacher); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>