<?php
/* @var $this CatLevelsController */
/* @var $model CatLevels */

$this->breadcrumbs=array(
	'Cat Levels'=>array('index'),
	$model->pk_level=>array('view','id'=>$model->pk_level),
	'Update',
);

$this->menu=array(
	array('label'=>'List CatLevels', 'url'=>array('index')),
	array('label'=>'Create CatLevels', 'url'=>array('create')),
	array('label'=>'View CatLevels', 'url'=>array('view', 'id'=>$model->pk_level)),
	array('label'=>'Manage CatLevels', 'url'=>array('admin')),
);
?>

<h1>Update CatLevels <?php echo $model->pk_level; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>