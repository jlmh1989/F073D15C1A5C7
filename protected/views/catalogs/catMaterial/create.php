<?php
/* @var $this CatMaterialController */
/* @var $model CatMaterial */

$this->breadcrumbs=array(
	'Cat Materials'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CatMaterial', 'url'=>array('index')),
	array('label'=>'Manage CatMaterial', 'url'=>array('admin')),
);
?>

<h1>Create CatMaterial</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>