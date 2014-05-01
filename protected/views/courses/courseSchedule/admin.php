<?php
/* @var $this CourseScheduleController */
/* @var $model CourseSchedule */

$this->breadcrumbs=array(
	'Course Schedules'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CourseSchedule', 'url'=>array('index')),
	array('label'=>'Create CourseSchedule', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#course-schedule-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Course Schedules</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'course-schedule-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'pk_course_schedule',
		'fk_course',
		'fk_bss_day',
		'initial_hour',
		'final_hour',
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
