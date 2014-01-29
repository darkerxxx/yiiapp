<?php
/* @var $this MoviesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Movies',
);

$this->menu=array(
	array('label'=>'Create Movies', 'url'=>array('create')),
	array('label'=>'Manage Movies', 'url'=>array('admin')),
);
?>

<h1>Movies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
