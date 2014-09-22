<?php

class CatMaterialController extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete','updateDetail'),
                                'expression'=>'Yii::app()->user->getState("rol") === constantes::ROL_ADMIN_SISTEMA',
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            $model=new CatMaterial;
            $modelML = new MaterialLevel;

            if(isset($_POST['CatMaterial']))
            {
                $model->attributes=$_POST['CatMaterial'];
                $modelML->attributes=$_POST['MaterialLevel'];
                $modelML->fk_material = 0;
                $validarML = $modelML->validate();
                $validar = $model->validate() && $validarML;
                if($validar){
                    if($model->save()){
                        $modelML->fk_material = $model->pk_material;
                        $modelML->save();
                        $this->redirect(array('index'));
                    }
                }                    
            }

            $this->render('create',array(
                    'model'=>$model, 'modelML'=>$modelML,
            ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id){
            $model=$this->loadModel($id);
            $modelML = MaterialLevel::model()->find('fk_material=?', array($model->pk_material));
            
            $criteria=new CDbCriteria;
	    $criteria->compare('fk_cat_material',$model->pk_material);            
            $dataProviderMD = new CActiveDataProvider('CatMaterialDetail', array(
                                                                'criteria'=>$criteria,
                                                                ));
           
            
            if(isset($_POST['CatMaterial'])){
                $model->attributes=$_POST['CatMaterial'];
                $modelML->attributes=$_POST['MaterialLevel'];
                //$modelMD->attributes=$_POST['CatMaterialDetail'];
                $validarML = $modelML->validate();
                $validar = $model->validate() && $validarML;
                if($validar){
                    if($model->save()){
                        $modelML->fk_material = $model->pk_material;
                        $modelML->save();
                        $this->redirect(array('index'));
                    }
                }  
            }

            $this->render('update',array(
                    'model'=>$model, 'modelML'=>$modelML,'dataProviderMD'=>$dataProviderMD,
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
            $model=new MaterialsView('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['MaterialsView']))
                    $model->attributes=$_GET['MaterialsView'];

            $this->render('index',array(
                    'model'=>$model,
            ));
            /*
            $model=new CatMaterial('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['CatMaterial']))
                    $model->attributes=$_GET['CatMaterial'];

            $this->render('index',array(
                    'model'=>$model,
            ));

            $dataProvider=new CActiveDataProvider('CatMaterial');
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
		$model=new CatMaterial('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CatMaterial']))
			$model->attributes=$_GET['CatMaterial'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CatMaterial the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CatMaterial::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CatMaterial $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cat-material-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        
        public function actionUpdateDetail($id){
            $model=$this->loadModel($id);
            //$_SESSION['CatMaterial']['escenario'] = 1; // Update
            $_SESSION['CatMaterial']['pk_cat_master'] = $model->pk_material;
            $_SESSION['CatMaterial']['desc_material'] = $model->desc_material;
            $this->redirect(array('catalogs/catMaterialDetail/index'));
        }        
}
