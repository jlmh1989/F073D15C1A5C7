<?php
/* @var $this CourseScheduleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Course Schedules',
);

$this->menu=array(
	array('label'=>'Create CourseSchedule', 'url'=>array('create')),
	array('label'=>'Manage CourseSchedule', 'url'=>array('admin')),
);
?>

<h1>Course Schedules</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
