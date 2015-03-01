<?php

class LoanMaterialController extends Controller
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
				'actions'=>array('index','view', 'create','update','admin','delete'),
				'expression'=>  'Yii::app()->user->getState("rol") === constantes::ROL_MAESTRO'
                                                .'|| Yii::app()->user->getState("rol") === constantes::ROL_ADMIN_SISTEMA'
                                                .'|| Yii::app()->user->getState("rol") === constantes::ROL_ADMINISTRADOR',
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
		$model=new LoanMaterial;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LoanMaterial']))
		{
			$model->attributes=$_POST['LoanMaterial'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->pk_loan_material));
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

		if(isset($_POST['LoanMaterial']))
		{
			$model->attributes=$_POST['LoanMaterial'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->pk_loan_material));
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
	 * Listar materiales prestados.
	 */
	public function actionIndex()
	{            
            $model=new LoanMaterial('searchByTeacher');  
            
            if(Yii::app()->user->getState("rol") === constantes::ROL_MAESTRO){
                $pk_usuario = Yii::app()->user->getState("pk_user");
                $modelT = Teachers::model()->find('fk_user='.$pk_usuario);
                $model->fk_teacher = $modelT->pk_teacher;
            }
            
            $data = $model->searchByTeacher()->getData();
            $fkMaterialArray = array();
            foreach ($data as $key => $value) {
                $infoCurso = Courses::getFechaFInPorcentaje($value->fk_course);
                //Se suma 15 dias apartir de la fecha de terminacion del curso
                $data[$key]->drop_date = date('Y-m-d', strtotime($infoCurso['tmp_final_date']. ' + 15 days'));
                $fkMaterialArray[] = $value->fk_material_detail;
            }            
            
            $arrayRepetitivo = array_count_values($fkMaterialArray);            
            foreach ($arrayRepetitivo as $key => $cont) {
                if($cont > 1){
                    //Buscar fecha mayor para un material de cursos diferentes
                    $esPrimerRegistro = TRUE;
                    foreach ($data as $pk => $value) {
                        if($value->fk_material_detail == $key){
                            if($esPrimerRegistro){
                                $fechaMayor = $value->drop_date;
                                $esPrimerRegistro = FALSE;
                            }else{
                                $datetime1 = new DateTime($fechaMayor);
                                $datetime2 = new DateTime($value->drop_date);
                                if($datetime2 > $datetime1){
                                    $fechaMayor = $value->drop_date;
                                }
                            }
                            $data[$pk]->drop_date = $fechaMayor;
                        }
                    }
                }
            }
            
            $dataProvider = new CActiveDataProvider('LoanMaterial', array(
                'data'=>$data,
            ));
            
            $this->render('index',array(
                    'data'=>$dataProvider
            ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new LoanMaterial('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LoanMaterial']))
			$model->attributes=$_GET['LoanMaterial'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return LoanMaterial the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=LoanMaterial::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param LoanMaterial $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='loan-material-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
