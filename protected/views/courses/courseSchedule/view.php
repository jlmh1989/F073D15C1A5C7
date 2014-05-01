<?php
/* @var $this CourseScheduleController */
/* @var $model CourseSchedule */

$this->breadcrumbs=array(
	'Course Schedules'=>array('index'),
	$model->pk_course_schedule,
);

$this->menu=array(
	array('label'=>'List CourseSchedule', 'url'=>array('index')),
	array('label'=>'Create CourseSchedule', 'url'=>array('create')),
	array('label'=>'Update CourseSchedule', 'url'=>array('update', 'id'=>$model->pk_course_schedule)),
	array('label'=>'Delete CourseSchedule', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_course_schedule),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CourseSchedule', 'url'=>array('admin')),
);
?>

<h1>View CourseSchedule #<?php echo $model->pk_course_schedule; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_course_schedule',
		'fk_course',
		'fk_bss_day',
		'initial_hour',
		'final_hour',
		'status',
	),
)); ?>
