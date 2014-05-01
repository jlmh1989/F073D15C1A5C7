<?php
/* @var $this BillingDataController */
/* @var $model BillingData */

$this->breadcrumbs=array(
	'Billing Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BillingData', 'url'=>array('index')),
	array('label'=>'Manage BillingData', 'url'=>array('admin')),
);
?>

<h1>Create BillingData</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>