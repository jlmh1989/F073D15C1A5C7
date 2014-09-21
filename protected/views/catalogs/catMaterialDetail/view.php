<?php
/* @var $this CatMaterialDetailController */
/* @var $model CatMaterialDetail */

$this->breadcrumbs=array(
	'Cat Material Details'=>array('index'),
	$model->pk_material_detail,
);

$this->menu=array(
	array('label'=>'List CatMaterialDetail', 'url'=>array('index')),
	array('label'=>'Create CatMaterialDetail', 'url'=>array('create')),
	array('label'=>'Update CatMaterialDetail', 'url'=>array('update', 'id'=>$model->pk_material_detail)),
	array('label'=>'Delete CatMaterialDetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_material_detail),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatMaterialDetail', 'url'=>array('admin')),
);
?>

<h1>View CatMaterialDetail #<?php echo $model->pk_material_detail; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_material_detail',
		'material_code',
		'comment',
		'availability',
		'fk_cat_material',
	),
)); ?>
