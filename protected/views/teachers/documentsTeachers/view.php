<?php
/* @var $this DocumentsTeachersController */
/* @var $model DocumentsTeachers */

$this->breadcrumbs=array(
	'Documents Teachers'=>array('index'),
	$model->pk_docs_teacher,
);

$this->menu=array(
	array('label'=>'List DocumentsTeachers', 'url'=>array('index')),
	array('label'=>'Create DocumentsTeachers', 'url'=>array('create')),
	array('label'=>'Update DocumentsTeachers', 'url'=>array('update', 'id'=>$model->pk_docs_teacher)),
	array('label'=>'Delete DocumentsTeachers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_docs_teacher),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DocumentsTeachers', 'url'=>array('admin')),
);
?>

<h1>View DocumentsTeachers #<?php echo $model->pk_docs_teacher; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fk_document',
		'fk_teacher',
		'status',
		'pk_docs_teacher',
	),
)); ?>
