<?php
/* @var $this UnavailableScheduleController */
/* @var $model UnavailableSchedule */

$this->breadcrumbs=array(
	'Unavailable Schedules'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UnavailableSchedule', 'url'=>array('index')),
	array('label'=>'Create UnavailableSchedule', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#unavailable-schedule-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Unavailable Schedules</h1>

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
	'id'=>'unavailable-schedule-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'pk_unavailable_schedule',
		'fk_bss_day',
		'fk_teacher',
		'initial_hour',
		'final_hour',
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
