<?php
/* @var $this StudentsGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Students Groups',
);

$this->menu=array(
	array('label'=>'Create StudentsGroup', 'url'=>array('create')),
	array('label'=>'Manage StudentsGroup', 'url'=>array('admin')),
);
?>

<h1>Students Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
