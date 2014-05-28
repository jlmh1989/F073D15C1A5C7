<?php
/* @var $this CatDetailController */
/* @var $model CatDetail */

$this->breadcrumbs=array(
	'Cat Details'=>array('index'),
	'Create',
);
$this->menu=array(
	array('label'=>'Crear Catálogo Detalle', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Detalle', 'url'=>array('index')),
);
/*
$this->menu=array(
	array('label'=>'List CatDetail', 'url'=>array('index')),
	array('label'=>'Manage CatDetail', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>Create CatDetail</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>