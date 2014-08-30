<?php
/* @var $this MaterialsViewController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Materials Views',
);

$this->menu=array(
	array('label'=>'Create MaterialsView', 'url'=>array('create')),
	array('label'=>'Manage MaterialsView', 'url'=>array('admin')),
);
?>

<h1>Materials Views</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
