<?php
/* @var $this CatMaterialController */
/* @var $model CatMaterial */

$this->breadcrumbs=array(
	'Cat Materials'=>array('index'),
	$model->pk_material=>array('view','id'=>$model->pk_material),
	'Update',
);

$this->menu=array(
	array('label'=>'List CatMaterial', 'url'=>array('index')),
	array('label'=>'Create CatMaterial', 'url'=>array('create')),
	array('label'=>'View CatMaterial', 'url'=>array('view', 'id'=>$model->pk_material)),
	array('label'=>'Manage CatMaterial', 'url'=>array('admin')),
);
?>

<h1>Update CatMaterial <?php echo $model->pk_material; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>