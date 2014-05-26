<?php

class StudentsController extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete','crearPdf'),
                                'expression'=>'Yii::app()->user->getState("rol") === constantes::ROL_ADMINISTRADOR',
			),
                        array('allow', // allow authenticated user to perform
				'actions'=>array('perfil','updateProfile'),
                                'expression'=>'Yii::app()->user->getState("rol") === constantes::ROL_ESTUDIANTE',
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
		$model=new Students;
                $modelUser = new Users();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Students']))
		{
                    $model->attributes=$_POST['Students'];
                    $modelUser->attributes=$_POST['Users'];
                    $validUser = $modelUser->validate();
                    $validate = $model->validate() && $validUser;
                    
                    if($validate){
                        $modelUser->status=  constantes::ACTIVO;
                        $modelUser->fk_role=(int)constantes::ROL_ESTUDIANTE;
                        $modelUser->password = crypt($modelUser->password, constantes::PATRON_PASS);
                        if($modelUser->save()){
                            $model->fk_user=$modelUser->pk_user;
                            if($model->save())
                                $this->redirect(array('view','id'=>$model->pk_student));
                        }
                    }
		}

		$this->render('create',array(
			'model'=>$model,
                        'modelUser'=>$modelUser,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
                $profile = FALSE;
                if(isset($_SESSION['updateProfile'])){
                    $profile = $_SESSION['updateProfile'];
                }
		$model=$this->loadModel($id);
                $modelUser = $this->loadModelUser($model->fk_user);
                
		if(isset($_POST['Students']))
		{
                    $model->attributes=$_POST['Students'];
                    if($profile === FALSE){
                        $modelUser->attributes=$_POST['Users'];
                        $validUser = $modelUser->validate();
                        $validate = $model->validate() && $validUser;
                    }else{
                        $validate = $model->validate();
                    }
                    
                    if($validate)
                    {
                        if($profile === FALSE){
                            $modelUser->password = crypt($modelUser->password, constantes::PATRON_PASS);
                            if($modelUser->save())
                            {
                                $model->save();
                                $this->redirect(array('view','id'=>$model->pk_student));
                            }
                        }else{
                            $model->save();
                            unset($_SESSION['updateProfile']);
                            $this->redirect(array('perfil'));
                        }
                        
                    }
		}

                $this->render('update',array(
			'model'=>$model,
                        'modelUser'=>$modelUser,
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
		$model=new Students('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Students']))
			$model->attributes=$_GET['Students'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Students('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Students']))
			$model->attributes=$_GET['Students'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionPerfil(){
            $pk_usuario = Yii::app()->user->getState("pk_user");
            $model = Students::model()->find('fk_user='.$pk_usuario);
            
            $this->render('perfil',array(
			'model'=>$model,
            ));
        }
        
        public function actionUpdateProfile(){
            $pk_usuario = Yii::app()->user->getState("pk_user");
            $model = Students::model()->find('fk_user='.$pk_usuario);
            $_SESSION['updateProfile'] = TRUE;
            $this->actionUpdate($model->pk_student);
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Students the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Students::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        public function loadModelUser($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Students $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='students-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
