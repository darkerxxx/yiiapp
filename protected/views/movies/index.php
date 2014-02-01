<?php
/* @var $this MoviesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Movies',
);

$this->menu=array(
	array('label'=>'Add new movie', 'url'=>array('create')),
	array('label'=>'Manage movies', 'url'=>array('admin')),
);
?>

<h1>Movies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'sortableAttributes'=>array('title','year'),
	/*'sort' => array(
		'defaultOrder' => array(
		'title' => CSort::SORT_ASC,
	)),*/
)); ?>
