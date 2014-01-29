<?php
/* @var $this MoviesController */
/* @var $model Movies */

$this->breadcrumbs=array(
	'Movies'=>array('index'),
	$model->title=>array('view','id'=>$model->movieid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Movies', 'url'=>array('index')),
	array('label'=>'Create Movies', 'url'=>array('create')),
	array('label'=>'View Movies', 'url'=>array('view', 'id'=>$model->movieid)),
	array('label'=>'Manage Movies', 'url'=>array('admin')),
);
?>

<h1>Update Movies <?php echo $model->movieid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>