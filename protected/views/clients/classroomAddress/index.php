<?php
/* @var $this ClassroomAddressController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Classroom Addresses',
);

$this->menu=array(
	array('label'=>'Create ClassroomAddress', 'url'=>array('create')),
	array('label'=>'Manage ClassroomAddress', 'url'=>array('admin')),
);
?>

<h1>Classroom Addresses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
