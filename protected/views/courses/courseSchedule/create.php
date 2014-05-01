<?php
/* @var $this CourseScheduleController */
/* @var $model CourseSchedule */

$this->breadcrumbs=array(
	'Course Schedules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CourseSchedule', 'url'=>array('index')),
	array('label'=>'Manage CourseSchedule', 'url'=>array('admin')),
);
?>

<h1>Create CourseSchedule</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>