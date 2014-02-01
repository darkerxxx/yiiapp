<?php
/* @var $this MoviesController */
/* @var $model Movies */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<!--  
	<div class="row">
		<?php/* echo $form->label($model,'movieid'); */?>
		<?php/* echo $form->textField($model,'movieid'); */?>
	</div>
-->
	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php //echo $form->textArea($model,'title',array('rows'=>6, 'cols'=>50)); 
		echo $form->textArea($model,'title',array('rows'=>2, 'cols'=>50));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'year'); ?>
		<?php echo $form->textField($model,'year'); ?>
	</div>
<!--  
	<div class="row">
		<?php/* echo $form->label($model,'description'); */?>
		<?php/* echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); */?>
	</div>
-->
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->