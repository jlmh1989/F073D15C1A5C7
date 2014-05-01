<?php
/* @var $this CatRatesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Rates',
);

$this->menu=array(
	array('label'=>'Create CatRates', 'url'=>array('create')),
	array('label'=>'Manage CatRates', 'url'=>array('admin')),
);
?>

<h1>Cat Rates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
