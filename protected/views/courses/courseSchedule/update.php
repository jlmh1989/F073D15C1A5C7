<?php
/* @var $this CourseScheduleController */
/* @var $model CourseSchedule */

$this->breadcrumbs=array(
	'Course Schedules'=>array('index'),
	$model->pk_course_schedule=>array('view','id'=>$model->pk_course_schedule),
	'Update',
);

$this->menu=array(
	array('label'=>'List CourseSchedule', 'url'=>array('index')),
	array('label'=>'Create CourseSchedule', 'url'=>array('create')),
	array('label'=>'View CourseSchedule', 'url'=>array('view', 'id'=>$model->pk_course_schedule)),
	array('label'=>'Manage CourseSchedule', 'url'=>array('admin')),
);
?>

<h1>Update CourseSchedule <?php echo $model->pk_course_schedule; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>