<?php
/* @var $this CatStatusClassController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Status Classes',
);

$this->menu=array(
	array('label'=>'Create CatStatusClass', 'url'=>array('create')),
	array('label'=>'Manage CatStatusClass', 'url'=>array('admin')),
);
?>

<h1>Cat Status Classes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
