<?php
/* @var $this CatStatusClassController */
/* @var $model CatStatusClass */

$this->breadcrumbs=array(
	'Cat Status Classes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CatStatusClass', 'url'=>array('index')),
	array('label'=>'Create CatStatusClass', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cat-status-class-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cat Status Classes</h1>

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
	'id'=>'cat-status-class-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'pk_status_class',
		'desc_status_class',
		'long_desc',
		'is_reschedule_motive',
		'fk_type_class',
		'fk_role_class',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
