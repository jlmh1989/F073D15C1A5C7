<?php
/* @var $this StudentsGroupController */
/* @var $model StudentsGroup */

$this->breadcrumbs=array(
	'Students Groups'=>array('index'),
	$model->pk_student_group,
);

$this->menu=array(
	array('label'=>'List StudentsGroup', 'url'=>array('index')),
	array('label'=>'Create StudentsGroup', 'url'=>array('create')),
	array('label'=>'Update StudentsGroup', 'url'=>array('update', 'id'=>$model->pk_student_group)),
	array('label'=>'Delete StudentsGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_student_group),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StudentsGroup', 'url'=>array('admin')),
);
?>

<h1>View StudentsGroup #<?php echo $model->pk_student_group; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fk_group',
		'fk_student',
		'status',
		'fk_client',
		'pk_student_group',
	),
)); ?>
