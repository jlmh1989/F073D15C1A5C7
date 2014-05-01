<?php
/* @var $this StudentsGroupController */
/* @var $model StudentsGroup */

$this->breadcrumbs=array(
	'Students Groups'=>array('index'),
	$model->pk_student_group=>array('view','id'=>$model->pk_student_group),
	'Update',
);

$this->menu=array(
	array('label'=>'List StudentsGroup', 'url'=>array('index')),
	array('label'=>'Create StudentsGroup', 'url'=>array('create')),
	array('label'=>'View StudentsGroup', 'url'=>array('view', 'id'=>$model->pk_student_group)),
	array('label'=>'Manage StudentsGroup', 'url'=>array('admin')),
);
?>

<h1>Update StudentsGroup <?php echo $model->pk_student_group; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>