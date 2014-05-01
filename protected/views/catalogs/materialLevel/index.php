<?php
/* @var $this MaterialLevelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Material Levels',
);

$this->menu=array(
	array('label'=>'Create MaterialLevel', 'url'=>array('create')),
	array('label'=>'Manage MaterialLevel', 'url'=>array('admin')),
);
?>

<h1>Material Levels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
