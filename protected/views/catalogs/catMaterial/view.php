<?php
/* @var $this CatMaterialController */
/* @var $model CatMaterial */

$this->breadcrumbs=array(
	'Cat Materials'=>array('index'),
	$model->pk_material,
);

$this->menu=array(
	array('label'=>'List CatMaterial', 'url'=>array('index')),
	array('label'=>'Create CatMaterial', 'url'=>array('create')),
	array('label'=>'Update CatMaterial', 'url'=>array('update', 'id'=>$model->pk_material)),
	array('label'=>'Delete CatMaterial', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_material),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatMaterial', 'url'=>array('admin')),
);
?>

<h1>View CatMaterial #<?php echo $model->pk_material; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_material',
		'desc_material',
		'fk_type_material',
	),
)); ?>
