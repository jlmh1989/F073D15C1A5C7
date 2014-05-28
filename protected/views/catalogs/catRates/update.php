<?php
/* @var $this CatRatesController */
/* @var $model CatRates */

$this->breadcrumbs=array(
	'Cat Rates'=>array('index'),
	$model->pk_rate=>array('view','id'=>$model->pk_rate),
	'Update',
);
$this->menu=array(
	array('label'=>'Crear Tarifa', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Tarifa', 'url'=>array('index')),
);
/*
$this->menu=array(
	array('label'=>'List CatRates', 'url'=>array('index')),
	array('label'=>'Create CatRates', 'url'=>array('create')),
	array('label'=>'View CatRates', 'url'=>array('view', 'id'=>$model->pk_rate)),
	array('label'=>'Manage CatRates', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>Actualizar Tarifa</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>