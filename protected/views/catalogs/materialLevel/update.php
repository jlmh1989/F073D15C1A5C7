<?php
/* @var $this MaterialLevelController */
/* @var $model MaterialLevel */

$this->breadcrumbs=array(
	'Material Levels'=>array('index'),
	$model->pk_material_level=>array('view','id'=>$model->pk_material_level),
	'Update',
);

$this->menu=array(
	array('label'=>'List MaterialLevel', 'url'=>array('index')),
	array('label'=>'Create MaterialLevel', 'url'=>array('create')),
	array('label'=>'View MaterialLevel', 'url'=>array('view', 'id'=>$model->pk_material_level)),
	array('label'=>'Manage MaterialLevel', 'url'=>array('admin')),
);
?>

<h1>Update MaterialLevel <?php echo $model->pk_material_level; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>