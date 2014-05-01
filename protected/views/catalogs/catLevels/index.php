<?php
/* @var $this CatLevelsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Levels',
);

$this->menu=array(
	array('label'=>'Create CatLevels', 'url'=>array('create')),
	array('label'=>'Manage CatLevels', 'url'=>array('admin')),
);
?>

<h1>Cat Levels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
