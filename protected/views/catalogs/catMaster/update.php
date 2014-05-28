<?php
/* @var $this CatMasterController */
/* @var $model CatMaster */

$this->breadcrumbs=array(
	'Cat Masters'=>array('index'),
	$model->pk_cat_master=>array('view','id'=>$model->pk_cat_master),
	'Update',
);
$this->menu=array(
	array('label'=>'Crear Catálogo General', 'url'=>array('create')),
	array('label'=>'Ver Catálogo General', 'url'=>array('index')),
);
/*
$this->menu=array(
	array('label'=>'List CatMaster', 'url'=>array('index')),
	array('label'=>'Create CatMaster', 'url'=>array('create')),
	array('label'=>'View CatMaster', 'url'=>array('view', 'id'=>$model->pk_cat_master)),
	array('label'=>'Manage CatMaster', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>Actualizar Cat&aacute;logo General</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>