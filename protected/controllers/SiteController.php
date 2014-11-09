<?php

class SiteController extends Controller
{	
	
	public function filters()
	{
		return array(
				'accessControl',
		);
	}
	
	public function accessRules()
	{
		return array(
				array('allow',
						'actions'=>array('logout','index', 'contact'),
						'users'=>array('@'),
				),
				array('allow', 
						'actions'=>array('login', 'register', 'contact'),
						'users'=>array('?'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{		
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{					
				$username = $model->first_name.' '.$model->surname;
				$name='=?UTF-8?B?'.base64_encode($username).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name>\r\n".
					"Reply-To: {$name}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$autorized_user = false;
		$id = Yii::app()->user->getId();
		if($id){
			$user_model = Users::model()->findByPk($id);
			$model->first_name = $user_model->first_name;
			$model->surname = $user_model->surname;
			$autorized_user = true;
		}
		$this->render('contact',array('model'=>$model, 'autorized_user'=>$autorized_user));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-login')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{	
			$pass = $_POST['LoginForm']['password'];
			$model->attributes=$_POST['LoginForm'];
			$model->password = !empty($pass) ? md5($pass) : null;
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				$this->redirect(Yii::app()->createUrl('user/view'));
			}
			$model->password = $pass;
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function AjaxValidation($model, $form, $params = null){
		if(isset($_POST['ajax']) && $_POST['ajax']===$form)
		{
			echo CActiveForm::validate($model, $params);
			
		}	
	}
	/**
	 * user register page /site/register
	 */
	public function actionRegister(){
		$model = new Users;
		if(isset($_POST['submit-1']))
		{	
			$this->AjaxValidation($model, 'users-register-form',array('username', 'email', 'password'));
			Yii::app()->end();
		}
		if(isset($_POST['submit-2']))
		{
			$this->AjaxValidation($model, 'users-register-form', array('first_name', 'surname', 'gender', 'about'));
			Yii::app()->end();
		}
		if(isset($_POST['finish']))
		{
			$model->attributes = $_POST['Users'];	
			if($model->validate()){
				if($model->save()){
					$identity=new UserIdentity($model->email, $model->password);
					if($identity->authenticate()){
						Yii::app()->user->login($identity);
						Yii::app()->end();
					}
				}
			}
		}
		$this->render('register',array('model'=>$model));
	}
}