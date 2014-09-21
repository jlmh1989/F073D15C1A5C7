<?php
/* @var $this LoanMaterialController */
/* @var $model LoanMaterial */

$this->breadcrumbs=array(
	'Loan Materials'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LoanMaterial', 'url'=>array('index')),
	array('label'=>'Manage LoanMaterial', 'url'=>array('admin')),
);
?>

<h1>Create LoanMaterial</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>