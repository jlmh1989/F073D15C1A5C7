<?php
/* @var $this AssistanceRecordController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Assistance Records',
);

$this->menu=array(
	array('label'=>'Create AssistanceRecord', 'url'=>array('create')),
	array('label'=>'Manage AssistanceRecord', 'url'=>array('admin')),
);
?>

<h1>Assistance Records</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
