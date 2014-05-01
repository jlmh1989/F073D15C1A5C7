<?php
/* @var $this CatBssHoursController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Bss Hours',
);

$this->menu=array(
	array('label'=>'Create CatBssHours', 'url'=>array('create')),
	array('label'=>'Manage CatBssHours', 'url'=>array('admin')),
);
?>

<h1>Cat Bss Hours</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
