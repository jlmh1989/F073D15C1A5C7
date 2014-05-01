<?php
/* @var $this ClassroomAddressController */
/* @var $model ClassroomAddress */

$this->breadcrumbs=array(
	'Classroom Addresses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ClassroomAddress', 'url'=>array('index')),
	array('label'=>'Create ClassroomAddress', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#classroom-address-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Classroom Addresses</h1>

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
	'id'=>'classroom-address-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'pk_classroom_direction',
		'fk_client',
		'street',
		'street_number',
		'street_number_int',
		'neighborhood',
		/*
		'county',
		'fk_state_dir',
		'country',
		'zipcode',
		'status',
		'phone',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
