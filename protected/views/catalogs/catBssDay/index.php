<?php
/* @var $this CatBssDayController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Bss Days',
);

$this->menu=array(
	array('label'=>'Create CatBssDay', 'url'=>array('create')),
	array('label'=>'Manage CatBssDay', 'url'=>array('admin')),
);
?>

<h1>Cat Bss Days</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
