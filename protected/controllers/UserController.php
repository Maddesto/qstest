<?php

class UserController extends Controller
{
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow', // allow authenticated user to perform 'view' and 'update' actions
						'actions'=>array('view','update'),
						'users'=>array('@'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}
	/**
	 * user view page /user/view
	 */
	public function actionView()
	{	
		$id = Yii::app()->user->getId();
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	/**
	 * 
	 * @param int $id
	 * @throws CHttpException
	 * @return CActiveRecord
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * user update page /user/update
	 */
	public function actionUpdate()
	{	
		$id = Yii::app()->user->getId();
		$model=$this->loadModel($id);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			$model->passwordChanged = !empty($_POST['Users']['password'])? true: false;
			if($model->save())
				$this->redirect(Yii::app()->createUrl('user/update'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
}