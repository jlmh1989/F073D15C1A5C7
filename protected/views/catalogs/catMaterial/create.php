<?php
/* @var $this CatMaterialController */
/* @var $model CatMaterial */

$this->breadcrumbs=array(
	'Cat Materials'=>array('index'),
	'Create',
);
$this->menu=array(
	array('label'=>'Crear Material', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Material', 'url'=>array('index')),
);
/*
$this->menu=array(
	array('label'=>'List CatMaterial', 'url'=>array('index')),
	array('label'=>'Manage CatMaterial', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>Crear Material</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>