<?php

class CatBssHoursController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
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
			array('allow', // allow authenticated user to perform
				'actions'=>array('index','view','create','update','admin','delete'),
                                'expression'=>'Yii::app()->user->getState("rol") === constantes::ROL_ADMIN_SISTEMA',
				//'users'=>array('@'),
			),
                        array('allow', // allow authenticated user to perform
				'actions'=>array('getMinMaxHour'),
                                'expression'=>'Yii::app()->user->getState("rol") === constantes::ROL_MAESTRO',
				//'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        public function actionGetMinMaxHour(){
            $reader = CatBssHours::getMinMaxHour();
            $json = '{';
            foreach($reader as $row) { 
                $hrMin = explode(":", $row['minHr']);
                $hrMax = explode(":", $row['maxHr']);
                $json .= '"minHr":'.$hrMin[0].',"maxHr":'.$hrMax[0];
            }
            $json .= '}';
            echo $json;
        }

        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CatBssHours;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CatBssHours']))
		{
			$model->attributes=$_POST['CatBssHours'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->pk_bss_hour));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CatBssHours']))
		{
			$model->attributes=$_POST['CatBssHours'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->pk_bss_hour));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
                $model=new CatBssHours('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CatBssHours']))
			$model->attributes=$_GET['CatBssHours'];

		$this->render('index',array(
			'model'=>$model,
		));
                /*
		$dataProvider=new CActiveDataProvider('CatBssHours');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
                 * 
                 */
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CatBssHours('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CatBssHours']))
			$model->attributes=$_GET['CatBssHours'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CatBssHours the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CatBssHours::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CatBssHours $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cat-bss-hours-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
