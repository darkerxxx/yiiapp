<?php
/* @var $this MoviesController */
/* @var $model Movies */

$this->breadcrumbs=array(
	'Movies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Movies', 'url'=>array('index')),
	array('label'=>'Manage Movies', 'url'=>array('admin')),
);
?>

<h1>Create Movies</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>