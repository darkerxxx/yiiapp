<?php
/* @var $this MoviesController */
/* @var $model Movies */

$this->breadcrumbs=array(
	'Movies'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List of movies', 'url'=>array('index')),
	array('label'=>'Add new movie', 'url'=>array('create')),
	array('label'=>'Update movie info', 'url'=>array('update', 'id'=>$model->movieid)),
	array('label'=>'Delete this movie', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->movieid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage movies', 'url'=>array('admin')),
);
?>

<!--  <h1>View Movies #<?php /*echo $model->movieid;*/ ?></h1> -->
<h1><?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'movieid',
		'title',
		'year',
		'description',
	),
)); ?>
