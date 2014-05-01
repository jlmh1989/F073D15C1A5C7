<?php
/* @var $this TeachersController */
/* @var $model Teachers */

$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	$model->name=>array('view','id'=>$model->pk_teacher),
	'Update',
);

$this->menu=array(
	array('label'=>'Dar de Alta Maestro', 'url'=>array('create')),
	array('label'=>'Maestros Activos', 'url'=>array('index')),
        array('label'=>'Maestros Inactivos', 'url'=>array('inactivos')),
);
/*
$this->menu=array(
	array('label'=>'List Teachers', 'url'=>array('index')),
	array('label'=>'Create Teachers', 'url'=>array('create')),
	array('label'=>'View Teachers', 'url'=>array('view', 'id'=>$model->pk_teacher)),
	array('label'=>'Manage Teachers', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>Update Teachers <?php echo $model->pk_teacher; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'modelCD'=>$modelCD,'modelUser'=>$modelUser,)); ?>