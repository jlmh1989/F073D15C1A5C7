<?php
/* @var $this CatDocumentsController */
/* @var $data CatDocuments */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_document')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_document), array('view', 'id'=>$data->pk_document)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_document')); ?>:</b>
	<?php echo CHtml::encode($data->desc_document); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>