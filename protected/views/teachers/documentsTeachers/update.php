<?php
/* @var $this DocumentsTeachersController */
/* @var $model DocumentsTeachers */

$this->breadcrumbs=array(
	'Documents Teachers'=>array('index'),
	$model->pk_docs_teacher=>array('view','id'=>$model->pk_docs_teacher),
	'Update',
);

$this->menu=array(
	array('label'=>'List DocumentsTeachers', 'url'=>array('index')),
	array('label'=>'Create DocumentsTeachers', 'url'=>array('create')),
	array('label'=>'View DocumentsTeachers', 'url'=>array('view', 'id'=>$model->pk_docs_teacher)),
	array('label'=>'Manage DocumentsTeachers', 'url'=>array('admin')),
);
?>

<h1>Update DocumentsTeachers <?php echo $model->pk_docs_teacher; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>