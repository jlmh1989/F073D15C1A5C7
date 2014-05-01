<?php
/* @var $this BillingDataController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Billing Datas',
);

$this->menu=array(
	array('label'=>'Create BillingData', 'url'=>array('create')),
	array('label'=>'Manage BillingData', 'url'=>array('admin')),
);
?>

<h1>Billing Datas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
