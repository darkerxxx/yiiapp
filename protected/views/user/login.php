

<?php
$this->pageTitle=Yii::app()->name . ' - Login';

?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>


<div>
<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($form); ?>

<div>
<?php echo CHtml::activeLabel($form,'login'); ?>
<?php echo CHtml::activeTextField($form,'login') ?>
</div>

<div>
<?php echo CHtml::activeLabel($form,'password'); ?>
<?php echo CHtml::activePasswordField($form,'password') ?>
</div>

<div>
<?php echo CHtml::submitButton('Login'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->