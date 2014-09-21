<?php
/* @var $this CatMaterialDetailController */
/* @var $model CatMaterialDetail */

$this->breadcrumbs=array(
	'Cat Material Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CatMaterialDetail', 'url'=>array('index')),
	array('label'=>'Manage CatMaterialDetail', 'url'=>array('admin')),
);
?>

<h1>Create CatMaterialDetail</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>