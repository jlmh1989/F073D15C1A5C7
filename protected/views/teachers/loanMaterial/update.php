<?php
/* @var $this LoanMaterialController */
/* @var $model LoanMaterial */

$this->breadcrumbs=array(
	'Loan Materials'=>array('index'),
	$model->pk_loan_material=>array('view','id'=>$model->pk_loan_material),
	'Update',
);

$this->menu=array(
	array('label'=>'List LoanMaterial', 'url'=>array('index')),
	array('label'=>'Create LoanMaterial', 'url'=>array('create')),
	array('label'=>'View LoanMaterial', 'url'=>array('view', 'id'=>$model->pk_loan_material)),
	array('label'=>'Manage LoanMaterial', 'url'=>array('admin')),
);
?>

<h1>Update LoanMaterial <?php echo $model->pk_loan_material; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>