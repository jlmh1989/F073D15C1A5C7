<?php
/* @var $this CatDetailController */
/* @var $model CatDetail */

$this->breadcrumbs=array(
	'Catálogo Detalle'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'List CatDetail', 'url'=>array('index')),
	array('label'=>'Create CatDetail', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cat-detail-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cat Details</h1>

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
	'id'=>'cat-detail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'pk_cat_detail',
		'desc_cat_detail_es',
		'desc_cat_detail_en',
		'status',
		'fk_cat_master',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
