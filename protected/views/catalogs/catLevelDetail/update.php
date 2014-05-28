<?php
/* @var $this CatLevelDetailController */
/* @var $model CatLevelDetail */

$this->breadcrumbs=array(
	'Cat Level Details'=>array('index'),
	$model->pk_level_detail=>array('view','id'=>$model->pk_level_detail),
	'Update',
);
$this->menu=array(
	array('label'=>'Crear Nivel Detalle', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Nivel Detalle', 'url'=>array('index')),
);
/*
$this->menu=array(
	array('label'=>'List CatLevelDetail', 'url'=>array('index')),
	array('label'=>'Create CatLevelDetail', 'url'=>array('create')),
	array('label'=>'View CatLevelDetail', 'url'=>array('view', 'id'=>$model->pk_level_detail)),
	array('label'=>'Manage CatLevelDetail', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>Actualizar Nivel Detalle</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>