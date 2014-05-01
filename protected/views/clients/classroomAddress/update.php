<?php
/* @var $this ClassroomAddressController */
/* @var $model ClassroomAddress */

$this->breadcrumbs=array(
	'Classroom Addresses'=>array('index'),
	$model->pk_classroom_direction=>array('view','id'=>$model->pk_classroom_direction),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClassroomAddress', 'url'=>array('index')),
	array('label'=>'Create ClassroomAddress', 'url'=>array('create')),
	array('label'=>'View ClassroomAddress', 'url'=>array('view', 'id'=>$model->pk_classroom_direction)),
	array('label'=>'Manage ClassroomAddress', 'url'=>array('admin')),
);
?>

<h1>Update ClassroomAddress <?php echo $model->pk_classroom_direction; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>