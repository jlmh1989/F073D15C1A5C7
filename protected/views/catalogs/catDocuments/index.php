<?php
/* @var $this CatDocumentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Documents',
);

$this->menu=array(
	array('label'=>'Create CatDocuments', 'url'=>array('create')),
	array('label'=>'Manage CatDocuments', 'url'=>array('admin')),
);
?>

<h1>Cat Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
