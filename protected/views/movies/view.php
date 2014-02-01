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
/**
 * 
 */
/*$rating;
$counter;
//$model->movieid;
//Yii::app()->user->id;
$query = sprintf("SELECT value FROM imdb.rating
    WHERE movieid='%s'",
	mysql_real_escape_string($model->movieid)
);
$result = mysql_query($query);
if (!$result) {
	$message  = 'Wrong query: ' . mysql_error() . "\n";
	$message .= 'Query: ' . $query;
	die($message);
}
while ($row = mysql_fetch_assoc($result)) {
	$counter++;
	$rating +=  $row['value'];
}
$rating = $rating/$counter;
echo $rating;
mysql_free_result($result);
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
?>


