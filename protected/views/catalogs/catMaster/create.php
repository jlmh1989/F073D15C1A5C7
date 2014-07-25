<?php
/* @var $this CatMasterController */
/* @var $model CatMaster */

$this->breadcrumbs=array(
	'Catálogo Maestro'=>array('index'),
	'Crear Nuevo',
);
$this->menu=array(
	array('label'=>'Crear Catálogo General', 'url'=>array('create')),
	array('label'=>'Ver Catálogo General', 'url'=>array('index')),
);
/*
$this->menu=array(
	array('label'=>'List CatMaster', 'url'=>array('index')),
	array('label'=>'Manage CatMaster', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>Crear Cat&aacute;logo General</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>