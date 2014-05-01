<?php
/* @var $this AssistanceRecordController */
/* @var $model AssistanceRecord */

$this->breadcrumbs=array(
	'Assistance Records'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AssistanceRecord', 'url'=>array('index')),
	array('label'=>'Create AssistanceRecord', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#assistance-record-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Assistance Records</h1>

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
	'id'=>'assistance-record-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'pk_assistance',
		'class_date',
		'fk_course',
		'fk_client',
		'fk_student',
		'fk_status_class',
		/*
		'reschedule_date',
		'reschedule_time',
		'cancellation_reason',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
