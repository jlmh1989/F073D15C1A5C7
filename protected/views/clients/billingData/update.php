<?php
/* @var $this BillingDataController */
/* @var $model BillingData */

$this->breadcrumbs=array(
	'Billing Datas'=>array('index'),
	$model->pk_billing_data=>array('view','id'=>$model->pk_billing_data),
	'Update',
);

$this->menu=array(
	array('label'=>'List BillingData', 'url'=>array('index')),
	array('label'=>'Create BillingData', 'url'=>array('create')),
	array('label'=>'View BillingData', 'url'=>array('view', 'id'=>$model->pk_billing_data)),
	array('label'=>'Manage BillingData', 'url'=>array('admin')),
);
?>

<h1>Update BillingData <?php echo $model->pk_billing_data; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>