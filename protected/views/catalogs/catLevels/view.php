<?php
/* @var $this CatLevelsController */
/* @var $model CatLevels */

$this->breadcrumbs=array(
	'Cat Levels'=>array('index'),
	$model->pk_level,
);

$this->menu=array(
	array('label'=>'List CatLevels', 'url'=>array('index')),
	array('label'=>'Create CatLevels', 'url'=>array('create')),
	array('label'=>'Update CatLevels', 'url'=>array('update', 'id'=>$model->pk_level)),
	array('label'=>'Delete CatLevels', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_level),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatLevels', 'url'=>array('admin')),
);
?>

<h1>View CatLevels #<?php echo $model->pk_level; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_level',
		'desc_level',
		'fk_associated_book',
		'total_hours',
		'status',
	),
)); ?>
