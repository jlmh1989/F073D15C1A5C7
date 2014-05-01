<?php
/* @var $this UnavailableScheduleController */
/* @var $model UnavailableSchedule */

$this->breadcrumbs=array(
	'Unavailable Schedules'=>array('index'),
	$model->pk_unavailable_schedule,
);

$this->menu=array(
	array('label'=>'List UnavailableSchedule', 'url'=>array('index')),
	array('label'=>'Create UnavailableSchedule', 'url'=>array('create')),
	array('label'=>'Update UnavailableSchedule', 'url'=>array('update', 'id'=>$model->pk_unavailable_schedule)),
	array('label'=>'Delete UnavailableSchedule', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_unavailable_schedule),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UnavailableSchedule', 'url'=>array('admin')),
);
?>

<h1>View UnavailableSchedule #<?php echo $model->pk_unavailable_schedule; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_unavailable_schedule',
		'fk_bss_day',
		'fk_teacher',
		'initial_hour',
		'final_hour',
		'status',
	),
)); ?>
