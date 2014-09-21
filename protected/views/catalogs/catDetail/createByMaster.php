<?php
/* @var $this CatDetailController */
/* @var $model CatDetail */
/* @var $modelTbl CatDetail */

$this->breadcrumbs=array(
	'Catálogo Maestro'=>Yii::app()->createUrl("catalogs/catMaster/index"),
        'Catálogo Maestro['.$_SESSION['CatMaster']['desc_cat_master'].']',
	$_SESSION['CatMaster']['escenario'] == 0 ? 'Crear':'Actualizar'.' Detalle',
);
$this->menu=array(
	array('label'=>'Crear Catálogo Maestro', 'url'=>Yii::app()->createUrl("catalogs/catMaster/create")),
	array('label'=>'Ver Catálogo Maestro', 'url'=>Yii::app()->createUrl("catalogs/catMaster/index")),
);
?>

<h3><?= $_SESSION['CatMaster']['escenario'] == 0 ? 'Crear':'Actualizar' ?> Detalle para <?= $_SESSION['CatMaster']['desc_cat_master'] ?></h3>

<?php $this->renderPartial('_formByMaster', array('model'=>$model,'modelTbl'=>$modelTbl)); ?>