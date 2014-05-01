<?php
/* @var $this CatStatusClassController */
/* @var $model CatStatusClass */

$this->breadcrumbs=array(
	'Cat Status Classes'=>array('index'),
	$model->pk_status_class,
);

$this->menu=array(
	array('label'=>'List CatStatusClass', 'url'=>array('index')),
	array('label'=>'Create CatStatusClass', 'url'=>array('create')),
	array('label'=>'Update CatStatusClass', 'url'=>array('update', 'id'=>$model->pk_status_class)),
	array('label'=>'Delete CatStatusClass', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_status_class),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatStatusClass', 'url'=>array('admin')),
);
?>

<h1>View CatStatusClass #<?php echo $model->pk_status_class; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_status_class',
		'desc_status_class',
		'long_desc',
		'is_reschedule_motive',
		'fk_type_class',
		'fk_role_class',
	),
)); ?>
