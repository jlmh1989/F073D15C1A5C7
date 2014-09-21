<?php
/* @var $this MaterialsViewController */
/* @var $model MaterialsView */

$this->breadcrumbs=array(
	'Materials Views'=>array('index'),
	$model->pk_material=>array('view','id'=>$model->pk_material),
	'Update',
);

$this->menu=array(
	array('label'=>'List MaterialsView', 'url'=>array('index')),
	array('label'=>'Create MaterialsView', 'url'=>array('create')),
	array('label'=>'View MaterialsView', 'url'=>array('view', 'id'=>$model->pk_material)),
	array('label'=>'Manage MaterialsView', 'url'=>array('admin')),
);
?>

<h1>Update MaterialsView <?php echo $model->pk_material; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>