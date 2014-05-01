<?php
/* @var $this MaterialLevelController */
/* @var $model MaterialLevel */

$this->breadcrumbs=array(
	'Material Levels'=>array('index'),
	$model->pk_material_level,
);

$this->menu=array(
	array('label'=>'List MaterialLevel', 'url'=>array('index')),
	array('label'=>'Create MaterialLevel', 'url'=>array('create')),
	array('label'=>'Update MaterialLevel', 'url'=>array('update', 'id'=>$model->pk_material_level)),
	array('label'=>'Delete MaterialLevel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_material_level),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MaterialLevel', 'url'=>array('admin')),
);
?>

<h1>View MaterialLevel #<?php echo $model->pk_material_level; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fk_level',
		'fk_material',
		'status',
		'pk_material_level',
	),
)); ?>
