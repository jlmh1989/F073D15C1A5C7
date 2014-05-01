<?php
/* @var $this AssistanceRecordController */
/* @var $model AssistanceRecord */

$this->breadcrumbs=array(
	'Assistance Records'=>array('index'),
	$model->pk_assistance=>array('view','id'=>$model->pk_assistance),
	'Update',
);

$this->menu=array(
	array('label'=>'List AssistanceRecord', 'url'=>array('index')),
	array('label'=>'Create AssistanceRecord', 'url'=>array('create')),
	array('label'=>'View AssistanceRecord', 'url'=>array('view', 'id'=>$model->pk_assistance)),
	array('label'=>'Manage AssistanceRecord', 'url'=>array('admin')),
);
?>

<h1>Update AssistanceRecord <?php echo $model->pk_assistance; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>