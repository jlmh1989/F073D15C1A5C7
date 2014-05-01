<?php
/* @var $this CatBssHoursController */
/* @var $model CatBssHours */

$this->breadcrumbs=array(
	'Cat Bss Hours'=>array('index'),
	$model->pk_bss_hour=>array('view','id'=>$model->pk_bss_hour),
	'Update',
);

$this->menu=array(
	array('label'=>'List CatBssHours', 'url'=>array('index')),
	array('label'=>'Create CatBssHours', 'url'=>array('create')),
	array('label'=>'View CatBssHours', 'url'=>array('view', 'id'=>$model->pk_bss_hour)),
	array('label'=>'Manage CatBssHours', 'url'=>array('admin')),
);
?>

<h1>Update CatBssHours <?php echo $model->pk_bss_hour; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>