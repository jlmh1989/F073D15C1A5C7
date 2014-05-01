<?php
/* @var $this StudentsGroupController */
/* @var $model StudentsGroup */

$this->breadcrumbs=array(
	'Students Groups'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List StudentsGroup', 'url'=>array('index')),
	array('label'=>'Create StudentsGroup', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#students-group-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Students Groups</h1>

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
	'id'=>'students-group-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'fk_group',
		'fk_student',
		'status',
		'fk_client',
		'pk_student_group',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
