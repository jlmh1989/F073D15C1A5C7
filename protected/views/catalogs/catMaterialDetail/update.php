<?php
/* @var $this CatMaterialDetailController */
/* @var $model CatMaterialDetail */

$this->breadcrumbs=array(
	'Cat Material Details'=>array('index'),
	$model->pk_material_detail=>array('view','id'=>$model->pk_material_detail),
	'Update',
);

$this->menu=array(
	array('label'=>'List CatMaterialDetail', 'url'=>array('index')),
	array('label'=>'Create CatMaterialDetail', 'url'=>array('create')),
	array('label'=>'View CatMaterialDetail', 'url'=>array('view', 'id'=>$model->pk_material_detail)),
	array('label'=>'Manage CatMaterialDetail', 'url'=>array('admin')),
);
?>

<h1>Update CatMaterialDetail <?php echo $model->pk_material_detail; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>