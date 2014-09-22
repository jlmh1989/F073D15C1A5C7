<?php

class CatMaterialDetailController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update','admin','delete'),
				'expression'=>'Yii::app()->user->getState("rol") === constantes::ROL_ADMIN_SISTEMA',
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CatMaterialDetail;
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CatMaterialDetail']))
		{
			$model->attributes=$_POST['CatMaterialDetail'];
                        $model->fk_cat_material = $_SESSION['CatMaterial']['pk_cat_master'];
			if($model->save())
				$this->redirect(array('index'));
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

		if(isset($_POST['CatMaterialDetail']))
		{
			$model->attributes=$_POST['CatMaterialDetail'];
			if($model->save())
				$this->redirect(array('index'));
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
		/*$dataProvider=new CActiveDataProvider('CatMaterialDetail');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
		$model=new CatMaterialDetail('search');
                $model->unsetAttributes();  // clear any default values   
                $model->fk_cat_material = $_SESSION['CatMaterial']['pk_cat_master'];
		  /*          
                $criteria=new CDbCriteria;
                $criteria->compare('fk_cat_material',$_SESSION['CatMaterial']['pk_cat_master']);            
                $model = new CActiveDataProvider('CatMaterialDetail', array(
                                                                    'criteria'=>$criteria,
                                                                    ));                
                */
                
		if(isset($_GET['CatMaterialDetail']))
			$model->attributes=$_GET['CatMaterialDetail'];

		$this->render('index',array(
			'model'=>$model,
		));            
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CatMaterialDetail('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CatMaterialDetail']))
			$model->attributes=$_GET['CatMaterialDetail'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CatMaterialDetail the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CatMaterialDetail::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CatMaterialDetail $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cat-material-detail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
