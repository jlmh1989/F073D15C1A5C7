<?php
/* @var $this LoanMaterialController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Loan Materials',
);

$this->menu=array(
	array('label'=>'Create LoanMaterial', 'url'=>array('create')),
	array('label'=>'Manage LoanMaterial', 'url'=>array('admin')),
);
?>

<h1>Loan Materials</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
