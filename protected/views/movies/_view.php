<?php
/* @var $this MoviesController */
/* @var $data Movies */
?>

<div class="view">
<!--
	<b><?php /*echo CHtml::encode($data->getAttributeLabel('movieid')); */?>:</b>
	<?php /* echo CHtml::link(CHtml::encode($data->movieid), array('view', 'id'=>$data->movieid));*/ ?>
	<br />
--><!--
	<b><?php /*echo CHtml::encode($data->getAttributeLabel('title'));*/ ?>:</b> -->
	<?php /*echo CHtml::encode($data->title); */?>
	<?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->movieid)); ?>
	<br />
<!--
	<b><?php /*echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); */?>
	<br /> 
-->

</div>