<?php
/* @var $this BillingDataController */
/* @var $model BillingData */

$this->breadcrumbs=array(
	'Billing Datas'=>array('index'),
	$model->pk_billing_data,
);

$this->menu=array(
	array('label'=>'List BillingData', 'url'=>array('index')),
	array('label'=>'Create BillingData', 'url'=>array('create')),
	array('label'=>'Update BillingData', 'url'=>array('update', 'id'=>$model->pk_billing_data)),
	array('label'=>'Delete BillingData', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_billing_data),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BillingData', 'url'=>array('admin')),
);
?>

<h1>View BillingData #<?php echo $model->pk_billing_data; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_billing_data',
		'fk_client',
		'street',
		'street_number',
		'street_number_int',
		'bussiness_name',
		'county',
		'neighborhood',
		'state',
		'country',
		'zipcode',
		'rfc',
		'status',
	),
)); ?>
