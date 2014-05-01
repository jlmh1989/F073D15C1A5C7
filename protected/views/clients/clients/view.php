<?php
/* @var $this ClientsController */
/* @var $model Clients */

$this->breadcrumbs=array(
	'Clients'=>array('index'),
	$model->pk_client,
);

$this->menu=array(
        array('label'=>'Dar de Alta Cliente', 'url'=>array('create')),
        array('label'=>'Clientes Activos', 'url'=>array('index')),
        array('label'=>'Clientes Inactivos', 'url'=>array('clientesInactivos')),
        /*
	array('label'=>'List Clients', 'url'=>array('index')),
	array('label'=>'Create Clients', 'url'=>array('create')),
	array('label'=>'Update Clients', 'url'=>array('update', 'id'=>$model->pk_client)),
	array('label'=>'Delete Clients', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_client),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Clients', 'url'=>array('admin')),
        */
);
?>

<h1>View Clients #<?php echo $model->pk_client; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_client',
		'fk_type_client',
		'client_name',
		'contact_name',
		'contact_mail',
		'contact_phone',
		'contact_phone_ext',
		'client_web',
		'status',
		'billing_data',
		'contact_cellphone',
	),
)); ?>
