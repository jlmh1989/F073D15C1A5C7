<?php
/* @var $this CatLevelDetailController */
/* @var $model CatLevelDetail */
/* @var $modelTbl CatLevelDetail */
/* @var $modelML MaterialLevel */

$this->breadcrumbs=array(
	'Niveles'=>Yii::app()->createUrl("catalogs/catLevels/index"),
	'Nivel['.$_SESSION['CatLevels']['desc_level'].']',
        $_SESSION['CatLevels']['escenario'] == 0 ? 'Crear':'Actualizar'.' Detalle',
);
//$this->menu=array(
//	array('label'=>'Crear Nivel Detalle', 'url'=>array('create')),
//	array('label'=>'Ver Catálogo Nivel Detalle', 'url'=>array('index')),
//);
$this->menu=array(
	array('label'=>'Crear Nivel', 'url'=>Yii::app()->createUrl("catalogs/catLevels/create")),
	array('label'=>'Ver Catálogo Nivel', 'url'=>Yii::app()->createUrl("catalogs/catLevels/index")),
);
?>

<h3><?= $_SESSION['CatLevels']['escenario'] == 0 ? 'Crear':'Actualizar' ?> Detalle para Nivel <?= $_SESSION['CatLevels']['desc_level'] ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model,'modelTbl'=>$modelTbl,'modelML'=>$modelML)); ?>