<?php
/* @var $this DocumentsTeachersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Documents Teachers',
);

$this->menu=array(
	array('label'=>'Create DocumentsTeachers', 'url'=>array('create')),
	array('label'=>'Manage DocumentsTeachers', 'url'=>array('admin')),
);
?>

<h1>Documents Teachers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
