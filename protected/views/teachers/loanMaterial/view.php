<?php
/* @var $this LoanMaterialController */
/* @var $model LoanMaterial */

$this->breadcrumbs=array(
	'Loan Materials'=>array('index'),
	$model->pk_loan_material,
);

$this->menu=array(
	array('label'=>'List LoanMaterial', 'url'=>array('index')),
	array('label'=>'Create LoanMaterial', 'url'=>array('create')),
	array('label'=>'Update LoanMaterial', 'url'=>array('update', 'id'=>$model->pk_loan_material)),
	array('label'=>'Delete LoanMaterial', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_loan_material),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LoanMaterial', 'url'=>array('admin')),
);
?>

<h1>View LoanMaterial #<?php echo $model->pk_loan_material; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_loan_material',
		'fk_course',
		'fk_teacher',
		'fk_material_detail',
		'pick_date',
		'drop_date',
		'comment',
	),
)); ?>
