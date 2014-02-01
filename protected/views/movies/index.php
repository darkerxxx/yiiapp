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
<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#movies-list').yiiCListView('update', {
		data: $(model).serialize()
	});
	return false;
});
");
?>
<?php $model=new Movies('search');
$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Movies']))
			$model->attributes=$_GET['Movies'];
			/*$model->attributes = array (
				'title',
				'year',
			);*/
			?>
<?php echo CHtml::link('Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	'attributes' => array(
		'title',
		'year'
	),
)); ?>
</div>


<?php $this->widget('zii.widgets.CListView', array(
	'id' => 'movies-list',
	//'dataProvider'=>$dataProvider,
	'dataProvider'=>$model->search(),
	'itemView'=>'_view',
	'sortableAttributes'=>array('title','year'),
	/*'sort' => array(
		'defaultOrder' => array(
		'title' => CSort::SORT_ASC,
	)),*/
)); ?>
