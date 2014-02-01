<?php

class RatingController extends Controller
{
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	
	public function calculateRating()
	{
		
	}
	
	public function calculateAll()
	{
		
	}
	
	public function calculateCurrent()
	{
	
	}
	
	public function addRating()
	{
		$model=new Rating;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Rating']))
		{
			$model->attributes=$_POST['Rating'];
			if($model->save())
				//$this->redirect(array('view','id'=>$model->movieid));
				$this->redirect(Yii::app()->user->returnUrl);
		}
		
		$this->render('create',array(
				'model'=>$model,
		));
	}
}