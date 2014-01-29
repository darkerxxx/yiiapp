<?php
/* @var $this MoviesController */
/* @var $model Movies */

$this->breadcrumbs=array(
	'Movies'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Movies', 'url'=>array('index')),
	array('label'=>'Create Movies', 'url'=>array('create')),
	array('label'=>'Update Movies', 'url'=>array('update', 'id'=>$model->movieid)),
	array('label'=>'Delete Movies', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->movieid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Movies', 'url'=>array('admin')),
);
?>

<h1>View Movies #<?php echo $model->movieid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'movieid',
		'title',
		'year',
		'description',
	),
)); ?>
