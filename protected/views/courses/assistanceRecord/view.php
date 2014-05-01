<?php
/* @var $this AssistanceRecordController */
/* @var $model AssistanceRecord */

$this->breadcrumbs=array(
	'Assistance Records'=>array('index'),
	$model->pk_assistance,
);

$this->menu=array(
	array('label'=>'List AssistanceRecord', 'url'=>array('index')),
	array('label'=>'Create AssistanceRecord', 'url'=>array('create')),
	array('label'=>'Update AssistanceRecord', 'url'=>array('update', 'id'=>$model->pk_assistance)),
	array('label'=>'Delete AssistanceRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_assistance),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AssistanceRecord', 'url'=>array('admin')),
);
?>

<h1>View AssistanceRecord #<?php echo $model->pk_assistance; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_assistance',
		'class_date',
		'fk_course',
		'fk_client',
		'fk_student',
		'fk_status_class',
		'reschedule_date',
		'reschedule_time',
		'cancellation_reason',
	),
)); ?>
