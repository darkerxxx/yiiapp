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
		'rating' => array('name' => 'Rating', 'value' => countRating($model)),
	),
)); ?>

<?php 
/*Yii::app()->clientScript->registerScript('rate', "
$('.rate-button').click(function(){
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
*/
/**
 * Right now, shows dropdown list for rating if user is logged in.
 * @todo Rate button isn't working. In progress.
 * @todo Also needed to set IF for already rated user. *
 */
if(!Yii::app()->user->isGuest){
$modelX = new Rating;
$attribute = 'value';
$data = array ('1','2','3','4','5');
echo "(Function in progress!) Rate this movie: ";
echo CHtml::activeDropDownList($modelX,$attribute,$data);
echo CHtml::submitButton('Rate');
//var_dump($modelX->value);
}
else echo "You must be logged in, to rate movies! (function in progress!)";
?>





<?php 
/**
 * Function for rating calculation
 */
function countRating($model){
	$rating=0;
	$counter=0;
	$connection=Yii::app()->db;
	$query = sprintf("SELECT value FROM imdb.rating
	    WHERE movieid='%s'",
			mysql_real_escape_string($model->movieid)
	);
	$command=$connection->createCommand($query);
	$dataReader=$command->query();
	foreach($dataReader as $row)
	{
		$counter++;
		$rating += $row['value'];
	}
	if($counter != 0){
		$rating = $rating / $counter;
	}
	else return 0;
	return round($rating, 2);
}
/**
 * Function for rating submission (?)
 */
function submitRating($model,$page,$modelX)
{
	$connection=Yii::app()->db;
	$query = sprintf("INSERT INTO imdb.rating 
		VALUES movieid, username, value
	    WHERE 	movieid='%s',
				username='%s'
				value='%s'
				",
			mysql_real_escape_string($model->movieid),
			mysql_real_escape_string(Yii::app()->user->id),
			mysql_real_escape_string($modelX->value)
	);
	$command=$connection->createCommand($query);
	$dataReader=$command->query();
	$page->refresh();
}
?>


